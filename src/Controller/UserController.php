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
        
        $data = json_decode($request->request->get('user'));

        $user = new User();
        $user->setFirstName($data->firstName);
        $user->setLastName($data->lastName);
        
        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        
        $message = 'User saved successfully';

        $response = new Response();
        $response->setContent(json_encode(compact('message')));
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:3000');
        
        return $response;
    }
    
    /**
     * @Route("/users/{id}", methods={"GET"})
     */
    public function show(int $id, UserManager $service): Response
    {
        $user = $service->find($id);
        
        $response = new Response();
        $response->setContent(json_encode([
            'user' => [
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName()
            ]
        ]));
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:3000');
        
        return $response;
    }
}
