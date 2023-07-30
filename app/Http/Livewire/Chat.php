<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $message;
    public $user_id;

    public function mount(){
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {
        $messages = Message::with('user')->get();
        return view('livewire.chat', compact('messages'));
    }

    public function storeData()
    {
        // Validar y guardar los datos en la base de datos
        Message::create([
            'user_id' => $this->user_id,
            'content' => $this->message,
        ]);

        // Restablecer los campos después del almacenamiento
        $this->message = '';
    }
}
