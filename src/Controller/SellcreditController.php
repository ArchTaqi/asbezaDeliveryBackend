<?php

namespace App\Controller;

use App\Entity\Sellcredit;
use App\Form\SellcreditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sellcredit")
 */
class SellcreditController extends AbstractController
{
    /**
     * @Route("/", name="sellcredit_index", methods={"GET"})
     */
    public function index(): Response
    {
        $sellcredits = $this->getDoctrine()
            ->getRepository(Sellcredit::class)
            ->findAll();

        return $this->render('sellcredit/index.html.twig', [
            'sellcredits' => $sellcredits,
        ]);
    }

    /**
     * @Route("/new", name="sellcredit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sellcredit = new Sellcredit();
        $form = $this->createForm(SellcreditType::class, $sellcredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sellcredit);
            $entityManager->flush();

            return $this->redirectToRoute('sellcredit_index');
        }

        return $this->render('sellcredit/new.html.twig', [
            'sellcredit' => $sellcredit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sellcredit_show", methods={"GET"})
     */
    public function show(Sellcredit $sellcredit): Response
    {
        return $this->render('sellcredit/show.html.twig', [
            'sellcredit' => $sellcredit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sellcredit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sellcredit $sellcredit): Response
    {
        $form = $this->createForm(SellcreditType::class, $sellcredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sellcredit_index', [
                'id' => $sellcredit->getId(),
            ]);
        }

        return $this->render('sellcredit/edit.html.twig', [
            'sellcredit' => $sellcredit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sellcredit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sellcredit $sellcredit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sellcredit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sellcredit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sellcredit_index');
    }
}
