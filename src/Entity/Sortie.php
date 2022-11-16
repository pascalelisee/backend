<?php

namespace App\Entity;

use App\Repository\SortieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SortieRepository::class)]
class Sortie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
/* 
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateS = null; */

        
    #[ORM\Column(type: 'string', length: 255)]
    private $dateS;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $qtS = null;

    #[ORM\ManyToOne(inversedBy: 'sorties')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

  /*   public function getDateS(): ?\DateTimeInterface
    {
        return $this->dateS;
    }

    public function setDateS(\DateTimeInterface $dateS): self
    {
        $this->dateS = $dateS;

        return $this;
    }
 */

 

public function getDateS(): ?string
{
    return $this->dateS;
}

public function setDateS(string $dateS): self
{
    $this->dateS = $dateS;

    return $this;
}


    public function getQtS(): ?string
    {
        return $this->qtS;
    }

    public function setQtS(string $qtS): self
    {
        $this->qtS = $qtS;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }
}
