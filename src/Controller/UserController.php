<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\UserManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/users", methods={"POST"})
     */
    public function store(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        
        $data = json_decode($request->request->get('user'));

        $user = new User();
        
        $user->setFirstName($data->firstName);
        $user->setLastName($data->lastName);
        
        $entityManager->persist($user);

        $entityManager->flush();
        
        $message = 'User saved successfully';
        
        return $this->json(compact('message'));
    }
    
    /**
     * @Route("/users/{id}", methods={"GET"})
     */
    public function show(int $id, UserManager $service)
    {
        $user = $service->find($id);
        
        return $this->json(compact('user'));
    }
}
