<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $artistFix = [
            [
                'id' => 1,
                'artist_last_name' => 'Vincent',
                'artist_first_name' => 'Guillaume',
                'artist_nickname' => 'Ecloz',
                'artist_email' => 'ecloze@hotmail.fr',
                'artist_biography' => 'Bonjour, je m\'appelle Guillaume Vincent et mon pseudo est Ecloz.
                    Pour mon projet, voici Nlocart !',
                'artist_phone_home' => null,
                'artist_cell_phone' => '06 85 84 24 04',
                'artist_website' => 'https://ecloz.fr'
            ],
        ];

        foreach ($artistFix as $artistData) {
            $artist = new Artist();
            $artist->setId($artistData['id']);
            $artist->setArtistLastName($artistData['artist_last_name']);
            $artist->setArtistFirstName($artistData['artist_first_name']);
            $artist->setArtistNickname($artistData['artist_nickname']);
            $artist->setArtistEmail($artistData['artist_email']);
            $artist->setArtistBiography($artistData['artist_biography']);
            $artist->setArtistPhoneHome($artistData['artist_phone_home']);
            $artist->setArtistCellPhone($artistData['artist_cell_phone']);
            $artist->setArtistWebsite($artistData['artist_website']);

            $manager->persist($artist);

            $metaData = $manager->getClassMetadata(get_class($artist));
            $metaData->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
            $metaData->setIdGenerator(new AssignedGenerator());

            $this->setReference('Artist' . $artistData['artist_nickname'], $artist);
        }

        $manager->flush();
    }
}
