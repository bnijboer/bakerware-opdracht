<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
    * @Route("/", name="default")
    */
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
    
    /**
    * @Route("/fetch", name="fetch")
    */
    public function fetch(UserRepository $userRepository): Response
    {
        $lastName = $userRepository->getLastName();
        
        return $this->json(compact('lastName'));
    }
}
