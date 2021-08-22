<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Invoice;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($c = 0;$c <30; $c++){
            $customer = new Customer();
            $customer->setFirstName($faker->FirstName())
                     ->setLastName($faker->LastName)
                     ->setEmail($faker->email)
                     ->setCompany($faker->Company) ;
                      
                     $manager->persist($customer);
        }
      

        for($i = 0;$i < mt_rand(3,10);$i++)
        {
            $chrono = 1;
           $invoice = new Invoice();
           $invoice->setAmount($faker->randomFloat(2,250,5000))
           ->setSentAt($faker->dateTimeBetween('-6 months'))
           ->setStatus($faker->randomElement(['SENT','PAID','CANCELED']))
          

           ->setCustomer($customer)
           ->setChrono($chrono);
           $chrono++;
           
           $manager->persist($invoice);
        }
                     
   $manager->flush();

        }
        // $product = new Product();
      // $manager->persist($product);

     
    
}
