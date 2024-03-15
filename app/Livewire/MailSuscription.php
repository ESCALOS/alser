<?php

namespace App\Livewire;

use App\Models\MailSuscriptor;
use App\Notifications\VerifyMailSuscription;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MailSuscription extends Component
{
    use LivewireAlert;

    public string $email = '';

    public function send()
    {
        $validator = Validator::make(
            ['email' => $this->email],
            ['email' => 'required|email:rfc,dns|unique:mail_suscriptors'],
            [
                'email.required' => 'Ingrese su correo electrónico',
                'email.email' => 'Correo Inválido',
                'email.unique' => 'Correo ya suscrito',
            ]
        );

        if ($validator->stopOnFirstFailure()->fails()) {
            $this->alert('warning', $validator->errors()->first(), [
                'position' => 'center',
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);
        } else {
            $suscriptor = MailSuscriptor::create(['email' => $this->email]);
            $suscriptor->notify(new VerifyMailSuscription());

            $this->alert('success', 'Suscripción exitosa', [
                'position' => 'center',
                'toast' => false,
                'showConfirmButton' => true,
                'onConfirmed' => '',
            ]);
            $this->reset(['email']);
        }
    }

    public function render()
    {
        return view('livewire.mail-suscription');
    }
}
