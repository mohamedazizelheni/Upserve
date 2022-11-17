<?php

namespace App\Controller;

use App\Form\OffreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Offre;


class OffreController extends AbstractController
{


    /**
     * @Route("/", name="display_offre")
     */
    public function index(): Response
    {
        $offre =$this->getDoctrine()->getManager()->getRepository(Offre::class)->findAll(); //affichage

        return $this->render('offre/index.html.twig', [
            'o'=>$offre
        ]);
    }
    /**
     * @Route("/display_offreclient", name="display_offreclient")
     */
    public function index1(): Response
    {
        $offre =$this->getDoctrine()->getManager()->getRepository(Offre::class)->findAll(); //affichage

        return $this->render('Client/index1.html.twig', [
            'o'=>$offre
            

        ]);
    }

    /**
     * @Route("/admin", name="display_admin")
     */
    public function indexAdmin(): Response
    {

        return $this->render('Admin/index.html.twig') ;

    }

    /**
     * @Route("/client", name="display_client")
     */
    public function indexClinet(): Response
    {

        return $this->render('Client/homepage.html.twig') ;

    }
    /**
     * @Route("/addOffrec", name="addOffrec")
     */
    public function addOffrec(Request $request): Response
    {
        $offre = new Offre();

        $form = $this->createForm( OffreType::class,$offre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);//hedhy taamel l'ajout
            $em->flush();//tzyd fel base
            return $this->redirectToRoute('display_client');
        }

        return $this->render('Client/createOffre.html.twig',['f'=>$form->createView()]);


    }

    /**
     * @Route("/addOffre", name="addOffre")
     */
    public function addOffre(Request $request): Response
    {
        $offre = new Offre();

        $form = $this->createForm( OffreType::class,$offre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);//hedhy taamel l'ajout
            $em->flush();//tzyd fel base

            return $this->redirectToRoute('display_offre');
        }
        return $this->render('offre/createOffre.html.twig',['f'=>$form->createView()]);


    }

    /**
     * @Route("/removeOffre/{id}", name="supp_offre")
     */
    public function suppressionOffre(Offre $offre): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($offre);
        $em->flush();
        return $this->redirectToRoute('display_offre');
    }

    /**
     * @Route("/modifOffre/{id}", name="modifOffre")
     */
    public function modifOffre(Request $request,$id): Response
    {
        $offre =$this->getDoctrine()->getManager()->getRepository(Offre::class)->find($id);

        $form = $this->createForm( OffreType::class,$offre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->flush();//tzyd fel base

            return $this->redirectToRoute('display_offre');
        }
        return $this->render('offre/updateOffre.html.twig',['f'=>$form->createView()]);


    }

    }
