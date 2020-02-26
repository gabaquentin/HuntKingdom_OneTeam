<?php

namespace  SAV\AdminSAVBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison")
 * @ORM\Entity(repositoryClass="SAV\AdminSAVBundle\Repository\LivraisonRepository")
 */
class Livraison
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
     * @var string
     *
     * @ORM\Column(name="dateliv", type="string")
     */
    private $dateliv;


    /**
     * @ORM\ManyToOne(targetEntity="Livreur")
     * @ORM\JoinColumn(name="livreur",referencedColumnName="id",onDelete="CASCADE")
     */
    private $Livreur ;

    /**
     * @return mixed
     */
    public function getLivreur()
    {
        return $this->Livreur;
    }

    /**
     * @param mixed $Livreur
     */
    public function setLivreur($Livreur)
    {
        $this->Livreur = $Livreur;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="prixliv", type="integer")
     */
    private $prixliv;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set prixliv
     *
     * @param integer $prixliv
     *
     * @return Livraison
     */
    public function setPrixliv($prixliv)
    {
        $this->prixliv = $prixliv;

        return $this;
    }

    /**
     * Get prixliv
     *
     * @return int
     */
    public function getPrixliv()
    {
        return $this->prixliv;
    }

    /**
     * Get dateliv
     *
     * @return string
     */
    public function getDateliv()
    {
        return $this->dateliv;
    }

    /**
     * @param string $dateliv
     */
    public function setDateliv($dateliv)
    {
        $this->dateliv = $dateliv;
    }

}

