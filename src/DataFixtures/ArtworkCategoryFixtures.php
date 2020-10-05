<?php

namespace App\DataFixtures;

use App\Entity\ArtworkCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

class ArtworkCategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $category_Artworks = [
            [
                'id' => 1,
                'artwork_category_label' => 'Tableau'
            ],
            [
                'id' => 2,
                'artwork_category_label' => 'Sculpture'
            ],
            [
                'id' => 3,
                'artwork_category_label' => 'Mobilier'
            ],
        ];

        foreach ($category_Artworks as $categoryData) {
            $category = new ArtworkCategory();
            $category->setId($categoryData['id']);
            $category->setArtworkCategoryLabel($categoryData['artwork_category_label']);

            $manager->persist($category);

            $metaData = $manager->getClassMetadata(get_class($category));
            $metaData->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
            $metaData->setIdGenerator(new AssignedGenerator());

            $this->setReference('Category_' . $categoryData['artwork_category_label'], $category);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['categories'];
    }
}
