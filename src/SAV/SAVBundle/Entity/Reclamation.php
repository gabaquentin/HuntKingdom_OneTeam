<?php

namespace SAV\SAVBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert ;
use SBC\NotificationsBundle\Builder\NotificationBuilder;
use SBC\NotificationsBundle\Model\NotifiableInterface;


/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity(repositoryClass="SAV\SAVBundle\Repository\ReclamationRepository")
 */
class Reclamation implements NotifiableInterface, \JsonSerializable
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
     * @ORM\Column(name="type_Reclamation", type="string", length=255)
     */
    private $typeReclamation;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=255)
     * @Assert\NotBlank (message = " il faut remplir ce champs " )
     */
    private $description;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_Reclamation", type="date")
     */
    private $dateReclamation;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_Achat", type="date")
     */
    private $dateAchat;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat_Reclamation", type="string", length=255, nullable=true)
     */
    private $etatReclamation="En cours";

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message = "The email '{{ value }}' is not a valid email.")
     */
    private $email;


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
     * Set typeReclamation
     *
     * @param string $typeReclamation
     *
     * @return Reclamation
     */
    public function setTypeReclamation($typeReclamation)
    {
        $this->typeReclamation = $typeReclamation;

        return $this;
    }

    /**
     * Get typeReclamation
     *
     * @return string
     */
    public function getTypeReclamation()
    {
        return $this->typeReclamation;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Reclamation
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateReclamation
     *
     * @param \DateTime $dateReclamation
     *
     * @return Reclamation
     */
    public function setDateReclamation($dateReclamation)
    {
        $this->dateReclamation = $dateReclamation;

        return $this;
    }

    /**
     * Get dateReclamation
     *
     * @return \DateTime
     */
    public function getDateReclamation()
    {
        return $this->dateReclamation;
    }

    /**
     * Set dateAchat
     *
     * @param \DateTime $dateAchat
     *
     * @return Reclamation
     */
    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    /**
     * Get dateAchat
     *
     * @return \DateTime
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
    }

    /**
     * Set etatReclamation
     *
     * @param string $etatReclamation
     *
     * @return Reclamation
     */
    public function setEtatReclamation($etatReclamation)
    {
        $this->etatReclamation = $etatReclamation;

        return $this;
    }

    /**
     * Get etatReclamation
     *
     * @return string
     */
    public function getEtatReclamation()
    {
        return $this->etatReclamation;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Reclamation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    public function __construct()
    {
        $this->dateReclamation = new \DateTime('now');
    }
##################################################################################"
    public function notificationsOnCreate(NotificationBuilder $builder)
    {
        $Reclamation = new Reclamation();
        $notification = new Notification();
        $notification
            ->setTitle('Reclamation Ajoutée')
            ->setDescription('Votre reclamation est envoyée , Merci')
            ->setRoute('sav_create')// I suppose you have a show route for your entity
            ->setParameters(array('id' => $this->id))
        ;
        $builder->addNotification($notification);

        return $builder;
    }
    #########################################################################################"
    public function notificationsOnUpdate(NotificationBuilder $builder)
    {
        $Reclamation=new Reclamation();
        $notification = new Notification();
        $notification
            ->setTitle('Réclamation traitée ')
            ->setDescription('Ta réclamation a été traitée.. nous vous appelerons ultérieurements')
            ->setRoute('sav_read')// I suppose you have a show route for your entity
            ->setParameters(array('id' => $this->id))
        ;
        $builder->addNotification($notification);

        return $builder;
    }
    ##################################################################################"

    public function notificationsOnDelete(NotificationBuilder $builder)
    {   $Reclamation=new Reclamation();
        $notification = new Notification();
        $notification->setTitle('**Reclamation rejetée**')
            ->setDescription('Vous avez dépassé les délais de réclamations , Désolé ')
            ->setRoute('sav_delete')
            ->setParameters(array('id' => $this->id))

        ;
        $builder->addNotification($notification);
        return $builder;
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}

