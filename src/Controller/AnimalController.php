<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Continent;
use App\Entity\Personne;
use App\Entity\Possede;
use App\Form\AnimalType;
use App\Form\ContinentType;
use App\Form\PersonneType;
use App\Repository\AnimalRepository;
use App\Repository\ContinentRepository;
use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AnimalController extends AbstractController
{
                                // Animaux

//http://localhost:8000/animaux
    #[Route('/animaux', name: 'app_animaux')]
    public function liste(AnimalRepository $ar): Response
    {
        return $this->render('animal/liste.html.twig', [
            'Animaux' => $ar->findAll()
        ]);
    }
//http://localhost:8000/animal/id
    #[Route('/animal/{id}', name: 'app_animal')]
    public function animal(AnimalRepository $ar,$id): Response
    {
        return $this->render('animal/animal.html.twig', [
            'animal' => $ar->find($id)
        ]);
    }
//http://localhost:8000/createAnimal/id
// On utilise la même fonction que modif, en ajoutant 
// possibilité d'avoir animal et id null ainsi que if (!$animal) { $animal = new Animal ;} pour 
// indiquer la création d'un nouvel animal
// On peut avoir plusieurs routes pour la même fonction
#[Route('/creaanimal', name: 'creaanimal')] 
//http://localhost:8000/modifAnimal/id
    #[Route('/modifanimal/{id}', name: 'modif_animal')]
    public function modifAnimal(Animal $animal=null, Request $req, EntityManagerInterface $emi, 
    $id=null): Response
    {
        if (!$animal) {
            $animal = new Animal() ;
        }
        $form = $this->createForm(AnimalType::class, $animal);
        $form -> handleRequest($req) ; //Recupere les données
        if ($form->isSubmitted()) {
            $emi->persist($animal) ;
            $emi->flush() ;
            $this->addFlash("success","Modification effectuée");
        return $this->redirectToRoute('app_animaux');
        }
    return $this->render('animal/formanimal.html.twig',
        ['animal'=> $animal,
         'monform' => $form->createView()]);  
    }
//Delete un animal
    #[Route('/suppranimal/{id}', name :'suppr_animal')]
    public function supprAnimal(Animal $animal, Request $req, 
    EntityManagerInterface $emi, $id): Response
    {
        $emi->remove($animal) ;
        $emi->flush() ;
        return $this->redirectToRoute('app_animaux') ;
    }

                                // Continents

//http://localhost:8000/continents
    #[Route('/continents', name: 'app_continents')]
    public function listeContinent(ContinentRepository $cr): Response
    { 
        return $this->render('animal/continents.html.twig', [
            'Continents' => $cr->findAll()
        ]);
    }
//http:localhost:8000/continent/id
    #[Route('/continent/{id}', name: 'app_continent')]
    public function continent(ContinentRepository $cr,$id): Response
    {
        return $this->render('animal/continent.html.twig', [
            'continent' => $cr->find($id)
        ]);
    }
//http:localhost:8000/createContinent/id 
//http://localhost:8000/modifContinent/id
    #[Route('/creacontinent', name: 'creacontinent')] 
    #[Route('/modifcontinent/{id}', name: 'modif_continent')]
    public function modifContinent(Continent $continent=null, 
    Request $req, EntityManagerInterface $emi, 
    $id=null): Response
    {
        if (!$continent) {
            $continent = new Continent() ;
        }
        $form = $this->createForm(ContinentType::class, $continent);
        $form -> handleRequest($req) ; 
        if ($form->isSubmitted()) {
            $emi->persist($continent) ;
            $emi->flush() ;
        return $this->redirectToRoute('app_continents');
        }
    return $this->render('animal/formcontinent.html.twig',
        ['continent'=> $continent,
         'formcont' => $form->createView()]);  
    }
//Delete un continent
    #[Route('/supprcontinent/{id}', name :'suppr_continent')]
    public function supprContinent(Continent $continent, Request $req, 
    EntityManagerInterface $emi, $id): Response
    {
        $emi->remove($continent) ;
        $emi->flush() ;
        return $this->redirectToRoute('app_continents') ;
    }

                            // Personnes        

//http://localhost:8000/personnes
#[Route('/personnes', name: 'app_personnes')]
public function listePersonne(PersonneRepository $pr): Response
{ 
    return $this->render('animal/personnes.html.twig', [
        'Personnes' => $pr->findAll()
    ]);
}
//http:localhost:8000/personne/id
#[Route('/personne/{id}', name: 'app_personne')]
public function personne(PersonneRepository $pr,$id): Response
{
    return $this->render('animal/personne.html.twig', [
        'personne' => $pr->find($id)
    ]);
}
//http:localhost:8000/createpersonne/id 
//http://localhost:8000/modifpersonne/id
#[Route('/creapersonne', name: 'creapersonne')] 
#[Route('/modifpersonne/{id}', name: 'modif_personne')]
public function modifPersonne(Personne $personne=null, 
Request $req, EntityManagerInterface $emi, 
$id=null): Response
{
    if (!$personne) {
        $personne = new Personne() ;
    }
    $form = $this->createForm(PersonneType::class, $personne);
    $form -> handleRequest($req) ; 
    if ($form->isSubmitted()) {
        $emi->persist($personne) ;
        $emi->flush() ;
    return $this->redirectToRoute('app_personnes');
    }
return $this->render('animal/formpersonne.html.twig',
    ['personne'=> $personne,
     'formpers' => $form->createView()]);  
}
//Delete une personne
#[Route('/supprpersonne/{id}', name :'suppr_personne')]
public function supprPersonne(Personne $personne, Request $req, 
EntityManagerInterface $emi, $id): Response
{
    $emi->remove($personne) ;
    $emi->flush() ;
    return $this->redirectToRoute('app_personnes') ;
}


}
