<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class ClaimForm extends Form
{
    public int $service = 1;

    public int $currencyType = 1;

    public string $operationCode = '';

    public string $amountToClaim = '';
}
