<?php

namespace Cron\UserInterface\Symfony\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('expression')
            ->add('url')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cron\Application\Command\CreateNewJobCommand',
            'csrf_protection'   => false,
            'allow_extra_fields' => true
        ));
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
