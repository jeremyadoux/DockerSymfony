<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 20/01/2015
 * Time: 09:45
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @param int $max
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lastUserAction($max = 5) {
        $users = [
            ["username" => "Robert"],
            ["username" => "Maurice"],
            ["username" => "Jean"],
            ["username" => "Albert"],
            ["username" => "Alain"],
        ];

        return $this->render("game/lastUser.html.twig", ['users' => $users]);
    }
} 