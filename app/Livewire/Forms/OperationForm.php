<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class OperationForm extends Form
{
    public bool $isPurchase = true;

    public $amountToSend = 1000;

    public $amountToReceive = 3737;

    public int $solAccount;

    public int $dollarAccount;

    public bool $terms = false;
}
