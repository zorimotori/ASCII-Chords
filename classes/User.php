<?php

class User implements JsonSerializable 
{
    private $id;
    private $username;
    private $name;
    private $password;
    private $email;
    private $registeredOn;
    private $lastLoginOn;

    public function __construct(int $id, string $username, string $name, string $password, string $email) 
    {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
    }

    public function jsonSerialize(): array 
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'registeredOn' => $this->registeredOn,
            'lastLogin' => $this->lastLoginOn
        ];
    }
}

?>
