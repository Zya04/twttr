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

        $link = mysqli_connect("localhost", "root", "", "twttr");

        $getFollowId = intval($_GET['followedid']);

        if($getFollowId != $_SESSION['id'])
        {
            $alreadyFollowed = $pdo->prepare('SELECT * FROM follow WHERE id_followed = ? AND id_following = ?');
            $alreadyFollowed->execute(array($_SESSION['user_id'], getFollowId));
            $alreadyFollowed = $alreadyFollowed->rowCount();

            if($alreadyFollowed == 0)
            {
                $addFollow = $pdo->prepare('INSERT INTO follow(id_follower, id_following) VALUES (?,?)');
                $addFollow->execute(array($_SESSION['user_id'], getFollowId));

            } elseif ($alreadyFollowed == 1) 
            {
                $deleteFollow = $pdo->prepare('DELETE FROM follow WHERE id_follower = ? AND id_following = ?');
                $deleteFollow->execute(array($_SESSION['user_id'], getFollowId));
            }
        }
    }
}
