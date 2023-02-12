<?php

namespace models;

use JsonSerializable;

class User implements JsonSerializable {
    private int $id;
    private string $login;
    private string $password;
    private string $email;
    private string $name;
    private string $sault;

    public function __construct(int $id, string $login, string $password, string $email, string $name, string $sault = null)
    {
        $sault? $this->sault = $sault : $this->generateSault();
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
        $this->name = $name;
        $this->password =  $password;
    }

    public function getId(): int{
        return $this->id;
    }
    public function setId(int $id): void{
        $this->id = $id;
    }
    public function getLogin(): string{
        return $this->login;
    }
    public function setLogin(string $login): void{
        $this->login = $login;
    }
    public function getPassword(): string{
        return $this->password;
    }
    public function setPassword(string $password): void{
        $this->password = $password;
    }
    public function getEmail(): string{
        return $this->email;
    }
    public function setEmail(string $email): void{
        $this->email = $email;
    }
    public function getName(): string{
        return $this->name;
    }
    public function setName(string $name): void{
        $this->name = $name;
    }
    public function getSault (): string
    {
        return $this->sault ;
    }

    public function setSault (string $sault): void
    {
        $this->sault  = $sault ;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'login' => $this->getLogin(),
            'password' => $this->getPassword(),
            'email' => $this->getEmail(),
            'name' => $this->getName(),
            'sault' => $this->getSault()
        ];
    }

    public function generateSault()
    {
        $strSault = '';
        for ($i = 0; $i < 5; $i++) {
            $strSault .= chr(rand(97, 122));
        }
        $this->setSault($strSault);
    }
}