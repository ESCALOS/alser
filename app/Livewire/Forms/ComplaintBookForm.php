<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class ComplaintBookForm extends Form
{
    // Datos Personales
    public ?int $documentType = 1;

    public string $documentNumber = '';

    public string $lastNameFather = '';

    public string $lastNameMother = '';

    public string $name = '';

    public string $representative = '';

    // Dirección
    public string $street = '';

    public string $streetNumber = '';

    public string $streetLot = '';

    public string $streetDpto = '';

    public string $urbanization = '';

    public string $reference = '';

    public ?int $districtId = null;

    public string $telephone = '';

    public string $celphone = '';

    public string $email = '';

    public string $responseMedium = 'Correo electrónico';

    public string $reason = 'Queja';

    public string $reasonDescription = '';

    public string $hiredService = 'Cambio de moneda online';

    public int $hiredServiceCurrencyType = 1;

    public string $hiredServiceOperationCode = '';

    public string $hiredServiceAmountToClaim = '';

    public function store()
    {

    }
}
