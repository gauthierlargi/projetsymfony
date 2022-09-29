<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    public function __construct(private MovieRepository $movieRepository)
    {
    }
    #[Route('/', name: 'app_movie')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'movieController',
        ]);
        
    }
    #[Route('/form', name: 'app_form')]
    public function form(Request $request): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieFormType::class, $movie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->movieRepository->add($movie, true);

            $this->addFlash('success', 'Film sauvegardé !');
            return $this->redirectToRoute('app_movie');
        }

        return $this->render('movie/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
