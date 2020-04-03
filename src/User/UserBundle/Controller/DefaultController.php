<?php

namespace User\UserBundle\Controller;

use AdminBoutiqueBundle\Entity\Mail;
use AdminBoutiqueBundle\Form\MailType;
use Emergency\EmergencyBundle\Entity\Expedition;
use Emergency\EmergencyBundle\Entity\Urgence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use User\UserBundle\Entity\aNews;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $aNews = $em->getRepository("UserBundle:aNews")->findAll();
        $pub = $em->getRepository("PubBundle:pub")->findAll();
        return $this->render('@User/Default/index.html.twig',array('aNews'=>$aNews,'pub'=>$pub));
    }

    public function indexAdminAction()
    {
        return $this->render('@User/Default/indexAdmin.html.twig');
    }

    public function aboutAction()
    {
        $em = $this->getDoctrine()->getManager();
        $aNews = $em->getRepository("UserBundle:aNews")->findAll();
        return $this->render('@User/Default/apropos.html.twig',array('aNews'=>$aNews));
    }

    public function contactAction()
    {
        return $this->render('@User/Default/contact.html.twig');
    }

    public function profilAction()
    {
        $em = $this->getDoctrine()->getManager();
        $urgence = $em->getRepository("EmergencyBundle:Urgence")->findAll();
        $exp = $em->getRepository("EmergencyBundle:Expedition")->findAll();
        return $this->render('@User/Default/profil.html.twig',array('urgence'=>$urgence,'expedition'=>$exp));
    }

    public function endExpAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $exp = $em->getRepository(Expedition::class)->find($id);

        if (!$exp) {
            throw $this->createNotFoundException(
                'No exp found for id '.$id
            );
        }

        $exp->setStatut('2');
        $em->flush();

        return $this->redirectToRoute('user_profile');
    }

    public function newNewsAction(Request $request)
    {
        if($request->isXMLHttpRequest()) {
            $entityManager = $this->getDoctrine()->getManager();

            $aNews = new aNews();
            $u = $entityManager->getRepository("AppBundle:User")->find($this->getUser());
            $aNews->setUtilisateur($u);
            $aNews->setStatus(1);

            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($aNews);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

        }
               return $this->redirectToRoute('user_profile');


    }

    public function contactProcessAction(Request $request)
    {
        if($request->isXMLHttpRequest()) {
            $object = addslashes(trim($request->get('message')));
            $name = addslashes(trim($request->get('name')));
            $email = addslashes(trim($request->get('email')));
            $subject = addslashes(trim($request->get('subject')));

            $username = 'huntkingdom216@gmail.com';


                $message= \Swift_Message::newInstance()
                    ->setSubject('Contact : '.$subject)
                    ->setFrom($email)
                    ->setTo($username)
                    ->setBody(
                        $this->renderView(
                        // app/Resources/views/Emails/registration.html.twig
                            'email/contact_process.html.twig',
                            ['name' => $name,'object'=> $object]
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($message);
                $this->addFlash(
                    'in',
                    'Envoyé Avec Succès'
                );

            }
            return $this->redirectToRoute('user_profile');

        }

}
