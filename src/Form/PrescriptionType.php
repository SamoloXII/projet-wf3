<?php

namespace App\Form;

use App\Entity\Prescription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrescriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('registrationDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'label' => "Date d'enregistrement",
                ])

            ->add('treatmentDuration',
                TextType::class,
                [
                    'label' => "Durée du traitement",
                ])

            ->add('frequency',
                TextType::class,
                [
                    'label' => "Fréquence"
                ])

            ->add('medicaments',
                TextType::class,
                [
                    'label' => 'Médicaments'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prescription::class,
        ]);
    }
}
