<?php

namespace App\Form;

use App\Entity\Movie;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('title', null,[
                'label' => 'Nom du Film',
                'attr' => [
                    'placehorder' => 'Men In Black, Américan Pie, ...'
                ],
            ])

            ->add('realise_date', DateType::class ,[
                'label' => 'Date de Sortie',
            ])

            ->add('picture', FileType::class)

            ->add('duration', TimeType::class, [
                'label' => 'Durée moyenne',
                'hours' => range(0, 6),
                'minutes' => range(0, 55, 5),
                'attr' => [
                    'class' => 'form-aligned',
                ]
            ])
            ->add('type', null, [
                'label' => 'Catégorie'
            ])
            ->add('actor', TextType::class)
            ->add('producer', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
            'attr' => [ 'novalidate' => 'novalidate',]
        ]);
    }
}
