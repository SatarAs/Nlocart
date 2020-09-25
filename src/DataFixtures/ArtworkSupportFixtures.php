<?php

namespace App\DataFixtures;

use App\Entity\ArtworkSupport;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

class ArtworkSupportFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $support_Artworks = [
            [
                'id' => 1,
                'artwork_support_label' => 'Affiche sur toile'
            ],
            [
                'id' => 2,
                'artwork_support_label' => 'Bois'
            ],
            [
                'id' => 3,
                'artwork_support_label' => 'Mobilier'
            ],
            [
                'id' => 4,
                'artwork_support_label' => 'Plaque Emaillée'
            ],
            [
                'id' => 5,
                'artwork_support_label' => 'Plexiglas'
            ],
            [
                'id' => 6,
                'artwork_support_label' => 'Rideau Métallique'
            ],
            [
                'id' => 7,
                'artwork_support_label' => 'Sculpture'
            ],
            [
                'id' => 8,
                'artwork_support_label' => 'Toile'
            ],
            [
                'id' => 9,
                'artwork_support_label' => 'Toile Plexiglas'
            ],
            [
                'id' => 10,
                'artwork_support_label' => 'Tôle en fer'
            ],
            [
                'id' => 11,
                'artwork_support_label' => 'Tôle Peinte'
            ]
        ];

        foreach ($support_Artworks as $supportData) {
            $support = new ArtworkSupport();
            $support->setId($supportData['id']);
            $support->setArtworkSupportLabel($supportData['artwork_support_label']);

            $manager->persist($support);

            $metaData = $manager->getClassMetadata(get_class($support));
            $metaData->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
            $metaData->setIdGenerator(new AssignedGenerator());

            $this->setReference('Support_' . $supportData['artwork_support_label'], $support);
        }

        $manager->flush();
    }
}
