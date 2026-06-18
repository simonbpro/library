<?php

namespace App\Controller;

use App\Entity\Editor;
use App\Form\EditorType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/editor')]
class EditorController extends AbstractController
{
    
    #[Route('', name: 'app_editor', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {   
        $repository = $entityManager->getRepository(Editor::class);
        
        $editors = $repository->findAll();
        
        return $this->render('editor/index.html.twig', [
            'controller_name' => 'EsitorController',
            'editors' => $editors
        ]);

    }

    #[Route('/new', name: 'app_editor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $editor = new Editor();
        $form = $this->createForm(EditorType::class, $editor);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($editor);
            $manager->flush();

            return $this->redirectToRoute('app_editor');
        }

        return $this->render('editor/new.html.twig', [
            'form' => $form,
        ]);
    }
}