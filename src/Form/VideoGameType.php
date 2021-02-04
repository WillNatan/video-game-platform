<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\VideoGame;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
class VideoGameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,  ['attr'=>['class'=>'form-control']])
            ->add('description', TextareaType::class,  ['attr'=>['class'=>'form-control']])
            ->add('price', IntegerType::class,  ['attr'=>['class'=>'form-control']])
            ->add('trailerUrl', TextType::class,  ['attr'=>['class'=>'form-control']])
            ->add('image', FileType::class, [
                'label' => 'Image jeu',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez sélectionner une image png ou jpeg',
                    ])
                ],
            ])
            ->add('category', EntityType::class, ['attr'=>['class'=>'form-control'],'class'=> Category::class, 'choice_label'=>'name'] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VideoGame::class,
        ]);
    }
}
