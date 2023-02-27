<?php

declare(strict_types=1);

class SessionRequestHandler 
{
    //Login
    public static function post(string $username, string $password): array 
    {
        $connection = (new Database())->getConnection();

        $statement = $connection->prepare("SELECT * FROM `users` WHERE username = ?");
        $statement->execute([$username]);

        $user = $statement->fetch();

        if ($user) {
            $logged = password_verify($password, $user['password']);
        } 
        else {
            $logged = false;
        }

        if ($logged) {

            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];

            $response = [
                'logged' => true,
                'username' => $username
            ];
        } 
        else {
            $response = [
                'logged' => false
            ];
        }

        return $response;
    }
}

?>
