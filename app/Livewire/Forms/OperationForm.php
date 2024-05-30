<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class OperationForm extends Form
{
    public bool $isPurchase = true;

    public float|string $amountToSend = 1000;

    public float|string $amountToReceive = 3737;

    public ?int $solAccount;

    public ?int $dollarAccount;

    public bool $terms = false;
}
