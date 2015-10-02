<?php

namespace ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ProductBundle\Entity\ProductCategory;
use ProductBundle\Form\ProductCategoryType;

/**
 * ProductCategory controller.
 *
 */
class ProductCategoryController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ProductBundle:ProductCategory')->findAll();

        return $this->render('ProductBundle:ProductCategory:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProductBundle:ProductCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCategory entity.');
        }

        return $this->render('ProductBundle:ProductCategory:show.html.twig', array(
            'entity'      => $entity
        ));
    }

   
}
