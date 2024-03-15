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

    // Dirección
    public string $street = '';

    public string $streetNumber = '';

    public string $streetLot = '';

    public string $streetDpto = '';

    public string $urbanization = '';

    public string $reference = '';

    public ?int $districtId = null;

    public string $contact = '';

    public string $typeContact = '';

    public string $responseMedium = '';
}
