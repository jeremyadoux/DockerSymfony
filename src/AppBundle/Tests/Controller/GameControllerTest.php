<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 22/01/2015
 * Time: 10:00
 */

namespace AppBundle\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class GameControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    public function testPlayCorrectWord() {
        $crawler = $this->client->request('GET', '/fr/game/play');
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertSame(8, $crawler->filter('li.hidden')->count());

        $form = $crawler->selectButton('Valider')->form();
        $form['word'] = 'software';
        $this->client->submit($form);
        $this->assertTrue($this->client->getResponse()->isRedirect('/fr/game/win'));
        $crawler = $this->client->followRedirect();

        $this->assertSame('Congratulations!', $crawler->filter('#content h2')->text());
    }

    protected function setUp() {
        parent::setUp();

        $this->client = static::createClient(
            [ 'debug' => true ],
            [ 'REMOTE_ADDR' => "1.1.1.1", 'HTTP_USER_AGENT' => 'Firefox']
        );
    }

    protected function tearDown() {
        $this->client = null;

        parent::tearDown();
    }
}