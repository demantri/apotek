<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use Maatwebsite\Excel\Concerns\WithCharts;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;

class GraphExcel implements WithCharts
{
    public function charts()
    {
        $label      = [new DataSeriesValues('String', 'Worksheet!$B$1', null, 1)];
        $categories = [new DataSeriesValues('String', 'Worksheet!$B$2:$B$5', null, 4)];
        $values     = [new DataSeriesValues('Number', 'Worksheet!$A$2:$A$5', null, 4)];

        $series = new DataSeries(DataSeries::TYPE_PIECHART, DataSeries::GROUPING_STANDARD,
            range(0, \count($values) - 1), $label, $categories, $values);
        $plot   = new PlotArea(null, [$series]);

        $legend = new Legend();
        $chart  = new Chart('chart name', new Title('chart title'), $legend, $plot);
        $chart2 = new Chart('chart 2 name', new Title('chart 2 title'), $legend, $plot);

        return [$chart, $chart2];
    }
}