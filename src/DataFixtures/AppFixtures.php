<?php 

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

      //Fixtures formulaire de contact
      for( $i=0; $i<6; $i++) {
        $contact = new Contact();
        $contact->setFirstname('Michel');
        $contact->setLastname('Blanc');
        $contact->setEmail('Michel@blanc.com');
        $contact->setSubject('Ma demande ' . $i);
        $contact->setMessage(
          'Le Lorem Ipsum est simplement du faux texte employé dans la composition
          et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de 
          l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble 
          des morceaux de texte pour réaliser un livre spécimen de polices de texte. 
          Il n\'a pas fait que survivre cinq siècles, mais s\'est aussi adapté à la bureautique informatique, sans que son contenu n\'en soit modifié.'
        );

        $manager->persist($contact);
        
      }
      
      $manager->flush();
    }
}

