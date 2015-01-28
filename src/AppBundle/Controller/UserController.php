<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @param $username
     *
     * @Route("/profile/{username}", name="profile")
     * @Method("GET")
     * @Security("is_granted('ACCESS_PROFILE', profile)")
     */
    public function profileAction(User $profile) {
        var_dump($profile);die;
    }

    /**
     * @Route("/login", name="signin")
     * @Method("GET")
     */
    public function signinAction() {
        $utils = $this->get('security.authentication_utils');

        return $this->render('user/signin.html.twig', [
            'last_username' => $utils->getLastUsername(),
            'error' => $utils->getLastAuthenticationError(),
        ]);
    }

    /**
     * @Route("/login-check", name="signin_check")
     * @Method("POST")
     */
    public function loginCheckAction() {
        //Never invoked
    }

    /**
     * @Route("/logout", name="signout")
     * @Method("GET")
     */
    public function signoutAction() {
        //Never invoked. Firewall magically handles this.
    }

    /**
     * @param Request $request
     *
     * @Route("/signup", name="signup")
     * @Method({ "GET", "POST" })
     */
    public function signupAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm('user', $user);
        $form->add('submit', 'submit');
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get("user_manager")->updateUser($user);

            $translator = $this->get('translator');
            $this->addFlash('success', $translator->trans('user.account.created'));

            return $this->redirectToRoute('game_play');
        }

        return $this->render('user/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Cache(smaxage=60)
     */
    public function lastUsersAction()
    {
        $users = [
            [ 'username' => 'John Smith' ],
            [ 'username' => 'Hugo Hamon' ],
            [ 'username' => 'Fabien Potencier' ],
            [ 'username' => 'Bart Simpson' ],
        ];

        return $this->render('user/users.html.twig', [ 'users' => $users ]);
    }
}
