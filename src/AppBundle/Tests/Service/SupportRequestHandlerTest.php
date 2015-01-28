<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 21/01/2015
 * Time: 16:22
 */

namespace AppBundle\Tests\Service;


use AppBundle\Form\Model\SupportRequest;
use AppBundle\Service\SupportRequestHandler;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SupportRequestHandlerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCannotConstructIfUploadDirDoesntExistOrIsNotWritable() {
        $mailer = new \Swift_Mailer(new \Swift_NullTransport());
        new SupportRequestHandler($mailer, '/foo/bar', 'foo@bar.com');
    }

    public function testSendSimpleSupportRequestMessage() {
        $mailer = new \Swift_Mailer(new \Swift_NullTransport());

        $request = new SupportRequest();
        $request->fullName = 'John smith';
        $request->emailAddress = 'john@john.fr';
        $request->subject = "Support";
        $request->body = 'request';

        $handler = new SupportRequestHandler($mailer, null, 'foo@bar.com');

        $this->assertSame(1, $handler->handleSupportRequest($request));
    }

    public function testSendFullSupportRequestMessage() {
        $mailer = new \Swift_Mailer(new \Swift_NullTransport());

        $fs = new Filesystem();
        $fs->copy(__DIR__.'/../Fixtures/local/default.png', __DIR__.'/../Fixtures/local/screenshot.png');

        $request = new SupportRequest();
        $request->fullName = 'John smith';
        $request->emailAddress = 'john@john.fr';
        $request->subject = "Support";
        $request->body = 'request';
        $request->screenshot = new UploadedFile(
            __DIR__.'/../Fixtures/local/screenshot.png',
            'screenshot.png',
            null,
            null,
            UPLOAD_ERR_OK,
            true
        );

        $target = __DIR__.'/../Fixtures/remote';

        $handler = new SupportRequestHandler($mailer, $target, 'foo@bar.com');

        $this->assertSame(1, $handler->handleSupportRequest($request));
        $this->assertCount(1, new \GlobIterator($target.'/*.png'));

        $fs->remove(glob($target.'/*.png'));
    }
}
