<?php

namespace App\Livewire;

use App\Models\MailSuscriptor;
use App\Notifications\VerifyMailSuscription;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Validator;

class MailSuscription extends Component
{
    use LivewireAlert;

    #[Rule('required', message: 'Ingrese su correo')]
    #[Rule('email:rfc,dns', message: 'Correo Inválido')]
    #[Rule('unique:mail_suscriptors')]
    public $email;

    public function mount() {

    }

    public function send() {
        $validator = Validator::make(
            ['email' => $this->email],
            ['email' => 'required|email:rfc,dns|unique:mail_suscriptors'],
            [
                'email.required' => 'Ingrese su correo electrónico',
                'email.email' => 'Correo Inválido',
                'email.unique' => 'Ya se encuentra suscrito'
            ]
        );

        if($validator->fails()) {
            $this->alert('warning', $validator->errors()->first());
        }else{
            $suscriptor = MailSuscriptor::create(["email" => $this->email]);
            // $suscriptor = new MailSuscriptor();
            // $suscriptor->email = $this->email;
            $suscriptor->notify(new VerifyMailSuscription());
            $this->alert('success', 'Suscripción exitosa', [
                'position' => 'center',
                'timer' => 1500,
                'toast' => false,
                'showConfirmButton' => true,
            ]);
            $this->reset(['email']);
        }
    }

    public function render()
    {
        return view('livewire.mail-suscription');
    }
}
