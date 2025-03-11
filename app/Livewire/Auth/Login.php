<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    protected $messages = [
        'email.required' => 'O campo email é obrigatório',
        'email.email' => 'Formato de email inválido',
        'password.required' => 'O campo senha é obrigatória',
        'password.min' => 'A senha deve conter no mínimo 6 caracteres'
    ];

    public function login(){
        $this->validate();

        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
            session()->regenerate();
            return redirect()->route(Auth::user()->role === 'admin' ? 'admin.dashboard' : 'user.dashboard');  //: = se não
        }
        session()->flash('error', 'Email ou senha incorretos');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
