<?php

require_once('Cool/DBManager.php');

class UserManager
{
    public function registerUser($user, $firstName, $lastName, $email, $address, $addressCode, $password, $passwordVerify)
    {
        if($password === $passwordVerify){
            $hashedPwd = password_hash($password, PASSWORD_BCRYPT);
            $dbm = DBManager::getInstance();
            $pdo = $dbm->getPdo();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $pdo->prepare("INSERT INTO `users` (`user_id`, `username`, `firstname`, `lastname`, `email`, `address`,`address_code`, `password`) 
            VALUES (NULL, :username, :firstName, :lastName, :email, :address, :addressCode, :psw)");
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':addressCode', $addressCode);
            $stmt->bindParam(':psw', $hashedPwd);

            $stmt->execute();
        }
    }

    public function loginUser($user, $password)
    {
        $dbm = DBManager::getInstance();
        $pdo = $dbm->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM users 
        WHERE username = :username");
        $stmt->bindParam(':username', $user);

        $stmt->execute();
        $result = $stmt->fetch();
        if(!password_verify($password, $result['password'])){
            $errors = 'Invalid username or password';
            return $errors;
        } else {
            $_SESSION['username'] = $user;
            return $user;
        }
    }
}
