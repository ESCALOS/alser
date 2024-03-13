<?php

namespace App\Livewire\Graphics;

use App\Models\Price;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Livewire\Component;

class DollarFluctuation extends Component
{
    public $firstRun = true;

    public $isPurchase;

    public function mount($isPurchase = true)
    {
        $this->isPurchase = $isPurchase;
    }

    public function render()
    {
        $prices = Price::whereDate('created_at', today())->get();
        $chart = LivewireCharts::lineChartModel()
            //->setTitle('Expenses Evolution')
            ->withDataLabels()
            ->setDataLabelsEnabled(true)
            ->setAnimated($this->firstRun)
            ->withOnPointClickEvent('onPointClick')
            ->setSmoothCurve()
            ->setXAxisVisible(true)
            ->setDataLabelsEnabled(true);
        foreach ($prices as $price) {
            $chart->addPoint($price->created_at->format('H:i'), $this->isPurchase ? $price->purchase : $price->sales);
        }

        $chart->setJsonConfig([
            'tooltip.y.formatter' => '(val) => `$${val}`',
            'xaxis.labels.formatter' => '(val) => `${val} hrs.`',
        ]);

        $this->firstRun = false;

        return view('livewire.graphics.dollar-fluctuation', compact('chart'));
    }
}
