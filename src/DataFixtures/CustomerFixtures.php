<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Id\AssignedGenerator;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\fr_FR\PhoneNumber;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CustomerFixtures extends Fixture implements DependentFixtureInterface, FixtureGroupInterface
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        $phone = PhoneNumber::randomNumber(8, true);

        $array = array("Particulier", "Professionnel");



        $customerFix = [
            [
                'customer_category' => $this->getReference("CustomerCat_Professionnel"),
                'customer_last_name' => 'Vincent',
                'customer_first_name' => 'Guillaume',
                'customer_nickname' => 'Ecloz',
                'customer_email' => 'ecloze@hotmail.fr',
                'password' => 'test1',
                'customer_phone_home' => null,
                'customer_cell_home' => '06 85 84 24 04',
                'customer_company' => null,
                'customer_siret_company' => null,
                'id' => 1
            ],
            [
                'customer_category' => $this->getReference("CustomerCat_Particulier"),
                'customer_last_name' => 'Hégo',
                'customer_first_name' => 'Nathan',
                'customer_nickname' => 'SatarAs',
                'customer_email' => 'satar09@hotmail.fr',
                'password' => 'test2',
                'customer_phone_home' => null,
                'customer_cell_home' => '07 71 87 98 76',
                'customer_company' => null,
                'customer_siret_company' => null,
                'id' => 2
            ],
        ];

        for ($i = 3; $i <= 50; $i++) {
            $customerFaker = [
                'customer_category' => $this->getReference("CustomerCat_" . $array[rand(0, count($array) - 1)]),
                'customer_last_name' => $faker->lastName,
                'customer_first_name' => $faker->firstName,
                'customer_nickname' => $faker->userName,
                'customer_email' => $faker->email,
                'password' => 'test-faker',
                'customer_phone_home' => "02" . rand($phone, 9999999),
                'customer_cell_home' => "06" . rand($phone, 9999999),
                'customer_company' => $faker->companySuffix || null,
                'customer_siret_company' => (12345678910000 + rand(0,9999)),
                'id' => $i
            ];
            $customerFix[] = $customerFaker;
        }

        foreach ($customerFix as $customerData) {
            $customer = new Customer();
            $customer->setId($customerData['id']);
            $customer->setCustomerCategory($customerData['customer_category']);
            $customer->setCustomerLastName($customerData['customer_last_name']);
            $customer->setCustomerFirstName($customerData['customer_first_name']);
            $customer->setCustomerNickname($customerData['customer_nickname']);
            $customer->setCustomerEmail($customerData['customer_email']);
            $customer->setPassword($this->passwordEncoder->encodePassword($customer, $customerData['password']));
            $customer->setCustomerPhoneHome($customerData['customer_phone_home']);
            $customer->setCustomerCellPhone($customerData['customer_cell_home']);
            $customer->setCustomerCompany($customerData['customer_company']);
            $customer->setCustomerSiretCompany($customerData['customer_siret_company']);

            $manager->persist($customer);

            $metaData = $manager->getClassMetadata(get_class($customer));
            $metaData->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
            $metaData->setIdGenerator(new AssignedGenerator());
            $this->setReference('Customer_' . $customerData['customer_nickname'], $customer);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CustomerCategoryFixtures::class
        );
    }

    public static function getGroups(): array
    {
      return ['categories'];
    }
}
