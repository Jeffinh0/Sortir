<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\OutingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OutingController extends AbstractController
{
    /**
     * @route("/outing", name="outing_show")
     */
    public function show(){
        return $this->render('outing/outing.html.twig');
    }

    /**
     * @Route("/outing/new", name="outing_create")
     */
    public function create(EntityManagerInterface $em, Request $request){

        $sortie = new Sortie();
        $outingForm = $this->createForm(OutingType::class, $sortie);
        $outingForm->handleRequest($request);

        if ($outingForm->isSubmitted() && $outingForm->isValid()){
            $em->persist($sortie);
            $em->flush();



        }
        return $this->render('outing/create.html.twig',[
            "outingForm"=>$outingForm->createView()
        ]);
    }

    /**
     * @Route("/outing/{id}/edit"), name="outing_edit")
     */
    public function edit(){
        return $this->render('outing/edit.html.twig');
    }

    /**
     * @Route("/outing/{id}/cancel"), name="outing_cancel")
     */
    public function cancel(){
        return $this->render('outing/cancel.html.twig');
    }
}