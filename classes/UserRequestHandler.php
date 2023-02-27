<?php

declare(strict_types=1);

class UserRequestHandler 
{
    //Get an user from the database
    public static function get(array $data) 
    {        
        $connection = (new Database())->getConnection();
        
        if (isset($data['id'])) {

            $statement = $connection->prepare("SELECT * FROM `users` WHERE id = :id");
            $statement->execute(['id' => $data['id']]);
            $dbRow = $statement->fetch();

            if ($dbRow) {
                return new User((int)$dbRow['id'], $dbRow['username'], $dbRow['name'], $dbRow['password'], $dbRow['email']);
            }

            return null;
        }

        $statement = $connection->prepare("SELECT * FROM `users`");
        $statement->execute([]);

        $users = $statement->fetchAll();

        for ($i = 0; $i < count($users); $i ++) {
            $user = $users[$i];
            $result[] = new User((int)$dbRow['id'], $dbRow['username'], $dbRow['name'], $dbRow['password'], $dbRow['email']);
        }

        return $result;
    }

    //Add an user to the database
    public static function post(array $data): array 
    {
        $connection = (new Database())->getConnection();
        $statement = $connection->prepare("INSERT INTO `users` (`username`, `name`, `password`, `email`) VALUES (:username, :name, :password, :email)");
        
        if ($statement->execute([
                'username' => $data['username'],
                'name' => $data['name'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'email' => $data['email']
            ])) {
            return $data;
        }

        throw new Exception("Internal server error");
    }
}

?>
