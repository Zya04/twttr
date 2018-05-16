<?php

require_once('Cool/DBManager.php');

class HomeManager
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

    public function getMessage()
    {
        $link = mysqli_connect("localhost", "root", "", "twttr");

        $result = mysqli_query($link, "SELECT * FROM message ORDER BY message_id DESC");
        $data = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        mysqli_free_result($result);
        return $data;
    
    }

    public function follow()
    {
        $dbm = DBManager::getInstance();
        $pdo = $dbm->getPdo();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $getFollowId = intval($_GET['id']);
        //var_dump($getFollowId);

        if($getFollowId != $_SESSION['user_id'])
        {
            $alreadyFollowed = $pdo->prepare('SELECT * FROM follow WHERE id_followed = ? AND id_follower = ?');
            $alreadyFollowed->execute(array($getFollowId, $_SESSION['user_id']));
            $alreadyFollowed = $alreadyFollowed->rowCount();

            if($alreadyFollowed == 0)
            {
                $addFollow = $pdo->prepare('INSERT INTO follow (`follow_id`, `id_follower`, `id_followed`) VALUES  (NULL, `:id_follower`, `:id_followed`)');
                $addFollow->bindParam(':id_follower', $_SESSION['user_id']);
                $addFollow->bindParam(':id_followed', $_GET['id']);
                $addFollow->execute();
            } elseif ($alreadyFollowed == 1) 
            {
                $deleteFollow = $pdo->prepare('DELETE FROM follow WHERE id_follower = ? AND id_followed = ?');
                $deleteFollow->execute($getFollowId, $_SESSION['user_id']);
            }
        }
    }
}
