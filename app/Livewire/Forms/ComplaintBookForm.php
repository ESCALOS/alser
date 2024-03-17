<?php

namespace App\Livewire\Forms;

use App\Rules\DocumentNumberValidation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ComplaintBookForm extends Form
{
    // Datos Personales
    #[Validate('required|integer|max:4', message: 'El tipo de documento es obligatorio')]
    public ?int $documentType = 1;

    #[Validate]
    public string $documentNumber = '';

    #[Validate('required|string|max:20', as: 'Apellido Paterno')]
    public string $lastNameFather = '';

    #[Validate('required|string|max:20', as: 'Apellido Materno')]
    public string $lastNameMother = '';

    #[Validate('required|string|max:50', as: 'Nombres')]
    public string $name = '';

    #[Validate('string|max:255', as: 'Apoderado')]
    public string $representative = '';

    //Ubicación Geográfica
    #[Validate('required|exists:location_departments,id', as: 'Departamento', onUpdate: false)]
    public ?int $departmentId = 15;

    #[Validate('required|exists:location_provinces,id', as: 'Provincia', onUpdate: false)]
    public ?int $provinceId = null;

    #[Validate('required|exists:location_districts,id', as: 'Distrito')]
    public ?int $districtId = null;

    // Dirección
    #[Validate('required|string|max:255', as: 'Dirección')]
    public string $street = '';

    #[Validate('required|string|max:10', as: 'Nro/Mz')]
    public string $streetNumber = '';

    #[Validate('string|max:100', as: 'Lote')]
    public string $streetLot = '';

    #[Validate('string|max:100|Dpto')]
    public string $streetDpto = '';

    #[Validate('string|max:100|Urbanización')]
    public string $urbanization = '';

    #[Validate('string|max:100', as: 'Referencia')]
    public string $reference = '';

    // Contacto
    #[Validate('string|max:11', message: 'Telefono inválido')]
    public string $telephone = '';

    #[Validate('required|string|max:9', as: 'Celular')]
    public string $celphone = '';

    #[Validate('required|email:rfc,dns')]
    public string $email = '';

    #[Validate('required|in:1,2', message: 'El número de documento es obligatorio')]
    public ?int $responseMedium = 1;

    #[Validate('required|boolean', message: 'Opción inválida')]
    public bool $isComplaint = true;

    #[Validate('required_if:isComplaint,true', message: 'Campo obligatorio')]
    public string $reasonDescription = '';

    public function rules(): array
    {
        return [
            'documentNumber' => ['required', new DocumentNumberValidation($this->documentType ?? 0)],
        ];
    }

    public function validationAttributes()
    {
        return [
            'documentNumber' => 'Número de documento',
        ];
    }

    public function messages()
    {
        return [
            'documentNumber.required' => 'El número de documento es obligatorio',
        ];
    }

    public function save(): void
    {
        $this->validate();
    }
}
