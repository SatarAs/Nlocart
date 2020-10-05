<?php

namespace App\DataFixtures;

use App\Entity\TechArtwork;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

class ArtworkTechFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {

        for ($i = 1; $i <= 30; $i++) {
            $artworkFix = [
                [
                    'artwork' => $this->getReference('Artwork_' . $i),
                    'artwork_technical' => $this->getReference("Technical_" . rand(1, 8))
                ]
            ];

            foreach ($artworkFix as $artworksTechData) {
                $artwork = new TechArtwork();
                $artwork->setId($i);
                $artwork->setArtwork($artworksTechData['artwork']);
                $artwork->setArtworkTechnical($artworksTechData['artwork_technical']);

                $manager->persist($artwork);

                $metaData = $manager->getClassMetadata(get_class($artwork));
                $metaData->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metaData->setIdGenerator(new AssignedGenerator());

                $this->setReference('ArtworkTech_' . $i, $artwork);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ArtworkFixtures::class,
            ArtworkTechnicalFixtures::class
        );
    }

    public static function getGroups(): array
    {
        return ['categories'];
    }
}
