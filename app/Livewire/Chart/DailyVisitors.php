<?php

namespace App\Livewire\Chart;

use App\Charts\DailyVisitor;
use Livewire\Component;

class DailyVisitors extends Component
{
    public function render(DailyVisitor $chart)
    {
        return view('livewire.chart.daily-visitors', [
            'chart' => $chart->build()
        ]);
    }
}
