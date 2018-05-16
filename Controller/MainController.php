<?php

require_once('Cool/BaseController.php');
require_once('Model/UserManager.php');

class MainController extends BaseController
{
    public function hallAction()
    {
        $arr = [
            'user' => $_SESSION
        ];
        return $this->render('hall.html.twig', $arr);
    }

    public function registerAction()
    {
        if (!isset($_SESSION['username'])) {
            if(!empty($_POST['username']) && !empty($_POST['firstName'])
                && !empty($_POST['lastName']) && !empty($_POST['email'])
                && !empty($_POST['password']) && !empty($_POST['passwordVerify'])
                && !empty($_POST['submit'])){
                $username = htmlentities($_POST['username']);
                $firstName = htmlentities($_POST['firstName']);
                $lastName = htmlentities($_POST['lastName']);
                $email = htmlentities($_POST['email']);
                $password = $_POST['password'];
                $passwordVerify = $_POST['passwordVerify'];
                $manager = new UserManager();
                $manager->registerUser($username, $firstName, $lastName, $email, $password, $passwordVerify);
                $this->redirect('?action=login');
            } else
            {
                $arr = [
                    'errors' => 'ALL field are requierd'
                ];
                return $this->render('register.html.twig', $arr);
            }
            return $this->render('register.html.twig');
        }
        else {
            $logs = fopen('logs/security.log', 'a+');
            fwrite($logs, $_SESSION['username'].' just tried to hack at '.date('Y-m-d H:i:s')."\n");
            fclose($logs);
            return $this->redirect('?action=home');
        }
    }

    public function loginAction()
    {
        if (!isset($_SESSION['username'])) {
            if(isset($_POST['username']) && isset($_POST['psw'])
                && $_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $username = htmlentities($_POST['username']);
                $password = $_POST['psw'];
                $manager = new UserManager();
                $getUserData = $manager->loginUser($username, $password);
                if ($getUserData === "Invalid username or password"){
                    $arr = [
                        'errors' => $getUserData
                    ];
                    return $this->render('login.html.twig', $arr);
                } else {
                    $arr = [
                        'user' => $_SESSION
                    ];
                    $this->redirect('?action=home');
                    return $this->render('login.html.twig', $arr);
                }
            } else {
                return $this->render('login.html.twig');
            }
        }
        else {
            $logs = fopen('logs/security.log', 'a+');
            fwrite($logs, $_SESSION['username'].' just tried to hack at '.date('Y-m-d H:i:s')."\n");
            fclose($logs);
            return $this->redirect('?action=home');
        }

    }

    public function logoutAction()
    {
        session_destroy();
        return $this->redirect('?action=hall');
    }

    public function profileAction()
    {
        if (isset($_SESSION['username'])) {
            $manager = new UserManager();
            $data = $manager->getUserProfile($_GET["id"]);
            $arr = [
                'user' => $_SESSION,
                'data' => $data
            ];

            if (!empty($data)){
                return $this->render('profile.html.twig', $arr);
            } else {
                return $this->redirect('?action=home');
            }
        }
        else {
            return $this->redirect('?action=hall');
        }

    }
}