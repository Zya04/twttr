<?php

require_once('Cool/DBManager.php');

class TweetManager
{
    public function sendMessage($message, $creation, $user)
    {
        $dbm = DBManager::getInstance();
        $pdo = $dbm->getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("INSERT INTO `message` (`message_id`, `username`, `message`, `creation`) 
        VALUES (NULL, :user, :msg, :date)");
        $stmt->bindParam(':user', $user);
        $stmt->bindParam(':msg', $message);
        $stmt->bindParam(':date', $creation);

        $stmt->execute(); 
    }
}
