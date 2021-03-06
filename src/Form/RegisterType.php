<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'mb-3'],
                'constraints' => new NotBlank([
                    'message' => 'Veuillez renseigner une adresse mail valide.'
                ])
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => ['class' => 'mb-3'],
                'constraints' => new NotBlank([
                    'message' => 'Veuillez renseigner un mot de passe.'
                ])
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'mb-3'],
                'constraints' => new NotBlank([
                    'message' => 'Veuillez renseigner un prénom.'
                ])
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'mb-3'],
                'constraints' => new NotBlank([
                    'message' => 'Veuillez renseigner un nom.'
                ])
            ])
            ->add('cgu',CheckboxType::class, [
                'label' => "J'accèpte les CGU",
                'mapped' => false,
                'constraints' => new IsTrue([
                    'message' => 'Veuillez accepter les CGU.'
                ])
            ])
            ->add("save", SubmitType::class, [
                'label' => 'Créer mon compte',
                'attr' => ['class' => 'btn btn-lg btn-primary my-3'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
