<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 21/01/2015
 * Time: 13:17
 */

namespace AppBundle\Service;

class TopUserHandler extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('gametopuser',
                [$this, 'renderTopUser'],
                ['needs_environment' => true, 'is_safe' => array('html')]
            ),
        );
    }

    public function renderTopUser(\Twig_Environment $twig)
    {
        $users = [
            ["username" => "Robert"],
            ["username" => "Maurice"],
            ["username" => "Jean"],
            ["username" => "Albert"],
            ["username" => "Alain"],
        ];

        return $twig->render("game/lastUser.html.twig", ['users' => $users]);
    }

    public function getName()
    {
        return 'game_top_user';
    }

}