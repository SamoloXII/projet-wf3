<?php

namespace App\Form;

use App\Entity\Medicaments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjoutMedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',
                TextType::class,
                [
                    'label' => 'Nom du médicament'
                ])
            ->add('type',
                TextType::class,
                [
                    'label' => 'Type'
                ])
            ->add('prix',
                NumberType::class,
                [
                    'label' => 'Prix en €'
                ])
            ->add('descriptionCourte',
                TextareaType::class,
                [
                    'label' => 'Description courte du médicament'
                ])
            ->add('image',
                FileType::class,
                [
                    'label' => 'Image du médicament',
                    'required' => false
                ])
            ->add('substanceActive',
                TextType::class,
                [
                    'label' => 'Substance active'
                ])
            ->add('dosageSubstance',
                TextType::class,
                [
                    'label' => 'Dosage de la substance active'
                ])
            ->add('methodeUtilisation',
                ChoiceType::class, [
                    'label' => 'méthode d\'utilisation',
                    'choices' => [
                        'Orale' => 'Orale',
                        'Buccale' => 'Buccale',
                        'Rectale' => 'Rectale',
                        'Inhalation' => 'Inhalation',
                        'Nasale' => 'Nasale',
                        'Cutanée' => 'Cutanée',
                        'Ophtalmique' => 'Ophtalmique']
                    ]
                )
            ->add('tauxRemboursement',
                TextType::class,
                [
                    'label' => 'Taux de remboursement (%)'
                ])
            ->add('symptomes',
                TextareaType::class,
                [
                    'label' => 'Symptômes'
                ])
            ->add('contreIndications',
                TextareaType::class,
                [
                    'label' => 'Contre indications'
                ])
            ->add('effetsIndesirables',
                TextareaType::class,
                [
                    'label' => 'Effets indésirables possibles'
                ])
            ->add('conservation',
                TextType::class,
                [
                    'label' => 'Conservation (mois, température, précaution particulière)'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medicaments::class,
        ]);
    }
}
