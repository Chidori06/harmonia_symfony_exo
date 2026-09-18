<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => "Nom de l'album"
            ])
            ->add('releaseAt', null, [
                'widget' => 'single_text',
                'label' => 'Date de sortie'
            ])
            ->add('cover', FileType::class, [
                "label" => "Image",
                "mapped" => false,
                "required" => false
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'EP' => 'EP',
                    'Single' => 'Single',
                    'Album' => 'Album',
                ],
                'placeholder' => 'Choisir un type',
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
