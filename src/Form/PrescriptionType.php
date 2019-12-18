<?php

namespace App\Form;

use App\Entity\Prescription;
use App\Form\DataTransformer\MedicamentToStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrescriptionType extends AbstractType
{
    /**
     * @var MedicamentToStringTransformer
     */
    private $transformer;

    public function __construct(MedicamentToStringTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('registrationDate',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'label' => "Début du traitement",
                ])

            ->add('treatmentDuration',
                TextType::class,
                [
                    'label' => "Durée du traitement (jours)",
                ])

            ->add('frequency',
                TextType::class,
                [
                    'label' => "Nombre de fois par jours"
                ])

            ->add('medicaments',
                TextType::class,
                [
                    'label' => 'Médicaments'
                ])
        ;

        $builder->get('medicaments')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prescription::class,
        ]);
    }
}
