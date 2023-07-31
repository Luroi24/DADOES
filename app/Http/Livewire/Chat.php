<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class Chat extends Component
{
    public $message;
    public $response;
    public $user_id;
    public $sendingMessage = false;

    public function mount(){
        $this->user_id = Auth::user()->id;
    }

    protected function rules()
    {
        return [
            'message' => 'required|string|max:300',
            'user_id' => 'required',
            'user_id.*' => 'required|exists:users,id',
        ];
    }

    public function render()
    {
        $messages = Message::with('user.messages.response')->where('user_id', Auth::user()->id)->get();
        return view('livewire.chat', compact('messages'));
    }

    public function storeData(){
        $this->validate();
        if($this->sendingMessage){
            return;
        }
        $this->sendingMessage = true;
        // Validar y guardar los datos en la base de datos
        $message = new Message();
        $message->user_id = $this->user_id;
        $message->content = $this->message;
        $message->save();

        $this->response = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'temperature' => 0.7,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'max_tokens' => 300,
            'prompt' => sprintf($this->message),
        ]);

        Response::create([
            'message_id' => $message->id,
            'content' => $this->response['choices'][0]['text'],
        ]);

        // Restablecer los campos después del almacenamiento
        $this->message = '';
        $this->response = '';
        $this->sendingMessage = false;
    }

    public function submitMessage(){
        $this->storeData();
    }

}
