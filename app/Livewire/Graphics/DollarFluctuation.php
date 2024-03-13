<?php

namespace App\Livewire\Graphics;

use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class DollarFluctuation extends Component
{
    public bool $firstRun = true;

    public bool $isPurchase;

    public Collection $prices;

    public function mount($isPurchase, Collection $prices)
    {
        $this->isPurchase = $isPurchase;
        $this->prices = $prices;
    }

    public function render()
    {

        $chart = LivewireCharts::lineChartModel()
            //->setTitle('Expenses Evolution')
            ->withDataLabels()
            ->setAnimated($this->firstRun)
            ->withOnPointClickEvent('onPointClick')
            ->setSmoothCurve();

        foreach ($this->prices as $price) {
            $chart->addPoint($price->created_at->format('H:i'), $this->isPurchase ? $price->purchase : $price->sales);
        }

        $chart->setJsonConfig([
            'tooltip.y.formatter' => '(val) => `$${val.toFixed(3)}`',
            'xaxis.labels.formatter' => '(val) => `${val} hrs.`',
            'yaxis.labels.formatter' => '(val) => `$${val.toFixed(3)}`',
            'dataLabels.formatter' => '(val) => `$${val.toFixed(3)}`',
        ]);

        $this->firstRun = false;

        return view('livewire.graphics.dollar-fluctuation', compact('chart'));
    }
}
