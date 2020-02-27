<?php

namespace Cart\CartBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="Cart\CartBundle\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="prixtotal", type="integer")
     */
    private $prixtotal;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="date", type="string", length=255)
     */
    private $date;

    /**
     * @return string
     */
    public function getDateCommande(): string
    {
        return $this->dateCommande;
    }

    /**
     * @param string $dateCommande
     */
    public function setDateCommande(string $dateCommande): void
    {
        $this->dateCommande = $dateCommande;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="dateCommande", type="string", length=255)
     */
    private $dateCommande;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="utilisateur", referencedColumnName="id")
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="AdminBoutiqueBundle\Entity\Produits")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    private $produit;

    /**
     * @return mixed
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param mixed $produit
     */
    public function setProduit($produit): void
    {
        $this->produit = $produit;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set prixtotal.
     *
     * @param int $prixtotal
     *
     * @return Commande
     */
    public function setPrixtotal($prixtotal)
    {
        $this->prixtotal = $prixtotal;

        return $this;
    }

    /**
     * Get prixtotal.
     *
     * @return int
     */
    public function getPrixtotal()
    {
        return $this->prixtotal;
    }

    /**
     * Set etat.
     *
     * @param string $etat
     *
     * @return Commande
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat.
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set date.
     *
     * @param string $date
     *
     * @return Commande
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param mixed $utilisateur
     */
    public function setUtilisateur($utilisateur): void
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * Get date.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }


}
