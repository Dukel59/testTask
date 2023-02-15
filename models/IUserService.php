<?php

namespace models;

interface IUserService
{
    public function getUserById(int $id);

    public function addUser(User $user);

    public function updateUser(int $id, string $login = null, string $password = null, string $email = null, string $name = null);

    public function deleteUser(int $id);

    public function getUsers();

    public function getUserByEmail(string $email);

    public function getUserByLogin(string $login);
}