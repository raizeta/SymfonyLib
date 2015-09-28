<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
class GeneratorPDFController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProductBundle:Product')->findAll();
        if (!$entity) 
        {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $html = $this->renderView('ProductBundle:GeneratorPDF:index.html.twig',array('entity'=>$entity));
        $pdfgenerator= $this->get('knp_snappy.pdf');

		return new Response($pdfgenerator->getOutputFromHtml($html),200,
    		array('Content-Type'          => 'application/pdf',
    			'Content-Disposition'   => 'inline; filename="listproduct.pdf"'));
    }

}
