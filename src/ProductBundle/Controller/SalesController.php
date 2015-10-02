<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SalesController extends Controller
{
    public function topsalesAction()
    {
        return $this->render('ProductBundle:Sales:topsales.html.twig', 
        	array());    
    }

    public function newcomerAction()
    {
        return $this->render('ProductBundle:Sales:newcomer.html.twig', 
        	array());    
    }

    public function recomendedAction()
    {
        return $this->render('ProductBundle:Sales:recomended.html.twig', 
        	array());    
    }
}
