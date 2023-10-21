<?php

namespace App\Charts;

use App\Models\Analytics;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DailyVisitor
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $analytics = Analytics::selectRaw('count(*) as total, date(created_at) date')
                    ->groupBy('date')
                    ->orderBy('date')
                    ->pluck('total', 'date');

        $days = [];
        $data = [];

        for ($i = 0; $i < 29; $i++) {
            $date = now()->subDays($i)->format('Y-m-d');
            $days[] = now()->subDays($i)->format('Y-m-d');
            $data[] = $analytics[$date] ?? 0;
        }

        return $this->chart->barChart()
            ->setTitle('Daily Visitor')
            ->setSubtitle('Visitors and Page Views by Day')
            ->addData('Visitors', $data)
            ->setXAxis($days);

    }
}
