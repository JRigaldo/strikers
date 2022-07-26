<?php

namespace App\Model;

class User {

    private $userID;
    private $username;
    private $password;

    public function getUserID(): ?int
    {
        return $this->id;
    }

    public function setUserID(int $userID): self
    {
        $this->userID = $userID;
        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

}