<?php 
// src/Form/UserType.php
namespace App\Form;

use App\Entity\Survey;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditSurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('slug', TextType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Build' => 0,
                    'Publish' => 1,
                    'Summary' => 2
                ]
            ])
            ->add('entry_text', TextareaType::class, [
                'attr' => [
                    'class' => 'text-editor'
                ]
            ])
            ->add('ending_text', TextareaType::class, [
                'attr' => [
                    'class' => 'text-editor'
                ]
            ])
            ->add('date_start', TextType::class, [
                'attr' => [
                    'class' => 'datetimepicker'
                ]
            ])
            ->add('date_end', TextType::class, [
                'attr' => [
                    'class' => 'datetimepicker'
                ]
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Survey::class,
        ));
    }
}