<?php

namespace AdminBoutiqueBundle\Controller;

use AdminBoutiqueBundle\Entity\Produits;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use AdminBoutiqueBundle\AdminBoutiqueBundle;
use AdminBoutiqueBundle\Form\ProduitsType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;

class ProduitsController extends Controller
{
    public function afficheAction()
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AdminBoutiqueBundle:Produits")->findAll();



        return $this->render("@AdminBoutique/Default/affiche.html.twig",array('produits'=>$produits));
    }



    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $Produits= $em->getRepository("AdminBoutiqueBundle:Produits")->find($id);
        $em->remove($Produits);
        $em->flush();
        $this->addFlash(
            'info',
            'Supprimé Avec Succès'
        );

        return $this->redirectToRoute('admin_boutique_afficher');
    }

    public function modifierAction(Request $request, Produits $produit)
    {
        $form = $this->createForm(ProduitsType::class,$produit);
        $form->HandleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /**
             * @var UploadedFile $file
             */
            $file=$produit->getImage();
            $fileName= md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName);
            $em = $this->getDoctrine()->getManager();
            $produit->setImage($fileName);
            $em->persist($produit);
            $em->flush();
            $this->addFlash(
                'information',
                'Modifié Avec Succès'
            );
            return $this->redirectToRoute('admin_boutique_afficher');
        }

        return $this->render("@AdminBoutique/Default/index.html.twig",array('form'=>$form->createView()));
    }

    public function statistiqueAction(Request $request)
    {
        $pieChart=new PieChart();
        $em=$this->getDoctrine();
        $categorie=$em->getRepository(Produits::class)->findAll();
        $total=0;





    
        foreach ($categorie as $Produits){
            $total=$total+$Produits->getQuantite();
        }
        $data=array();
        $stat=['categorie','quantite'];
        $nb=0;
        array_push($data,$stat);
        foreach($categorie as $Produits){
            $stat=array();
            array_push($stat,$Produits->getCategorie(),(($Produits->getQuantite()) *100)/$total);
            $nb=($Produits->getQuantite() *100)/$total;
            $stat=[$Produits->getCategorie(),$nb];
            array_push($data,$stat);
        }
        $pieChart->getData()->setArrayToDataTable($data);
       // $pieChart->getOptions()->setTitle('Pourcentages des Produits par Categorie');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(750);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@AdminBoutique\Default\statistique.html.twig', array('piechart' => $pieChart));

    }

    public function ProductDetailBackAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $produits=$em->getRepository("AdminBoutiqueBundle:Produits")->find($id);



        return $this->render("@AdminBoutique/Default/ProductDetailBack.html.twig",array('produits'=>$produits));
    }




    }



