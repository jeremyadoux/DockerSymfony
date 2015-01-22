<?php
/**
 * Created by PhpStorm.
 * User: jadoux
 * Date: 20/01/2015
 * Time: 16:31
 */

namespace AppBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SupportRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', 'text', [
                'label' => 'contact.fullName.label'
            ])
            ->add('emailAddress', 'email')
            ->add('subject', 'text')
            ->add('body', 'textarea', [
                'attr' => [
                    'rows' => 15,
                    'cols' => 40,
                ],
            ])
            ->add('screenshot', 'file', [
                'required' => false,
            ])
        ;
    }

    public function getName() {
        return 'support_request';
    }
}