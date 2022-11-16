<?php

namespace App\Controller;

use App\Entity\Sortie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SortieController extends AbstractController
{
  
    #[Route('/ListerSortie', name: 'listeSortie')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $listSortie = $entityManager->getRepository('App\Entity\Sortie')->findAll();
        return $this->render('entree/liste.html.twig', [
            'controller_name' => 'SortieController',
            'listSortie' => $listSortie,
       
        ]);
    }

    #[Route('/AjouterSortie', name: 'ajouterSortie')]
    public function addEntree(EntityManagerInterface $entityManager): Response
    {
        $listProduit = $entityManager->getRepository('App\Entity\Produit')->findAll();
        $listSortie = $entityManager->getRepository('App\Entity\Sortie')->findAll();
       /*  $listEntree = $entityManager->getRepository('App\Entity\Entree')->findAll(); */

        return $this->render('sortie/liste.html.twig', [
            'controller_name' => 'SortieController',
            'listProduit' => $listProduit,
            'listSortie' => $listSortie,
        ]);
    }


    #[Route('/AddSortie', name: 'addSortie')]
    public function add(EntityManagerInterface $entityManager): Response
    {
        extract($_POST);
        if(isset($product)) {
            $sortie = new Sortie();
            $sortie->setDateS($date);
            $sortie->setQtS($qte);
            $listProduit = $entityManager->getRepository('App\Entity\Produit')->findAll();
            $produit = $entityManager->getRepository('App\Entity\Produit')->find($product);
            $sortie->setProduit($produit);
            $entityManager->persist($sortie);
            $entityManager->flush();
            $produit->setQtStock($produit->getQtStock()-$qte);
            $entityManager->persist($produit);
            $entityManager->flush();
            $listSortie = $entityManager->getRepository('App\Entity\Sortie')->findAll();
            return $this->render('sortie/liste.html.twig', [
                'controller_name' => 'SortieController',
                'listSortie' => $listSortie,
                'listProduit'=>$listProduit,
            ]);
        }else {
            return $this ->  add($entityManager);
        }
    }
}
