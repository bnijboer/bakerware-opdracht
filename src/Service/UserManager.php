<?php

namespace App\Service;

use App\Repository\UserRepository;

class UserManager
{
    private $repository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }
    
    public function find(int $id)
    {
        return $this->repository->find($id);
    }
}