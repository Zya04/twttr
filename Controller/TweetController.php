<?php

require_once('Cool/BaseController.php');
require_once('Model/TweetManager.php');

class TweetController extends BaseController
{
    public function messageAction()
    {
        if(isset($_POST['tweet'])
        && isset($_POST['message'])) {
            $message = htmlentities($_POST['message']);
            $creation = date('Y-m-d H:i:s');
            $username = $_SESSION['username'];
            $manager = new TweetManager();
            $manager->sendMessage($message, $creation, $username);
        }
        $arr = [
            'user' => $_SESSION
        ];
        return $this->render('tweet.html.twig', $arr);
    }

}