<?php
    class KontakController extends Controller{
        public function get(){
            $locals['title']='Kontak';
            $this->render('kontak', $locals);
        }
        public function post(){
            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
                $_name = htmlspecialchars($_POST['name']);
                $_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $_message = htmlspecialchars($_POST['message']);
                if(filter_var($_email,FILTER_VALIDATE_EMAIL)){
                    mail(COMPANY_EMAIL, "BSJContact", $_message, "From: $_name [$_email]");
                    $this->flash('success','Berhasil dikirim')->redirect('/kontak');
                }else{
                    $this->flash('error','Email tidak valid')->redirect('/kontak');
                }
            }else{
                $this->flash('error','Data yang diberikan tidak valid')->redirect('/buku-tamu');
            }
        }
    }