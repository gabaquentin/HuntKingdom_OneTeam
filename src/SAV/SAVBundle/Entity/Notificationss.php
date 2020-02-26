<?php

namespace SAV\SAVBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use SBC\NotificationsBundle\Model\BaseNotification;

/**
 * Notificationss
 *
 * @ORM\Table(name="notificationss")
 * @ORM\Entity(repositoryClass="SAV\SAVBundle\Repository\NotificationssRepository")
 */
class Notificationss extends BaseNotification implements \JsonSerializable
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    public function __construct()
    {
        parent::__construct();
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }

}

