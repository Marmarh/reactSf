<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\Invoice;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{   /**
    *
    *
    * @var UserPasswordEcoderIterface
    */
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');


        for($u = 0;$u<10; $u++){
           

            $user = new User();
            $chrono = 1;
            $hash = $this->encoder->encodePassword($user,"password");
            $user->setFirstName($faker->firstName())
            
         
            ->setEmail($faker->email)
            
            ->setPassword($hash);

            $manager->persist($user);

            for($c = 0;$c <mt_rand(5,10); $c++){
                $customer = new Customer();
                $customer->setFirstName($faker->FirstName())
                         ->setLastName($faker->LastName)
                         ->setEmail($faker->email)
                         ->setUser($user)
                         ->setCompany($faker->Company) ;
                         
                          
                         $manager->persist($customer);
            }
          
    
            for($i = 0;$i < mt_rand(3,10);$i++)
            {
              
               $invoice = new Invoice();
               $invoice->setAmount($faker->randomFloat(2,250,5000))
               ->setSentAt($faker->dateTimeBetween('-6 months'))
               ->setStatus($faker->randomElement(['SENT','PAID','CANCELED']))
              
    
               ->setCustomer($customer)
               ->setChrono($chrono);
               $chrono++;
               
               $manager->persist($invoice);
            }
      
        }

        



                        
   $manager->flush();

        }
        // $product = new Product();
      // $manager->persist($product);

     
    
}
