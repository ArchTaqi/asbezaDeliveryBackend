<?php

namespace App\Controller;

use App\Entity\Salesperson;
use App\Form\SalespersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/salesperson")
 */
class SalespersonController extends AbstractController
{
    /**
     * @Route("/", name="salesperson_index", methods={"GET"})
     */
    public function index(): Response
    {
        $salespeople = $this->getDoctrine()
            ->getRepository(Salesperson::class)
            ->findAll();

        return $this->render('salesperson/index.html.twig', [
            'salespeople' => $salespeople,
        ]);
    }

    /**
     * @Route("/new", name="salesperson_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $salesperson = new Salesperson();
        $form = $this->createForm(SalespersonType::class, $salesperson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($salesperson);
            $entityManager->flush();

            return $this->redirectToRoute('salesperson_index');
        }

        return $this->render('salesperson/new.html.twig', [
            'salesperson' => $salesperson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salesperson_show", methods={"GET"})
     */
    public function show(Salesperson $salesperson): Response
    {
        return $this->render('salesperson/show.html.twig', [
            'salesperson' => $salesperson,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="salesperson_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Salesperson $salesperson): Response
    {
        $form = $this->createForm(SalespersonType::class, $salesperson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salesperson_index', [
                'id' => $salesperson->getId(),
            ]);
        }

        return $this->render('salesperson/edit.html.twig', [
            'salesperson' => $salesperson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="salesperson_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Salesperson $salesperson): Response
    {
        if ($this->isCsrfTokenValid('delete'.$salesperson->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($salesperson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('salesperson_index');
    }
}
