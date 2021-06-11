<?php

namespace Dsprog\Models;

use Dsprog\DB\Model;
use Exception;

class User extends Model
{
    const SESSION = 'Admin';

    public static function login($user, $pass)
    {
        $result = parent::select("SELECT * FROM tb_users WHERE user=:LOGIN", [":LOGIN"=>$user]);

        if (count($result) === 0){
            throw new Exception('Usuário ou senha inválidos!', 1);
        }

        if (password_verify($pass, $result[0]['despassword']) === true){
            $user = new User();
            $user->setData($result[0]);

            $_SESSION[User::SESSION] = $user->getValues();
            
            return $user;
        }else{
            throw new Exception('Usuário ou senha inválidos!', 1);
        }

    }

    public static function verifyLogin($inadmin = true)
    {
        if(
            !isset($_SESSION[User::SESSION])
            || !$_SESSION[User::SESSION]
            || !(int) $_SESSION[User::SESSION]['iduser'] > 0
            || (bool) $_SESSION[User::SESSION]['inadmin'] !== $inadmin
        ){
            header('location: /admin/login');
            exit;
        }
    }

    public static function logout()
    {
        session_unset($_SESSION[User::SESSION]);
    }
}