<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 21/01/2015
 * Time: 10:17
 */

namespace AppBundle\Service;

use AppBundle\Form\Model\SupportRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class SupportRequestHandler
{
    private $mailer;
    private $uploadDir;
    private $recipient;

    public function __construct(\Swift_Mailer $mailer, $uploadDir, $recipient)
    {
        $this->mailer = $mailer;
        $this->uploadDir = $uploadDir;
        $this->recipient = $recipient;
    }

    public function handleSupportRequest(SupportRequest $support) {
        if($support->screenshot instanceof UploadedFile) {
            $ext = $support->screenshot->guessExtension();
            $name = md5(uniqid()) . "." . $ext;
            $file = $support->screenshot->move($this->uploadDir, $name);
        }

        $mail = \Swift_Message::newInstance()
            ->setFrom($support->emailAddress, $support->fullName)
            ->setTo($this->recipient)
            ->setSubject($support->subject)
            ->setBody($support->body)
        ;
        if(isset($file)) {
            $mail->attach(\Swift_Attachment::fromPath($file->getRealPath()));
        }

        return $this->mailer->send($mail);
    }
}