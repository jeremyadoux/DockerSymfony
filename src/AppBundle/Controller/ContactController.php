<?php

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
     * @Method({ "GET", "POST" })
     */
    public function contactAction(Request $request)
    {
        $support = new SupportRequest();
        $form = $this->createForm('support_request', $support);
        $form->add('submit', 'submit');
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $this->get('support_request_handler')->handleSupportRequest($support);

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/support.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
