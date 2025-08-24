<?php

namespace App\Controllers\Api;

use Core\SysController;
use App\Models\User;

class ApiUserController extends SysController
{
    public function index()
    {
        $users = User::all(); // Buscar todos os usuários
        return $this->jsonResponse($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return $this->jsonResponse($user);
        }
        return $this->jsonResponse(['error' => 'User not found'], 404);
    }

    public function store()
    {
        $data = $_POST;
        $user = new User();
        $user->fill($data);
        $user->save();
        
        return $this->jsonResponse($user, 201); // Retorna 201 Created
    }

    public function update($id)
    {
        $user = User::find($id);
        if ($user) {
            $data = $_POST;
            $user->fill($data);
            $user->save();
            return $this->jsonResponse($user);
        }
        return $this->jsonResponse(['error' => 'User not found'], 404);
    }

    public function delete($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return $this->jsonResponse(['message' => 'User deleted']);
        }
        return $this->jsonResponse(['error' => 'User not found'], 404);
    }
}
