<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 20/01/2015
 * Time: 16:29
 */

namespace AppBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class SupportRequest 
{
    /**
     * @var
     * @Assert\NotBlank
     * @Assert\Length(min=2, max=30)
     */
    public $fullName;

    /**
     * @var
     * @Assert\NotBlank
     * @Assert\Email()
     */
    public $emailAddress;

    public $subject;

    public $body;

    /**
     * @var
     * @Assert\Image(
     *      mimeTypes={"image/png", "image/jpg", "image/jpeg"}
     * )
     */
    public $screenshot;
}