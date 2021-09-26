<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix'
            ])
//            ->add('createdAt', TextType::class, [
//                'mapped' => false
//            ])
            ->add('onSell', CheckboxType::class, [
                'label' => 'Je ne veux pas mettre mon produit à la vente pour le moment',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description'
            ])
            ->add('imgUrl', FileType::class, [
                'label' => 'Fichier image'
            ])
//            ->add('owner')
            ->add('save', SubmitType::class, [
                'label' => 'Ajouter le produit'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
