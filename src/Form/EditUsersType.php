<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname',
                TextType::class,
                [
                    'label' => 'Nom'
                ]
            )
            ->add('firstname',
                TextType::class,
                [
                    'label' => 'Prénom'
                ]
            )
            ->add('nickname',
                TextType::class,
                [
                    'label' => 'Pseudo'
                ]
            )
            ->add('email',
                TextType::class,
                [
                    'label' => 'Email'
                ]
            )
            ->add('status',
                ChoiceType::class,
                [
                    'label' => 'Statut',
                    'choices' => [
                        'Utilisateur' => 'ROLE_USER',
                        'Administrateur' => 'ROLE_ADMIN'
                    ]

                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
