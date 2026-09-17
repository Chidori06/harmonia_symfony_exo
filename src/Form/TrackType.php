<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Genre;
use App\Entity\Playlist;
use App\Entity\Track;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => "Nom de la chanson"
            ])
            ->add('duration', null, [
                'label' => "Durée"
            ])
            ->add('numberTrack', null, [
                'label' => "Numéro de piste"
            ])
            ->add('isExplicit', null, [
                'required' => false,
                'label' => 'Contenu explicite',
            ])
            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'label',
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Track::class,
        ]);
    }
}
