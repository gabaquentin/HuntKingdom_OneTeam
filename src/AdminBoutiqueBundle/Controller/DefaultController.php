<?php

namespace AdminBoutiqueBundle\Controller;


use AdminBoutiqueBundle\AdminBoutiqueBundle;
use AdminBoutiqueBundle\Form\ProduitsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AdminBoutiqueBundle\Entity\Produits;
use Symfony\Component\Routing\Route;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        $produit = new Produits();

        $form = $this->createForm(ProduitsType::class,$produit);
        $form->HandleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /**
         * @var UploadedFile $file
         */
            $file=$produit->getImage();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('image_directory'),$fileName);
            $em = $this->getDoctrine()->getManager();
            $produit->setImage($fileName);
            $em=$this->getDoctrine() ->getManager();
            $em->persist($produit);
            $em->flush();


            $this->addFlash(
                'information',
                'Ajouté Avec Succès'
            );

            return $this->redirectToRoute('admin_boutique_homepage');

        }

        return $this->render("@AdminBoutique/Default/index.html.twig",array('form'=>$form->createView()));






    }



}
