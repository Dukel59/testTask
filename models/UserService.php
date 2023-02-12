<?php

namespace models;
require_once 'IUserService.php';
require_once 'User.php';
class UserService implements IUserService
{
    private array $users = [];
    private string $dbName;

    public function __construct()
    {
        $this->dbName = '../database/users.json';
    }

    public function getUserById(int $id){
        if($this->getUsers()){
            foreach($this->getUsers() as $user){
                if($user->getId() == $id){
                    return $user;
                }
            }
        }
        return null;
    }
    public function addUser(User $user){
        $this->users = $this->getUsers();
        $user->setPassword(sha1($user->getSault().$user->getPassword()));
        $this->users[] = $user;
        $string = json_encode($this->users);
        $result = file_put_contents($this->dbName, $string);
        print_r($this->dbName);
        print_r(PHP_EOL);
        print_r($result);
        if(!$result){
            return $user;
        }
        return null;
    }
    public function updateUser(int $id, string $login = null, string $password = null, string $email = null, string $name = null){
        $user = $this->getUserById($id);
        $result = null;
        if($user){
            if($login){
                $user->setLogin($login);
            }
            if($password){
                $user->setPassword($password);
            }
            if($email){
                $user->setEmail($email);
            }
            if($name){
                $user->setName($name);
            }

            $usersFromFile = $this->getUsers();
            $this->users = [];
            if($usersFromFile){
                foreach($usersFromFile as $item){
                    if($item->getId() == $id){
                        $this->users[] = $user;
                    }else{
                        $this->users[] = $item;
                    }
                }
            } else {
                $this->users = $user;
            }

            $encodeUsers = json_encode($this->users);
            $result = file_put_contents($this->dbName, $encodeUsers);
        }
        if($result){
            return $user;
        } else{
            return null;
        }
    }
    public function deleteUser(int $id){
        $usersFromFile = $this->getUsers();
        $this->users = [];
        $resutl = null;

        if($usersFromFile){
            foreach($usersFromFile as $user){
                if($user->getId() != $id){
                    $this->users[] = $user;
                }
            }
            $encodeUsers = json_encode($this->users);
            $resutl = file_put_contents($this->dbName, $encodeUsers);
        }
        return $resutl;
    }
    public function getUsers(): array
    {
        $this->users = [];
        if(file_get_contents($this->dbName)){
            $json = file_get_contents($this->dbName);
            $jsonDecode = json_decode($json, true);
            foreach($jsonDecode as $person){
                $this->users[] = new User($person['id'], $person['login'], $person['password'], $person['email'], $person['name'], $person['sault']);
            }
        }
        return $this->users;
    }

    public function getUserByEmail(string $email)
    {
        if($this->getUsers()){
            foreach($this->getUsers() as $user){
                if($user->getEmail() == $email){
                    return $user;
                }
            }
        }
        return null;
    }

    public function getUserByLogin(string $login)
    {
        if($this->getUsers()){
            foreach($this->getUsers() as $user){
                if($user->getLogin() == $login){
                    return $user;
                }
            }
        }
        return null;
    }
}

