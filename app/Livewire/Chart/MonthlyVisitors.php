<?php

namespace App\Livewire\Chart;

use Livewire\Component;
use App\Charts\MonthlyVisitor;

class MonthlyVisitors extends Component
{
    public function render(MonthlyVisitor $chart)
    {
        return view('livewire.chart.monthly-visitors', [
            'chart' => $chart->build()
        ]);
    }
}
