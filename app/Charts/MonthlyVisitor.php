<?php

namespace App\Charts;

use App\Models\Analytics;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyVisitor
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $analytics = Analytics::selectRaw('count(*) as total, MONTH(created_at) month')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

            $months = [
                'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
                'November', 'December'
            ];

            $data = [];
            foreach ($months as $key => $month) {
                $data[] = $analytics[$key + 1] ?? 0;
            }


            return $this->chart->barChart()
            ->setTitle('Monthly Visitor')
            ->setSubtitle('Visitors and Page Views by Month')
            ->addData('Visitors', $data)
            ->setXAxis($months);


    }


}
