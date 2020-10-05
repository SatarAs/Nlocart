<?php

namespace App\DataFixtures;

use App\Entity\Artwork;
use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ArtworkFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        $slugify = new Slugify();

        $files = glob('public/build/oeuvres/' . '*.{jpg,gif,png}', GLOB_BRACE);

        for ($i = 1; $i <= 30; $i++) {

            $randomPicture = $files[array_rand($files)];
            $test = $faker->name;
            $artworkFix = [
                [
                    'artwork_category' => $this->getReference("Category_Tableau"),
                    'artist' => $this->getReference('Artist_' . 2),
                    'artwork_support' => $this->getReference("Support_Bois"),
                    'artwork_name' => $test,
                    'artwork_picture' =>  $randomPicture,   //    OR    //$faker->imageUrl(640, 480, "abstract", true),
                    'artwork_creation_date' => new \DateTime('now'),
                    'artwork_height' => floatval(rand(0, 500)),
                    'artwork_width' => floatval(rand(0, 500)),
                    'artwork_depth' => floatval(rand(0, 500)),
                    'artwork_weight' => floatval(rand(0, 100)),
                    'artwork_sale_price' => $faker->randomNumber(rand(100, 20000) || null),
                    'artwork_rental_price' => $faker->randomNumber(rand(100, 10000) || null),
                    'artwork_description' => $faker->paragraph(5, true),
                    'artwork_availability' => boolval(mt_rand(0, 1)),
                    'artwork_special' => boolval(mt_rand(0, 1)),
                    'slug' => $slugify->slugify($test)
                ],
            ];

            foreach ($artworkFix as $artworksData) {
                $artwork = new Artwork();
                $artwork->setId($i);
                $artwork->setArtworkCategory($artworksData['artwork_category']);
                $artwork->setArtist($artworksData['artist']);
                $artwork->setArtworkSupport($artworksData['artwork_support']);
                $artwork->setArtworkName($artworksData['artwork_name']);
                $artwork->setArtworkPicture($artworksData['artwork_picture']);
                $artwork->setArtworkCreationDate($artworksData['artwork_creation_date']);
                $artwork->setArtworkHeight($artworksData['artwork_height']);
                $artwork->setArtworkWidth($artworksData['artwork_width']);
                $artwork->setArtworkDepth($artworksData['artwork_depth']);
                $artwork->setArtworkWeight($artworksData['artwork_weight']);
                $artwork->setArtworkSalePrice($artworksData['artwork_sale_price']);
                $artwork->setArtworkRentalPrice($artworksData['artwork_rental_price']);
                $artwork->setArtworkDescription($artworksData['artwork_description']);
                $artwork->setArtworkAvailability($artworksData['artwork_availability']);
                $artwork->setArtworkSpecial($artworksData['artwork_special']);
                $artwork->setSlug($artworksData['slug']);

                $manager->persist($artwork);

                $metaData = $manager->getClassMetadata(get_class($artwork));
                $metaData->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
                $metaData->setIdGenerator(new AssignedGenerator());

                $this->setReference('Artwork_' . $i, $artwork);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ArtistFixtures::class
        );
    }

    public static function getGroups(): array
    {
       return ['categories'];

    }

}
