<?php

namespace Dsprog\Models;

use Dsprog\DB\Sql;
use Dsprog\DB\Model;
use Exception;

class User extends Model
{
    const SESSION = 'Admin';

    public static function login($user, $pass)
    {
        $result = (new Sql())->select("SELECT * FROM tb_users");
        
        if (count($result) === 0){
            throw new Exception('Usuário ou senha inválidos!', 1);
        }

        $data = $result[0];
        if (password_verify($pass, $data['despassword']) === true){
            $user = new User();
            unset($data['despassword']);

            $user->setData($data);

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
        unset($_SESSION[User::SESSION]);
    }
}