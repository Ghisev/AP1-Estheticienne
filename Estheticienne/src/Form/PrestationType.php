<?php

namespace App\Form;

use App\Entity\Prestation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('prix', MoneyType::class)
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Épilation Homme' => 1,
                    'Épilation Femme' => 2,
                    'Soins pieds et mains' => 3,
                ],
            ])
            ->add('categorie_img', ChoiceType::class, [
                'choices' => [
                    '1.png' => 1,
                    '2.png' => 2,
                    '3.png' => 3,
                    '4.png' => 4,
                    '5.png' => 5,
                    '6.png' => 6,
                    '7.png' => 7,
                    '8.png' => 8,
                    '9.png' => 9,
                    '10.png' => 10,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestation::class,
        ]);
    }
}
