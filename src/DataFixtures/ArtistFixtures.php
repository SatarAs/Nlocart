<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $artistFix = [
            [
                'id' => 1,
                'customer_id' => $this->getReference('Customer_Ecloz'),
                'artist_biography' => 'Bonjour, je m\'appelle Guillaume Vincent et mon pseudo est Ecloz.
                    Pour mon projet, voici Nlocart !',
                'artist_website' => 'https://ecloz.fr'
            ],
            [
                'id' => 2,
                 'customer_id' => $this->getReference('Customer_SatarAs'),
                'artist_biography' => 'Bonjour, je m\'appelle Nathan Hégo et mon pseudo est SatarAs.',
                'artist_website' => 'https://sataras.fr'
            ]
        ];

        foreach ($artistFix as $artistData) {
            $artist = new Artist();
            $artist->setId($artistData['id']);
            $artist->setCustomer($artistData['customer_id']);
            $artist->setArtistBiography($artistData['artist_biography']);
            $artist->setArtistWebsite($artistData['artist_website']);

            $manager->persist($artist);

            $metaData = $manager->getClassMetadata(get_class($artist));
            $metaData->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
            $metaData->setIdGenerator(new AssignedGenerator());


            $this->setReference('Artist_' . $artistData['id'], $artist);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CustomerFixtures::class
        );
    }

    public static function getGroups(): array
    {
    return ['categories'];
    }

}
