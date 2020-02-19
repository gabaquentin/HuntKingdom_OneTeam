<?php

namespace Emergency\EmergencyBundle\Controller;


use Emergency\EmergencyBundle\Entity\Urgence;
use Emergency\EmergencyBundle\Entity\Expedition;
use AppBundle\Entity\User;
use Emergency\EmergencyBundle\Form\UrgenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $expedition = $em->getRepository("EmergencyBundle:Expedition")->findAll();
        return $this->render('@Emergency/Default/index.html.twig',array('expedition'=>$expedition));
    }

    public function addAction(Request $request)
    {
        if($request->isXMLHttpRequest()) {
            $message = addslashes(trim($request->get('message')));
            $acc = '';
            if(addslashes(trim($request->get('acc'))))
            {
                $acc = addslashes(trim($request->get('acc')));
            }

            $lat = addslashes(trim($request->get('lat')));
            $lng = addslashes(trim($request->get('lng')));
            $add = addslashes(trim($request->get('add')));
            $place_id = addslashes(trim($request->get('placeId')));
            $expedition = '';
            if(addslashes(trim($request->get('expedition'))))
            {
                $expedition = addslashes(trim($request->get('expedition')));
            }


            if($message != '' )
            {
                $entityManager = $this->getDoctrine()->getManager();

                $urgence = new Urgence();
                $urgence->setDescription($message);
                $urgence->setPlus($acc);
                $urgence->setLatitude($lat);
                $urgence->setLongitude($lng);
                $urgence->setAdresse($add);
                $urgence->setPlace_id($place_id);
                $urgence->setDate(date('d/m/Y H:i:s',time()));
                $urgence->setEtat(0);
                $u = $entityManager->getRepository("AppBundle:User")->find($this->getUser());
                $urgence->setUtilisateur($u);
                if($expedition != '')
                {
                    $exp = $entityManager->getRepository("EmergencyBundle:Expedition")->find($expedition);
                    $urgence->setExpedition($exp);
                }

                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($urgence);

                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();

                $manager = $this->get('mgilet.notification');
                $notif = $manager->createNotification('urgence');
                $notif->setMessage('Nouvelle urgence');
                $notif->setLink('http://symfony.com/');
                // or the one-line method :
                // $manager->createNotification('Notification subject','Some random text','http://google.fr');

                // you can add a notification to a list of entities
                // the third parameter ``$flush`` allows you to directly flush the entities
                $manager->addNotification(array($this->getUser()), $notif, true);
            }

        }
        $reponse = 'bien';

        return new Response(json_encode($reponse));
    }

    public function ExpeditionAction()
    {
        return $this->render('@Emergency/Default/expedition.html.twig');
    }

    public function addExpeditionAction(Request $request)
    {
        if($request->isXMLHttpRequest()) {
            $message = addslashes(trim($request->get('message')));
            $nom = addslashes(trim($request->get('nom')));
            $dateDebut = addslashes(trim($request->get('dateDebut')));
            $dateFin = addslashes(trim($request->get('dateFin')));
            $lieux = addslashes(trim($request->get('lieux')));
            $type = addslashes(trim($request->get('type')));
            $statut = addslashes(trim($request->get('statut')));

            $array = array('dateDebutMessage' => '');

            if (strtotime($dateDebut) < strtotime($dateFin)) {
                $array['dateDebutMessage'] = 'La date debut doit etre inferieur a la date de fin!';
            }

            if($message != '' AND $nom != '' AND $lieux != '' AND $type != '' AND strtotime($dateDebut) < strtotime($dateFin))
            {
                $entityManager = $this->getDoctrine()->getManager();

                $expedition = new Expedition();
                $expedition->setNom($nom);
                $expedition->setMessage($message);
                $expedition->setdateDebut($dateDebut);
                $expedition->setdateFin($dateFin);
                $expedition->setLieux($lieux);
                $expedition->setType($type);
                $expedition->setStatut($statut);
                $expedition->setDate(date('Y-m-d',time()));
                $u = $entityManager->getRepository("AppBundle:User")->find($this->getUser());
                $expedition->setUtilisateur($u);

                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($expedition);

                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();
            }

            return new Response('45');

        }


    }

}
