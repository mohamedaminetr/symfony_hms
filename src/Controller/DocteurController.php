<?php

namespace App\Controller;
use App\Repository\RendezVousRepository;
use App\Entity\Docteur;
use App\Form\DocteurType;
use App\Repository\DocteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/docteur')]
class DocteurController extends AbstractController
{
    #[Route('/', name: 'app_docteur_index', methods: ['GET'])]
    public function index(DocteurRepository $docteurRepository, RendezVousRepository $rendezVousRepository): Response
    {
        $docteurs = $docteurRepository->findAll();
        $rendez_vouses = $rendezVousRepository->findAll();
    
        return $this->render('docteur/index.html.twig', [
            'docteurs' => $docteurs,
            'rendez_vouses' => $rendez_vouses,
        ]);
    }
    
    

    #[Route('/new', name: 'app_docteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DocteurRepository $docteurRepository): Response
    {
        $docteur = new Docteur();
        $form = $this->createForm(DocteurType::class, $docteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $docteurRepository->save($docteur, true);

            return $this->redirectToRoute('app_docteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('docteur/new.html.twig', [
            'docteur' => $docteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_docteur_show', methods: ['GET'])]
    public function show(Docteur $docteur): Response
    {
        return $this->render('docteur/show.html.twig', [
            'docteur' => $docteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_docteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Docteur $docteur, DocteurRepository $docteurRepository): Response
    {
        $form = $this->createForm(DocteurType::class, $docteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $docteurRepository->save($docteur, true);

            return $this->redirectToRoute('app_docteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('docteur/edit.html.twig', [
            'docteur' => $docteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_docteur_delete', methods: ['POST'])]
    public function delete(Request $request, Docteur $docteur, DocteurRepository $docteurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$docteur->getId(), $request->request->get('_token'))) {
            $docteurRepository->remove($docteur, true);
        }

        return $this->redirectToRoute('app_docteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
