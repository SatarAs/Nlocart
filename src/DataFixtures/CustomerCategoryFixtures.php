<?php

namespace App\DataFixtures;

use App\Entity\CustomerCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;

class CustomerCategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        $customer_Category = [
            [
                'id' => 1,
                'customer_category_label' => 'Particulier'
            ],
            [
                'id' => 2,
                'customer_category_label' => 'Professionnel'
            ]
        ];

        foreach ($customer_Category as $customerCatData) {
            $customCat = new CustomerCategory();
            $customCat->setId($customerCatData['id']);
            $customCat->setCustomerCategoryLabel($customerCatData['customer_category_label']);

            $manager->persist($customCat);

            $metaData = $manager->getClassMetadata(get_class($customCat));
            $metaData->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
            $metaData->setIdGenerator(new AssignedGenerator());

            $this->setReference('CustomerCat_' . $customerCatData['customer_category_label'], $customCat);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['categories'];
    }

}
