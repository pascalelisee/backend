<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $listProduit = $entityManager->getRepository('App\Entity\Produit')->findAll();
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            'listProduit' => $listProduit,
        ]);
    }
    
    /**
     * Undocumented function
     * cette function envoie le formulaire d'ajout
     *
     * @return Response
     */
    #[Route('/AjouterProduit', name: 'ajouterProduit')]
    public function addProduit(): Response
    {

        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    /* function permettant d'ajouter un produit */

    #[Route('/Addproduit', name: 'addproduit')]
    public function add(EntityManagerInterface $entityManager): Response
    {
        extract($_POST);
        $produit= new Produit();
        $produit-> setLibelle($libelle);
        $produit-> setQtStock($qtStock);
        $entityManager->persist($produit);
        $entityManager->flush();
        $listProduit = $entityManager->getRepository('App\Entity\Produit')->findAll();
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            'listProduit' => $listProduit,
        ]);
    }

  
}
