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


        $chasseA = $em->getRepository(Produits::class)->findBy(array('categorie' => 'chasse animal'));
        $data=array();
        $stat=['categorie','quantite'];
        $nb=0;
        array_push($data,$stat);
        foreach($chasseA as $Produits){
            $stat=array();
            array_push($stat,'chasse animal',(($Produits->getQuantite()) *100)/$total);
            $nb=($Produits->getQuantite() *100)/$total;
            $stat=[$Produits->getCategorie(),$nb];
            array_push($data,$stat);
        }



        $chasseF = $em->getRepository(Produits::class)->findBy(array('categorie' => 'chasse au fusil'));
        $data=array();
        $stat=['categorie','quantite'];
        $nbF=0;
        array_push($data,$stat);
        foreach($chasseF as $Produits){
            $stat=array();
            array_push($stat,'chasse au fusil',(($Produits->getQuantite()) *100)/$total);
            $nbF=($Produits->getQuantite() *100)/$total;
            $stat=[$Produits->getCategorie(),$nbF];
            array_push($data,$stat);
        }



        $pecheS = $em->getRepository(Produits::class)->findBy(array('categorie' => 'peche SS'));
        $data=array();
        $stat=['categorie','quantite'];
        $nbPS=0;
        array_push($data,$stat);
        foreach($pecheS as $Produits){
            $stat=array();
            array_push($stat,'peche SS',(($Produits->getQuantite()) *100)/$total);
            $nbPS=($Produits->getQuantite() *100)/$total;
            $stat=[$Produits->getCategorie(),$nbPS];
            array_push($data,$stat);
        }


        $peche = $em->getRepository(Produits::class)->findBy(array('categorie' => 'peche'));
        $data=array();
        $stat=['categorie','quantite'];
        $nbP=0;
        array_push($data,$stat);
        foreach($peche as $Produits){
            $stat=array();
            array_push($stat,'peche',(($Produits->getQuantite()) *100)/$total);
            $nbP=($Produits->getQuantite() *100)/$total;
            $stat=[$Produits->getCategorie(),$nbP];
            array_push($data,$stat);
        }













        $pieChart->getData()->setArrayToDataTable(
            [
                ['Pac Man', 'Percentage'],
                ['Chasse Animal', $nb],
                ['Chasse Au Fusil',$nbF],
                ['Peche Sous-Marine',$nbPS],
                ['Peche ',$nbP]

            ]
        );









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

    public function searchAction()
    {
        $request = $this->getRequest();
        $data = $request->request->all();


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT  p.id
        FROM produits:nomP p
        WHERE p.type LIKE :data')
            ->setParameter('data', $data['search']);


        $res = $query->getResult();

        return $this->render('AdminBoutiqueBundle:Default:affiche.html.twig', array(
            'res' => $res));
    }




    }



