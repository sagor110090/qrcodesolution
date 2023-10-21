<?php

namespace App\Livewire\Chart;

use Livewire\Component;
use App\Charts\CountryVisitor;

class CountryVisitors extends Component
{
    public function render(CountryVisitor $chart)
    {
        return view('livewire.chart.country-visitors', [
            'chart' => $chart->build()
        ]);
    }
}
