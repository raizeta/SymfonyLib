<?php

namespace ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ProductBundle\Entity\Product;
use ProductBundle\Form\ProductType;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $paginator  = $this->get('knp_paginator');
        $query = $em->getRepository('ProductBundle:Product')->findAll();
        $entities = $paginator->paginate($query,$request->query->getInt('page', 1),12);
        return $this->render('ProductBundle:Product:index.html.twig', array(
            'entities' => $entities));
    }
   

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProductBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        return $this->render('ProductBundle:Product:show.html.twig', array(
            'entity'      => $entity
        ));
    }

   
}
