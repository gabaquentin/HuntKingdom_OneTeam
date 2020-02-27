<?php

namespace Pub\PubBundle\Controller;

use Pub\PubBundle\Entity\pub;
use Pub\PubBundle\Form\pubType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $pub = new Pub;
        $form = $this->createForm(PubType::class,$pub);
        $form->handleRequest($request);

        if($form->isSubmitted())
        { /**
         * @var UploadedFile $file
         */
            $file=$pub->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter( 'image_directory'),$fileName
            );

            $pub->setImage($fileName);
            $em= $this->getDoctrine()->getManager();
            $em->persist($pub);
            $em->flush();
            unset($pub);
            unset($form);
            $pub = new Pub();
            $form = $this->createForm(PubType::class, $pub);
        }
        $em= $this->getDoctrine()->getManager();
        $pub = $em->getRepository("PubBundle:Pub")->findAll();
        return $this->render("@Pub/Default/index.html.twig",array('form'=>$form->createView(),'pub'=>$pub));

    }

    public function supprimerPubAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $pub = $em->getRepository("PubBundle:pub")->find($id);
        $em->remove($pub);
        $em->flush();

        return $this->redirectToRoute('pub_homepage');
    }

    public function modifierPubAction(Request $request,$id)
    {
        $em =  $this->getDoctrine()->getManager();
        $pub = $em->getRepository("PubBundle:pub")->find($id);
        $form = $this->createForm(PubType::class,$pub);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em= $this->getDoctrine()->getManager();
            $em->persist($pub);
            $em->flush();
            return $this->redirectToRoute('pub_homepage');
        }
        $em= $this->getDoctrine()->getManager();
        $pub = $em->getRepository("PubBundle:pub")->findAll();
        return $this->render("@Pub/Default/index.html.twig",array('form'=>$form->createView(),'pub'=>$pub));
    }
    public function searchAction(Request  $request)
    {

        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository(pub::class)->findAll();
        if ($request->isMethod("POST"))
        {
            $nom = $request->get('nom');
            $Reclamation = $em->getRepository('PubBundle:pub')->findBy(array('nom' => $nom));
        }
        return $this->render("@pub/index.html.twig", array('Reclamation' => $Reclamation));

    }
}
