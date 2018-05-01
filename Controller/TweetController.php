<?php

require_once('Cool/BaseController.php');
require_once('Model/TweetManager.php');

class TweetController extends BaseController
{
    public function messageAction()
    {
        if(isset($_SESSION['username'])) {
            /*if(isset($_POST['tweet'])
            && isset($_POST['message'])) {
                $message = htmlentities($_POST['message']);
                $creation = date('Y-m-d H:i:s');
                $username = $_SESSION['username'];
                $manager = new TweetManager();
                $manager->sendMessage($message, $creation, $username);
            }*/
            $manager = new TweetManager();
            $message = $manager->getMessage();
            $arr = [
                'user' => $_SESSION,
                'messages' => $message
            ];
            return $this->render('tweet.html.twig', $arr);
        }
        else {
            return $this->redirect('?action=home');
        }
    
    }
    
}