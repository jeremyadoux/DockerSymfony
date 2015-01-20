<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/hello")
     * @Route("/hello/{name}", name="hello_world")
     */
    public function indexAction(Request $request, $name = "World")
    {
        return $this->render('default/index.html.twig', ["name" => $name]);
        //return new Response('<html><body>Hello '.$name.'</body></html>'); //$this->render('default/index.html.twig');
    }
}
