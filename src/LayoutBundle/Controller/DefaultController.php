<?php

namespace LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LayoutBundle:Default:index.html.twig');
    }

    public function productAction()
    {
        return $this->render('LayoutBundle:Default:product.html.twig');
    }
    public function detailAction()
    {
        return $this->render('LayoutBundle:Default:detail.html.twig');
    }

}
