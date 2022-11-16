<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Entree;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntreeController extends AbstractController
{
    #[Route('/ListerEntree', name: 'listeEntree')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $listEntree = $entityManager->getRepository('App\Entity\Entree')->findAll();
        return $this->render('entree/liste.html.twig', [
            'controller_name' => 'EntreeController',
            'listEntree' => $listEntree,
       
        ]);
    }

    #[Route('/AjouterEntree', name: 'ajouterEntree')]
    public function addEntree(EntityManagerInterface $entityManager): Response
    {
        $listProduit = $entityManager->getRepository('App\Entity\Produit')->findAll();
        $listEntree = $entityManager->getRepository('App\Entity\Entree')->findAll();
       /*  $listEntree = $entityManager->getRepository('App\Entity\Entree')->findAll(); */

        return $this->render('entree/liste.html.twig', [
            'controller_name' => 'EntreeController',
            'listProduit' => $listProduit,
            'listEntree' => $listEntree,
        ]);
    }


    #[Route('/AddEntree', name: 'addEntree')]
    public function add(EntityManagerInterface $entityManager): Response
    {
        extract($_POST);
        if(isset($product)) {
            $entree = new Entree();
            $entree->setDateE($date);
            $entree->setQtE($qte);
            $listProduit = $entityManager->getRepository('App\Entity\Produit')->findAll();
            $produit = $entityManager->getRepository('App\Entity\Produit')->find($product);
            $entree->setProduit($produit);
            $entityManager->persist($entree);
            $entityManager->flush();

            $produit->setQtStock($qte +$produit->getQtStock());
            $entityManager->persist($produit);
            $entityManager->flush();
            $listEntree = $entityManager->getRepository('App\Entity\Entree')->findAll();
            return $this->render('entree/liste.html.twig', [
                'controller_name' => 'EntreeController',
                'listEntree' => $listEntree,
                'listProduit'=>$listProduit,
            ]);
        }else {
            return $this ->  add($entityManager);
        }
    }

}
