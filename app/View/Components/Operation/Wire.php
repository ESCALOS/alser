<?php

namespace App\View\Components\Operation;

use App\Models\Bank;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Wire extends Component
{
    public string $businessBankName = '';

    public string $businessBankNumber = '';

    public function __construct(
        public Bank $bank,
        public string $account,
        public float $amount,
        public bool $isPurchase
    ) {
        if ($this->isPurchase) {
            $this->businessBankName = $this->bank->dollar_account_name;
            $this->businessBankNumber = $this->bank->dollar_account_number;
        } else {
            $this->businessBankName = $this->bank->sol_account_name;
            $this->businessBankNumber = $this->bank->sol_account_number;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.operation.wire');
    }
}
