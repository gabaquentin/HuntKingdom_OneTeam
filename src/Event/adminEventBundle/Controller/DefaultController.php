<?php

namespace Event\adminEventBundle\Controller;

use Event\adminEventBundle\Entity\Event;
use Event\adminEventBundle\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $event = new Event;
        $form = $this->createForm(EventType::class,$event);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            /**
             * @var UploadedFile $file
             */
            $file=$event->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
             $this->getParameter( 'image_directory'),$fileName
            );

            $event->setImage($fileName);
            $em= $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            unset($event);
            unset($form);
            $event = new Event();
            $form = $this->createForm(EventType::class, $event);
        }
        $em= $this->getDoctrine()->getManager();
        $event = $em->getRepository("adminEventBundle:Event")->findAll();
        return $this->render("@adminEvent/Default/index.html.twig",array('form'=>$form->createView(),'event'=>$event));

    }

    public function supprimerEventAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $event = $em->getRepository("adminEventBundle:Event")->find($id);
        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('admin_event_homepage');
    }

    public function modifierEventAction(Request $request,$id)
    {
        $em =  $this->getDoctrine()->getManager();
        $event = $em->getRepository("adminEventBundle:Event")->find($id);
        $form = $this->createForm(EventType::class,$event);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em= $this->getDoctrine()->getManager();

            /**
             * @var UploadedFile $file
             */
            $file=$event->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter( 'image_directory'),$fileName
            );

            $event->setImage($fileName);
            $em->persist($event);
            $em->flush();
            return $this->redirectToRoute('admin_event_homepage');
        }
        $em= $this->getDoctrine()->getManager();
        $event = $em->getRepository("adminEventBundle:Event")->findAll();
        return $this->render("@adminEvent/Default/index.html.twig",array('form'=>$form->createView(),'event'=>$event));
    }

    public function pdfAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('adminEventBundle:Event')->find($id);

        $snappy = $this->get("knp_snappy.pdf");

        $html = $this->renderView("@adminEvent/Default/eventPDf.html.twig", array(
            "title" => "Article choisi",
            'ev' => $event
        ));
        $filename = "articleSingle";


        return new  Response(
            $snappy->getOutputFromHtml($html),
            200,

            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename"' . $filename . '.pdf"',
            )
        );


    }
}
