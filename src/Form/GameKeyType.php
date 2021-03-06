<?php

namespace App\Form;

use App\Entity\GameKey;
use App\Entity\VideoGame;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameKeyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gamekey', TextType::class,  ['attr'=>['class'=>'form-control']])
            ->add('videoGame', EntityType::class, ['attr'=>['class'=>'form-control'],'class' => VideoGame::class, 'choice_label' => 'name'])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GameKey::class,
        ]);
    }
}
