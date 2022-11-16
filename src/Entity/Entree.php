<?php

namespace App\Entity;

use App\Repository\EntreeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntreeRepository::class)]
class Entree
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    
    #[ORM\Column(type: 'string', length: 255)]
    private $dateE;

 /*    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateE = null; */

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $qtE = null;

    #[ORM\ManyToOne(inversedBy: 'entrees')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Produit $produit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

   /*  public function getDateE(): ?\DateTimeInterface
    {
        return $this->dateE;
    }

    public function setDateE(\DateTimeInterface $dateE): self
    {
        $this->dateE = $dateE;

        return $this;
    }
 */



    public function getDateE(): ?string
    {
        return $this->dateE;
    }

    public function setDateE(string $dateE): self
    {
        $this->dateE = $dateE;

        return $this;
    }




    public function getQtE(): ?string
    {
        return $this->qtE;
    }

    public function setQtE(string $qtE): self
    {
        $this->qtE = $qtE;

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
