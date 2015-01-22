<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 20/01/2015
 * Time: 16:25
 */

namespace AppBundle\Controller;


use AppBundle\Form\Model\SupportRequest;
use AppBundle\Form\Type\SupportRequestType;
use AppBundle\Service\SupportRequestHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
     * @param Request $request
     *
     * @Route("/contact", name="contact")
     * @Method({"GET", "POST"})
     */
    public function contactAction(Request $request) {
        $support = new SupportRequest();
        $form = $this->createForm(new SupportRequestType(), $support);
        $form->add('submit', 'submit');
        $form->add('reset', 'reset');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("support_request_handler")->handleSupportRequest($support);
            $this->redirectToRoute("contact");
        }

        return $this->render('contact/support.html.twig', ['form' => $form->createView()]);
    }
}