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
    public $search = '';

    public function mount()
    {
        $this->user_id = Auth::user()->id;
    }

    protected function rules()
    {
        return [
            'message' => ['required', 'string', 'max:300'],
            'user_id' => 'required',
            'user_id.*' => 'required|exists:users,id',
        ];
    }

    public function render()
    {
        $messages = Message::where('user_id', Auth::user()->id)->where('content', 'like', '%' . $this->search . '%')->with('response')->get();
        return view('livewire.chat', compact('messages'));
    }

    public function submitMessage()
    {
        $this->storeData();
    }

    public function validateMessage()
    {
        // Verificar reglas de validación
        $this->validate();

        // Aplicar moderación de OpenAI al mensaje ingresado
        $verify_input = OpenAI::moderations()->create([
            'model' => 'text-moderation-latest',
            'input' => $this->message,
        ]);

        // Aplicar regla de validación para verificar si el mensaje cumple con las reglas de moderación de OpenAI
        $validator = Validator::make($verify_input['results'][0], [
            'flagged' => ['required', 'boolean', Rule::in([false])],
        ]);

        // Retornar un error en caso que no se cumpla con las reglas de moderación
        if ($validator->fails()) {
            return $this->addError('message', 'The message does not follow OpenAI guidelines');
        }

        // Guardar mensaje en la base de datos en caso de pasar las reglas de validación
        $message = new Message();
        $message->user_id = $this->user_id;
        $message->content = $this->message;
        $message->save();

        $this->validateResponse($message);
    }

    public function validateResponse($message)
    {
        // Verificar que la API envíe una respuesta
        try {
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
        } catch (\Exception $e) {
            // En caso de no obtener respuesta, se elimina de la base de datos el mensaje y se muestra el error en la vista
            DB::table('messages')->where('id', $message->id)->delete();
            $this->addError('response', 'The API response is not correct.');
        }
        // Validar los datos recibidos de la API
        $validator = Validator::make($this->response['choices'][0]['message'], [
            'content' => ['required', 'string'],
        ]);
        // En caso de no obtener respuesta se elimina el mensaje al que sería asociada la respuesta y se retorna un error
        if ($validator->fails()) {
            DB::table('messages')->where('id', $message->id)->delete();
            return $this->addError('response', 'The API response is not correct.');
        }

        // Se guarda la respuesta en base de datos en caso de pasar las reglas de validación
        Response::create([
            'message_id' => $message->id,
            'content' => $this->response['choices'][0]['message']['content'],
        ]);
    }

    public function storeData()
    {
        $this->validateMessage();
        // Emite este evento para que el boton de "copiar" aparezca en las nuevas respuestas
        $this->emit('responseAdded');
        // Restablecer los campos después del almacenamiento
        $this->message = '';
        $this->response = '';
    }
}
