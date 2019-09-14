<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Gif;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GifAddForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', null, [
                'attr' => [
                    'class' => 'input100',
                    'required' => true,
                    'autofocus' => true,
                    'data-kwimpalastatus' => 'alive',
                    'data-kwimpalaid' => '1568393576290-3'
                ],
                'label_attr' => [
                    'class' => 'label-input100',
                ],
            ])
            ->add('album', EntityType::class, [
                'class' => Album::class,
                'choice_label' => 'title',
                'attr' => [
                    'class' => 'input100',
                    'required' => true,
                    'autofocus' => true,
                    'data-kwimpalastatus' => 'alive',
                    'data-kwimpalaid' => '1568393576290-3'
                ],
                'label_attr' => [
                    'class' => 'label-input100',
                ],
            ])
            ->add('tags', null, [
                'attr' => [
                    'class' => 'input100',
                    'required' => true,
                    'autofocus' => true,
                    'data-kwimpalastatus' => 'alive',
                    'data-kwimpalaid' => '1568393576290-3'
                ],
                'label_attr' => [
                    'class' => 'label-input100',
                ]
            ])
        ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gif::class,
        ]);
    }
}
