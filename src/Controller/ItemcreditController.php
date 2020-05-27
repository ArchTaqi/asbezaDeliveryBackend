<?php

namespace App\Controller;

use App\Entity\Itemcredit;
use App\Form\ItemcreditType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/itemcredit")
 */
class ItemcreditController extends AbstractController
{
    /**
     * @Route("/", name="itemcredit_index", methods={"GET"})
     */
    public function index(): Response
    {
        $itemcredits = $this->getDoctrine()
            ->getRepository(Itemcredit::class)
            ->findAll();

        return $this->render('itemcredit/index.html.twig', [
            'itemcredits' => $itemcredits,
        ]);
    }

    /**
     * @Route("/new", name="itemcredit_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $itemcredit = new Itemcredit();
        $form = $this->createForm(ItemcreditType::class, $itemcredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($itemcredit);
            $entityManager->flush();

            return $this->redirectToRoute('itemcredit_index');
        }

        return $this->render('itemcredit/new.html.twig', [
            'itemcredit' => $itemcredit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="itemcredit_show", methods={"GET"})
     */
    public function show(Itemcredit $itemcredit): Response
    {
        return $this->render('itemcredit/show.html.twig', [
            'itemcredit' => $itemcredit,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="itemcredit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Itemcredit $itemcredit): Response
    {
        $form = $this->createForm(ItemcreditType::class, $itemcredit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('itemcredit_index', [
                'id' => $itemcredit->getId(),
            ]);
        }

        return $this->render('itemcredit/edit.html.twig', [
            'itemcredit' => $itemcredit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="itemcredit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Itemcredit $itemcredit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itemcredit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($itemcredit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('itemcredit_index');
    }
}
