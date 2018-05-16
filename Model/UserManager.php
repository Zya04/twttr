<?php

require_once('Cool/DBManager.php');

class UserManager
{
    public function registerUser($user, $firstName, $lastName, $email, $password, $passwordVerify)
    {
        if($password === $passwordVerify){
            $hashedPwd = password_hash($password, PASSWORD_BCRYPT);
            $dbm = DBManager::getInstance();
            $pdo = $dbm->getPdo();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $pdo->prepare("INSERT INTO `users` (`user_id`, `username`, `firstname`, `lastname`, `email`, `password`) 
            VALUES (NULL, :username, :firstName, :lastName, :email, :psw)");
            $stmt->bindParam(':username', $user);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
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
            $_SESSION['user_id'] = $result['user_id'];
            return $user;
        }
    }

    public function getUserProfile($userProfileId)
    {
        $dbm = DBManager::getInstance();
        $pdo = $dbm->getPdo();

        $stmt = $pdo->prepare("SELECT * FROM `users` 
          LEFT JOIN message ON users.username = message.username
          WHERE user_id = ? ORDER BY message_id DESC");

        $stmt->execute([$userProfileId]);
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $result;

    }
}
