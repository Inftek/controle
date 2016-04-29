<?php
namespace MRS\ControleBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ob\HighchartsBundle\Highcharts\Highchart;

class SerializerController extends Controller
{
    /**
     * @return Response
     * @Route("/chartspie", name="charts_pie")
     */
    public function chartsPieAction()
    {
        $pie = new Highchart();
        $pie->chart->renderTo('pie');

        $pie->credits->enabled = false;

        $pie->title->text('Browser market shares at a specific website in 2010');



        $pie->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true,
        ));

        $data = [
            ['Firefox',12.0],
            ['IE', 26.8],
            ['Chrome',45.8],
            ['Safari' ,8.5],
            ['Opera' , 6.2],
            ['Others',9.7]
        ];


        $pie->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));


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



        return $this->render('MRSControleBundle:SerializerController:financas.html.twig', array(
                'pie' => $pie,
                'lines' => $lines
            ));
    }

    /**
     * @return Response
     * @Route("/chartslines", name="charts_lines")
     */
    public function chartsLineAction()
    {
        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text'  => "Horizontal axis title"));
        $ob->yAxis->title(array('text'  => "Vertical axis title"));
        $ob->series($series);

        return $this->render('::your_template.html.twig', array(
            'chart' => $ob
        ));

    }

    /**
     * @return \Doctrine\DBAL\Driver\Statement
     * @Route("/testesum", name="testesum")
     */
    public function viewTotalOnPeriodAction(Request $request)
    {

        //$this->denyAccessUnlessGranted('ROLE_ADMIN');

        $total = $this->get('financas.querynative')
                      ->sumTotalCostOnPeriod($request->get('dataInicial'),
                                             $request->get('dataFinal'));

        return new Response($total['Total']);
    }


}
