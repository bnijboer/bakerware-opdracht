<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends AbstractController
{
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'test' => 'wereld',
        ]);
    }
}