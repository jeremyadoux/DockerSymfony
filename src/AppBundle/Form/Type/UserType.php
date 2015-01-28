<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\True;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', 'text')
            ->add('username', 'text')
            ->add('emailAddress', 'email')
            ->add('plainPassword', 'repeated', [
                'invalid_message' => 'user.password.mismatch',
                'type' => 'password',
                'first_options' => [ 'label' => 'Password' ],
                'second_options' => [ 'label' => 'Confirmation' ],
            ])
            ->add('birthdate', 'birthday', [
                'required' => false,
            ])
            ->add('cgu', 'checkbox', [
                'mapped' => false,
                'constraints' => [
                    new True([
                        'message' => 'user.cgu.must_accept',
                        'groups' => 'Signup',
                    ]),
                ],
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'validation_groups' => [ 'Signup', Constraint::DEFAULT_GROUP ],
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user';
    }
}
