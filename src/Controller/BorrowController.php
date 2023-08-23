<?php

namespace App\Controller;

use App\Entity\Borrow;
use App\Form\BorrowType;
use App\Repository\BorrowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/borrow")
 */
class BorrowController extends AbstractController
{
    /**
     * @Route("/", name="app_borrow_index", methods={"GET"})
     */
    public function index(BorrowRepository $borrowRepository): Response
    {
        return $this->render('borrow/index.html.twig', [
            'borrows' => $borrowRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_borrow_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BorrowRepository $borrowRepository): Response
    {
        $borrow = new Borrow();
        $form = $this->createForm(BorrowType::class, $borrow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $borrowRepository->add($borrow, true);

            return $this->redirectToRoute('app_borrow_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('borrow/new.html.twig', [
            'borrow' => $borrow,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_borrow_show", methods={"GET"})
     */
    public function show(Borrow $borrow): Response
    {
        return $this->render('borrow/show.html.twig', [
            'borrow' => $borrow,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_borrow_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Borrow $borrow, BorrowRepository $borrowRepository): Response
    {
        $form = $this->createForm(BorrowType::class, $borrow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $borrowRepository->add($borrow, true);

            return $this->redirectToRoute('app_borrow_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('borrow/edit.html.twig', [
            'borrow' => $borrow,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_borrow_delete", methods={"POST"})
     */
    public function delete(Request $request, Borrow $borrow, BorrowRepository $borrowRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$borrow->getId(), $request->request->get('_token'))) {
            $borrowRepository->remove($borrow, true);
        }

        return $this->redirectToRoute('app_borrow_index', [], Response::HTTP_SEE_OTHER);
    }
}
