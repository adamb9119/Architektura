<?php 
// src/Form/UserType.php
namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class QuestionNewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Text' => Question::TYPE_TEXT,
                    'Single choice' => Question::TYPE_SINGLE_CHOICE,
                    'Multiple choice' => Question::TYPE_MULTIPLE_CHOICE,
                    'Open' => Question::TYPE_OPEN,
                ],
                'placeholder' => 'Choose type',
            ])
            ->add('add', SubmitType::class, [
                'attr' => [
                    'class' => 'btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Question::class,
        ));
    }
}