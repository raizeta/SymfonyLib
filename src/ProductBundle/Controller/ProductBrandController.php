<?php

namespace ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ProductBundle\Entity\ProductBrand;
use ProductBundle\Form\ProductBrandType;

/**
 * ProductBrand controller.
 *
 */
class ProductBrandController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ProductBundle:ProductBrand')->findAll();

  

        return $this->render('ProductBundle:ProductBrand:index.html.twig', array(
            'entities' => $entities,
        ));
    }
 
    public function showAction(Request $request,$slug)
    {
        $em = $this->getDoctrine()->getManager();
        $paginator  = $this->get('knp_paginator');
        $query = $em->createQuery("SELECT pb,p FROM ProductBundle:ProductBrand pb
                                                JOIN pb.products p WHERE (pb.brandName=:slug)"); 
                $query->setParameter('slug',$slug);

        $result = $query->getScalarResult();
        $entities = $paginator->paginate($result,$request->query->getInt('page', 1),3);
        if (!$result) 
        {
            throw $this->createNotFoundException('Unable to find ProductBrand entity.');
        }

        return $this->render('ProductBundle:ProductBrand:show.html.twig', array(
            'entities'      => $entities
        ));
    }


}
