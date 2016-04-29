<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 22/10/15
 * Time: 12:44
 */

namespace MRS\ControleBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Ob\HighchartsBundle\Highcharts\Highchart;

class ChartService
{
    private $container;


    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getPie()
    {
        //Chart
        $pie = new Highchart();
        $pie->chart->renderTo('pie');

        $pie->credits->enabled = false;

        $pie->title->text('Browser market shares at a specific website in 2010');


        $pie->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true,
        ));

        $data = [
            ['Firefox', 12.0],
            ['IE', 26.8],
            ['Chrome', 45.8],
            ['Safari', 8.5],
            ['Opera', 6.2],
            ['Others', 9.7]
        ];


        $pie->series(array(array('type' => 'pie', 'name' => 'Browser share', 'data' => $data)));

        return $pie;
    }


    public function getLines()
    {

        //Series
        $series = array(
        array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $lines = new Highchart();
        $lines->chart->renderTo('lines');  // The #id of the div where to render the chart
        $lines->title->text('Chart Title');
        $lines->xAxis->title(array('text'  => "Horizontal axis title"));
        $lines->yAxis->title(array('text'  => "Vertical axis title"));
        $lines->series($series);

        return $lines;

    }



}