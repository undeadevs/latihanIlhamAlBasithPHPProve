<?php

    class AuthController extends Controller{
        public function main(){
            $this->render('login', ['title'=>'Login']);
        }
        public function login(){
            if(isset($_POST['username']) && isset($_POST['password'])){
                $username=htmlspecialchars($_POST['username']);
                $password=htmlspecialchars($_POST['password']);
                $res=$this->model('UserModel')->getByUsername($username);
                if($res!==null){
                    if(password_verify($password, $res['password'])===TRUE){
                        setcookie('token', UnsualJWT::encode(['user_id'=>$res['id']], JWT_SECRET), time()+(86400 * 30), '/', '', true, true);
                        $this->flash('success', 'Login Successful')->redirect('/beranda');
                        return;
                    }
                }
            }
            return $this->flash('error', 'Invalid username or password')->redirect('/login');
        }
        public function logout(){
            setcookie('token',null,-1,'/');
            $this->flash('success', 'Logout Successful')->redirect('/beranda');
        }
    }