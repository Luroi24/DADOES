<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
class Chat extends Component
{
    public $message;
    public $response;
    public $user_id;

    public function mount(){
        $this->user_id = Auth::user()->id;
    }

    protected function rules(){
        return [
            'message' => ['required', 'string','max:300'],
            'user_id' => 'required',
            'user_id.*' => 'required|exists:users,id',
        ];
    }

    public function render(){
        $messages = Message::where('user_id', Auth::user()->id)->with('response')->get();
        return view('livewire.chat', compact('messages'));
    }

    public function storeData(){
        $this->validate();

        $verify_input = OpenAI::moderations()->create([
            'model' => 'text-moderation-latest',
            'input' => $this->message,
        ]);

        $validator = Validator::make($verify_input['results'][0], [
            'flagged' => ['required', 'boolean', Rule::in([false])],
        ]);

        if ($validator->fails()) {
            $this->addError('message', 'The message does not follow OpenAI guidelines');
            return;
        }

        // Validar y guardar los datos en la base de datos
        $message = new Message();
        $message->user_id = $this->user_id;
        $message->content = $this->message;
        $message->save();

        // Verificar que la API envíe una respuesta
        try{
            $this->response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'temperature' => 0.7,
                'top_p' => 1,
                'frequency_penalty' => 0,
                'max_tokens' => 300,
                'messages' => [
                    ['role' => 'user', 'content' => $this->message],
                ],
            ]);
        } catch(\Exception $e){
            // En caso de no obtener respuesta, se elimina de la base de datos el mensaje y se muestra el error en la vista
            DB::table('messages')->where('id', $message->id)->delete();
            $this->addError('response', 'The API response is not correct.');
        }
        // Validar los datos recibidos de la API
        $validator = Validator::make($this->response['choices'][0]['message'], [
            'content' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            DB::table('messages')->where('id', $message->id)->delete();
            $this->addError('response', 'The API response is not correct.');
            return;
        }

        Response::create([
            'message_id' => $message->id,
            'content' => $this->response['choices'][0]['message']['content'],
        ]);

        // Restablecer los campos después del almacenamiento
        $this->message = '';
        $this->response = '';
    }

    public function submitMessage(){
        $this->storeData();
    }

}
