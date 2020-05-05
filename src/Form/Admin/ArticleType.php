<?php

namespace App\Form\Admin;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'placeholder' => 'Choisir une categorie',
                'label' => 'form.category'
            ])
            ->add('content', TextareaType::class,[
                'label' => 'form.category'
            ])
            ->add('file', FileType::class,[
            'required' => is_null($builder->getData()->getId())])
            ->add('isActive', CheckboxType::class, [
                'required' => false,
                'label' => 'Public ?'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'validation_group'=>function(FormInterface $form){

                if($form->getData()->getId() === null) {
                    return ['Default', 'create'];
                }

                return ['Default'];
            }
        ]);
    }
}
