<?php

require_once('Cool/DBManager.php');

class TweetManager
{
    public function sendMessage($message)
    {
        $dbm = DBManager::getInstance();
        $pdo = $dbm->getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare("INSERT INTO `message` (`message_id`, `message`) 
        VALUES (NULL, :msg)");
        $stmt->bindParam(':msg', $message);
        // var_dump($message);
        // die();
        
        $stmt->execute();
    }
}
