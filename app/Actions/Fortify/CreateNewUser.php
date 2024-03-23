<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'account_type' => ['required', 'in:1,2'],
            'ruc' => ['exclude_if:account_type,1', 'required', 'digits:11'],
            'name' => ['exclude_if:account_type,1', 'required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], [
            'account_type.in' => 'El tipo de cuenta es inválido',
        ], [
            'account_type' => 'Tipo de cuenta',
            'ruc' => 'RUC',
            'name' => 'Razón Social',
        ])->validate();
        $data = [];
        if ($input['account_type'] == 2) {
            $data['document_type'] = 2;
            $data['document_number'] = $input['ruc'];
            $data['name'] = $input['name'];
        }

        $data['name'] = $input['name'];
        $data['email'] = $input['email'];
        $data['password'] = Hash::make($input['password']);

        $user = User::create($data);

        return $user;
    }
}
