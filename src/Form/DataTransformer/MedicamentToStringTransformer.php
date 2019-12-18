<?php


namespace App\Form\DataTransformer;


use App\Entity\Medicaments;
use App\Repository\MedicamentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class MedicamentToStringTransformer implements DataTransformerInterface
{
    /**
     * @var MedicamentsRepository
     */
    private $medicamentsRepository;

    public function __construct(MedicamentsRepository $medicamentsRepository)
    {
        $this->medicamentsRepository = $medicamentsRepository;
    }

    public function transform($medicament)
    {
        if (null === $medicament) {
            return '';
        }

        return $medicament->getNom();
    }

    public function reverseTransform($medicamentNom)
    {
        if (!$medicamentNom) {
            return;
        }

        $medicament = $this->medicamentsRepository->findOneByNom($medicamentNom);

        if (null === $medicament) {
            // causes a validation error
            // this message is not shown to the user
            // see the invalid_message option
            throw new TransformationFailedException(sprintf(
                'Le médicament "%s" n\'existe pas',
                $medicamentNom
            ));
        }

        return $medicament;
    }
}