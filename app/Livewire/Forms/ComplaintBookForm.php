<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class ComplaintBookForm extends Form
{
    // Datos Personales
    public string $documentType = 'DNI';

    public string $documentNumber = '';

    public string $paternalSurname = '';

    public string $maternalSurname = '';

    public string $name = '';

    // Dirección
    public string $street = '';

    public string $streetNumber = '';

    public string $streetLot = '';

    public string $streetDpto = '';

    public ?int $departmentId = null;

    public ?int $provinceId = null;

    public ?int $districtId = null;
}
