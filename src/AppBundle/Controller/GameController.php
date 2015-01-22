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
use Symfony\Component\HttpFoundation\Request;

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
        $game = $this->get('game_runner')->loadGame();
        return $this->render('game/play.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/win", name="game_win")
     * @Method("GET")
     */
    public function winAction()
    {
        $game =  $this->get('game_runner')->resetGameOnSuccess();

        return $this->render('game/win.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/fail", name="game_fail")
     * @Method("GET")
     */
    public function failAction()
    {
        $game =  $this->get('game_runner')->resetGameOnFailure();

        return $this->render('game/fail.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/reset", name="game_reset")
     * @Method("GET")
     */
    public function resetAction()
    {
        $this->get('game_runner')->resetGame();

        return $this->redirectToRoute("game_play");
    }

    /**
     * @Route("/play/{letter}", name="game_play_letter",
     * requirements={
     *      "letter"="[a-z]"
     * })
     * @Method("GET")
     */
    public function playLetterAction($letter)
    {
        $game =  $this->get('game_runner')->playLetter($letter);

        return $this->redirectToRoute($game->isHanged() ? "game_fail" : "game_play");
    }

    /**
     * @Route("/play", name="game_play_word", condition="request.request.has('word')")
     * @Method("POST")
     */
    public function playWordAction(Request $request)
    {
        $game =  $this->get('game_runner')->playWord($request->request->get("word"));

        return $this->redirectToRoute($game->isWon() ? "game_win" : "game_fail");
    }
}
