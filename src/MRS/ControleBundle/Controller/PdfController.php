<?php

namespace MRS\ControleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PdfController extends Controller
{
    /**
     * @Route("/pdfhorario/{id}", name="pdf_horario")
     */
    public function pdfHorarioAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MRSControleBundle:TbHorario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TbHorario entity.');
        }


        $html =  $this->renderView('@MRSControle/TbHorario/Pdf/show.html.twig',array(
            'entity'      => $entity,
        ));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Horario.pdf"'
            )
        );


    }

}
