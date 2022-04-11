<?php
    class BukuTamuController extends Controller{
        public function get(){
            $locals['title']='Buku Tamu';
            $this->render('buku-tamu', $locals);
        }
        public function post(){
            if(isset($_POST['name']) && isset($_POST['message'])){
                $_name = htmlspecialchars($_POST['name']);
                $_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $_message = htmlspecialchars($_POST['message']);
                if(!filter_var($_email,FILTER_VALIDATE_EMAIL) && $_POST['email']){
                    $this->flash('error','Email tidak valid')->redirect('/kontak');
                }
                $this->model('BukuTamuModel')->addToDB($_name,$_email,$_message);
                $this->flash('success','Berhasil isi buku tamu')->redirect('/buku-tamu');
            }else{
                $this->flash('error','Data yang diberikan tidak valid')->redirect('/buku-tamu');
            }
        }
    }