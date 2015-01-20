<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 20/01/2015
 * Time: 09:45
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class GameController
 *
 * @package AppBundle\Controller
 * @Route("/game")
 */
class GameController extends Controller
{

    /**
     * @Route("/")
     * @Route("/play", name="game_play")
     * @Method("GET")
     */
    public function playAction()
    {

    }

    /**
     * @Route("/win", name="game_win")
     * @Method("GET")
     */
    public function winAction()
    {

    }

    /**
     * @Route("/fail", name="game_fail")
     * @Method("GET")
     */
    public function failAction()
    {

    }

    /**
     * @Route("/reset", name="game_reset")
     * @Method("GET")
     */
    public function resetAction()
    {

    }

    /**
     * @Route("/play/letter", name="game_play_letter")
     * @Method("GET")
     */
    public function playLetterAction()
    {

    }

    /**
     * @Route("/play/word", name="game_play_word")
     * @Method("GET")
     */
    public function playWordAction()
    {

    }
}
