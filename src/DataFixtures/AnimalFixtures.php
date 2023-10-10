<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Especes;
use App\Entity\Continent;
use App\Entity\Personne;
use App\Entity\Possede;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

                                // Continents
// Création des continents
$c1 = new Continent();
$c1->setLibelle('Europe');
$manager->persist($c1);

$c2 = new Continent();
$c2->setLibelle('Afrique');
$manager->persist($c2);

$c3 = new Continent();
$c3->setLibelle('Asie');
$manager->persist($c3);

                                // Espèces
// Création des espèces
$e1 = new Especes();
$e1->setLibelle('Mammiferes')
    ->setDescription('Les Mammifères sont une classe d\'animaux vertébrés caractérisés 
    par la présence de fourrures (excepté pour certains mammifères marins), d\'une oreille 
    moyenne comportant trois os, d\'un néocortex et de glandes mammaires, dont les représentants 
    femelles nourrissent leurs juvéniles à partir d\'une sécrétion cutanéo-glandulaire spécialisée 
    appelée lait.');
$manager->persist($e1);
    
$e2 = new Especes();
$e2->setLibelle('Poissons')
    ->setDescription('Les poissons sont des animaux vertébrés aquatiques à branchies, 
    pourvus de nageoires dont le corps est généralement couvert d\'écailles. 
    On les trouve abondamment aussi bien dans les eaux douces, saumâtres et de mers');
$manager->persist($e2);

$e3 = new Especes();
$e3->setLibelle('Rongeurs')
    ->setDescription('Les rongeurs sont un ordre de mammifères placentaires. 
    Ces animaux se caractérisent par leur unique paire d\'incisives à croissance 
    continue sur chacune de leurs mâchoires, qui leur servent à ronger leur nourriture, 
    à creuser des galeries ou à se défendre. 
    Le reste de leur morphologie est relativement variable.');
$manager->persist($e3);

                                // Personnes
// Création des personnes
$personne1 = new Personne();
$personne1->setNom('Jean')->setPrenom('Dujardin');
$manager->persist($personne1);

$personne2 = new Personne();
$personne2->setNom('Pierre')->setPrenom('Cardin');
$manager->persist($personne2);

$personne3 = new Personne();
$personne3->setNom('Paul')->setPrenom('Simon');
$manager->persist($personne3);

                                // Animaux
// Création animaux
$a1 = new Animal();
$a1->setNom('Hamster')
    ->setDescription('Le hamster est un petit rongeur au corps compact, court sur pattes 
    et aux oreilles de petite taille. L\'une des caractéristiques du hamster est la présence 
    d\'abajoues, des poches situées de part et d\'autre de la tête et servant à stocker de 
    la nourriture, voire à mettre les petits à l\'abri chez certaines variétés.')
    ->setImage('hamster.jpg')
    ->setPoids('250 gr')
    ->setNomLatin('Cricetinae')
    ->setEspeces($e3);
$a1->addContinent($c1)->addContinent($c2);
$manager->persist($a1);

$a2 = new Animal();
$a2->setNom('Chien')
    ->setDescription('Le chien est un mammifère de la famille des canidés. 
    C\'est la première espèce animale à avoir été domestiquée par l\'homme dans le but de la chasse.
    La taille et le poids des chiens varie énormément d\'une race à l\'autre.')
    ->setImage('chien.jpg')
    ->setNomLatin('Canis Lupus Familiaris')
    ->setPoids('40 Kg')
    ->setEspeces($e1);
$a2->addContinent($c1);
$manager->persist($a2);

$a3 = new Animal();
$a3->setNom('Truite')
    ->setDescription('Elle a un corps élancé, une tête forte et une bouche large. 
    Elle possède une nageoire dorsale, une grande nageoire caudale peu échancrée voire droite, 
    et, comme tous les salmonidés, une petite nageoire adipeuse.')
    ->setImage("truite.jpg")
    ->setNomLatin('Salmo trutta')
    ->setPoids('600 gr')
    ->setEspeces($e2);
$a3->addContinent($c3);
$manager->persist($a3);

                                    // Possede
$possede1 = new Possede();
$possede1->setPersonne($personne1)->setAnimal($a1);

$possede1->setQuantite(4);

$manager->persist($possede1);

$manager->flush();

    }
}
