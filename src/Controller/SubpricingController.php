<?php

namespace App\Controller;

use App\Entity\Subpricing;
use App\Form\SubpricingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subpricing")
 */
class SubpricingController extends AbstractController
{
    /**
     * @Route("/", name="subpricing_index", methods={"GET"})
     */
    public function index(): Response
    {
        $subpricings = $this->getDoctrine()
            ->getRepository(Subpricing::class)
            ->findAll();

        return $this->render('subpricing/index.html.twig', [
            'subpricings' => $subpricings,
        ]);
    }

    /**
     * @Route("/new", name="subpricing_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subpricing = new Subpricing();
        $form = $this->createForm(SubpricingType::class, $subpricing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subpricing);
            $entityManager->flush();

            return $this->redirectToRoute('subpricing_index');
        }

        return $this->render('subpricing/new.html.twig', [
            'subpricing' => $subpricing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subpricing_show", methods={"GET"})
     */
    public function show(Subpricing $subpricing): Response
    {
        return $this->render('subpricing/show.html.twig', [
            'subpricing' => $subpricing,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subpricing_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subpricing $subpricing): Response
    {
        $form = $this->createForm(SubpricingType::class, $subpricing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subpricing_index');
        }

        return $this->render('subpricing/edit.html.twig', [
            'subpricing' => $subpricing,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subpricing_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Subpricing $subpricing): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subpricing->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subpricing);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subpricing_index');
    }
}
