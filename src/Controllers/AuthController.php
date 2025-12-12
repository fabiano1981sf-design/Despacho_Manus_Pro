<?php

namespace App\Controllers;

use App\Controller;
use App\Auth;

class AuthController extends Controller {
    
    public function login(): void {
        if (Auth::isLoggedIn()) {
            header('Location: index.php?page=dashboard');
            exit;
        }
        
        $message = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $result = Auth::login($email, $password);
            
            if ($result['success']) {
                header('Location: index.php?page=dashboard');
                exit;
            } else {
                $message = $result['message'];
            }
        }
        
        $this->render('_login', ['message' => $message]);
    }
    
    public function logout(): void {
        Auth::logout();
        header('Location: index.php?page=login');
        exit;
    }
}
