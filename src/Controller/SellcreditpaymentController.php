<?php

namespace App\Controller;

use App\Entity\Sellcreditpayment;
use App\Form\SellcreditpaymentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sellcreditpayment")
 */
class SellcreditpaymentController extends AbstractController
{
    /**
     * @Route("/", name="sellcreditpayment_index", methods={"GET"})
     */
    public function index(): Response
    {
        $sellcreditpayments = $this->getDoctrine()
            ->getRepository(Sellcreditpayment::class)
            ->findAll();

        return $this->render('sellcreditpayment/index.html.twig', [
            'sellcreditpayments' => $sellcreditpayments,
        ]);
    }

    /**
     * @Route("/new", name="sellcreditpayment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sellcreditpayment = new Sellcreditpayment();
        $form = $this->createForm(SellcreditpaymentType::class, $sellcreditpayment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sellcreditpayment);
            $entityManager->flush();

            return $this->redirectToRoute('sellcreditpayment_index');
        }

        return $this->render('sellcreditpayment/new.html.twig', [
            'sellcreditpayment' => $sellcreditpayment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sellcreditpayment_show", methods={"GET"})
     */
    public function show(Sellcreditpayment $sellcreditpayment): Response
    {
        return $this->render('sellcreditpayment/show.html.twig', [
            'sellcreditpayment' => $sellcreditpayment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sellcreditpayment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sellcreditpayment $sellcreditpayment): Response
    {
        $form = $this->createForm(SellcreditpaymentType::class, $sellcreditpayment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sellcreditpayment_index', [
                'id' => $sellcreditpayment->getId(),
            ]);
        }

        return $this->render('sellcreditpayment/edit.html.twig', [
            'sellcreditpayment' => $sellcreditpayment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sellcreditpayment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sellcreditpayment $sellcreditpayment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sellcreditpayment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sellcreditpayment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sellcreditpayment_index');
    }
}
