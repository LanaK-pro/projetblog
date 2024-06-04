<?php

namespace App\Controller;

use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Subject;

class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/subjects', name: 'subject_list')]
    public function list(SubjectRepository $subjects): Response
    {
        // Récupérer toutes mes catégories
        // Puis les envoyer à la vue pour un rendu
        $subjects = $subjects->findAll();
        // dd($categories);

        return $this->render('main/list.html.twig',
            ['subjects' => $subjects]);
    }

    #[Route('/subject/{id}', name: 'subject_item')]
    public function item(Subject $subject): Response
    {
        return $this->render('main/item.html.twig',
            ['subject' => $subject]) ;
    }

}
