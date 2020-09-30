<?php

namespace App\DataFixtures;

use App\Entity\ArtworkTechnical;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

class ArtworkTechnicalFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $technical_Artworks = [
            [
                'id' => 1,
                'artwork_technical_label' => 'Aérosol'
            ],
            [
                'id' => 2,
                'artwork_technical_label' => 'Encre'
            ],
            [
                'id' => 3,
                'artwork_technical_label' => 'Acrylique'
            ],
            [
                'id' => 4,
                'artwork_technical_label' => 'Bitume'
            ],
            [
                'id' => 5,
                'artwork_technical_label' => 'Canevas'
            ],
            [
                'id' => 6,
                'artwork_technical_label' => 'Collage'
            ],
            [
                'id' => 7,
                'artwork_technical_label' => 'Crayon'
            ],
            [
                'id' => 8,
                'artwork_technical_label' => 'Impression'
            ]
        ];

        foreach ($technical_Artworks as $technicalData) {
            $technical = new ArtworkTechnical();
            $technical->setId($technicalData['id']);
            $technical->setArtworkTechnicalLabel($technicalData['artwork_technical_label']);

            $manager->persist($technical);

            $metaData = $manager->getClassMetadata(get_class($technical));
            $metaData->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
            $metaData->setIdGenerator(new AssignedGenerator());

            $this->setReference('Technical_' . $technicalData['artwork_technical_label'], $technical);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['categories'];
    }
}
