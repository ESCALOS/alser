<?php

namespace App\Livewire\Graphics;

use App\Models\Price;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class DollarFluctuation extends Component
{
    public bool $firstRun = true;

    public bool $isPurchase;

    public Collection $prices;

    public Price $lastPrice;

    public function mount($isPurchase, Collection $prices, Price $lastPrice)
    {
        $this->isPurchase = $isPurchase;
        $this->prices = $prices;
        $this->lastPrice = $lastPrice;
    }

    public function render()
    {

        $chart = LivewireCharts::lineChartModel()
            //->setTitle('Expenses Evolution')
            ->withDataLabels()
            ->setAnimated($this->firstRun)
            // ->withOnPointClickEvent('onPointClick')
            ->setSmoothCurve()
            ->addPoint('Ayer', $this->isPurchase ? $this->lastPrice->purchase : $this->lastPrice->sales);

        foreach ($this->prices as $price) {
            $chart->addPoint($price->created_at->format('H:i'), $this->isPurchase ? $price->purchase : $price->sales);
        }

        $chart->setJsonConfig([
            'tooltip.y.formatter' => '(val) => `$${val.toFixed(3)}`',
            'tooltip.x.show' => 'false',
            'xaxis.labels.formatter' => '(val) => {
                const regex = /^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
                return regex.test(val) ? `${val} hrs.` : val;
            }',
            'yaxis.labels.formatter' => '(val) => `$${val.toFixed(3)}`',
            'dataLabels.formatter' => '(val) => `$${val.toFixed(3)}`',
        ]);

        $this->firstRun = false;

        return view('livewire.graphics.dollar-fluctuation', compact('chart'));
    }
}
