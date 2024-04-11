<?php

namespace App\Livewire\Forms;

use App\Rules\DocumentNumberValidation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ComplaintBookForm extends Form
{
    // Datos Personales
    #[Validate('required|in:1,2,3,4', message: 'El tipo de documento es obligatorio')]
    public ?int $document_type = 1;

    #[Validate]
    public string $document_number = '';

    #[Validate('exclude_if:document_type,2|required:|string|max:20', as: 'Apellido Paterno')]
    public string $last_name_father = '';

    #[Validate('exclude_if:document_type,2|required|string|max:20', as: 'Apellido Materno')]
    public string $last_name_mother = '';

    #[Validate('required|string|max:50', as: 'Nombres')]
    public string $name = '';

    #[Validate('string|max:255', as: 'Apoderado')]
    public string $representative = '';

    //Ubicación Geográfica
    #[Validate('required|exists:location_departments,id', as: 'Departamento', onUpdate: false)]
    public ?int $location_department_id = 15;

    #[Validate('required|exists:location_provinces,id', as: 'Provincia', onUpdate: false)]
    public ?int $location_province_id = null;

    #[Validate('required|exists:location_districts,id', as: 'Distrito')]
    public ?int $location_district_id = null;

    // Dirección
    #[Validate('required|string|max:255', as: 'Dirección')]
    public string $street = '';

    #[Validate('required|string|max:10', as: 'Nro/Mz')]
    public string $street_number = '';

    #[Validate('string|max:100', as: 'Lote')]
    public string $street_lot = '';

    #[Validate('string|max:100', as: 'Dpto')]
    public string $street_dpto = '';

    #[Validate('string|max:100', as: 'Urbanización')]
    public string $urbanization = '';

    #[Validate('string|max:100', as: 'Referencia')]
    public string $reference = '';

    // Contacto
    #[Validate('string|max:12', message: 'Telefono inválido')]
    public string $telephone = '';

    #[Validate('required|string|max:9', as: 'Celular')]
    public string $celphone = '';

    #[Validate('required|email:rfc,dns')]
    public string $email = '';

    #[Validate('required|in:1,2', message: 'El número de documento es obligatorio')]
    public ?int $response_medium = 1;

    #[Validate('required|boolean', message: 'Opción inválida')]
    public bool $is_complaint = true;

    #[Validate('required_if:is_complaint,true', message: 'Campo obligatorio')]
    #[Validate('max:1000', message: 'Máximo de 1000 caracteres')]
    public string $reason_description = '';

    public function rules(): array
    {
        return [
            'document_number' => ['required', new DocumentNumberValidation($this->document_type ?? 0)],
        ];
    }

    public function validationAttributes()
    {
        return [
            'document_number' => 'Número de documento',
        ];
    }

    public function messages()
    {
        return [
            'document_number.required' => 'El número de documento es obligatorio',
        ];
    }
}
