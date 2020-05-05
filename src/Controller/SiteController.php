<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route(name="site_")
 */
class SiteController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index() : Response
    {
        return $this->render('site/index.html.twig');
    }

     /**
     * @Route("/a-propos", name="about")
     */
    public function about() : Response
    {
        return $this->render('site/about.html.twig');
    }
}
