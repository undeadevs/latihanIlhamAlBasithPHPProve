<?php

    class ManageController extends Controller{
        public function dashboard(){
            $this->render('manage/dashboard', ['title'=>'Dashboard']);
        }

        public function berita(){
            $locals=['title'=>'Berita'];
            $rowCount = $this->model('BeritaModel')->getRowCount();
            $locals['pagination'] = getPagination($rowCount);
            $locals['rows'] = $this->model('BeritaModel')->getAll($locals['pagination']['current']['limit'], $locals['pagination']['current']['offset']);
            $this->render('manage/berita/main', $locals);
        }
        
        public function berita_add_get(){
            $locals=['title'=>'Add Berita'];
            $this->render('manage/berita/add', $locals);
        }
        
        public function berita_add_post(){
            if(isset($_POST['date']) && isset($_POST['title']) && isset($_POST['content']) && isset($_FILES['image'])){
                $date = htmlspecialchars($_POST['date']);
                $title = htmlspecialchars($_POST['title']);
                $content = htmlspecialchars($_POST['content']);
                $res = $this->model('BeritaModel')->addToDB($date, $title, $content);

                $targetFile = '../public/images/news/'.$res.'.'.strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $fileType = $_FILES['image']['type'];
                $tmpName = $_FILES['image']['tmp_name'];

                if($fileType!=='image/png' && $fileType!=='image/jpeg') return $this->flash('error','Failed to upload media file')->redirect('/manage/berita');

                if(move_uploaded_file($tmpName, $targetFile)) return $this->flash('success','Berita added')->redirect('/manage/berita'); 

                return $this->flash('error','Failed to upload media file')->redirect('/manage/berita');
            }
        }

        
        public function berita_edit_get($params){
            $locals=['title'=>'Edit Berita'];
            $locals['data'] = $this->model('BeritaModel')->getByID($params['id']);
            if($locals['data']===null) return $this->flash('error','Berita ID Not Found')->redirect('/manage/berita');
            $this->render('manage/berita/edit', $locals);
        }

        public function berita_edit_post($params){
            if(isset($_POST['date']) && isset($_POST['title']) && isset($_POST['content']) && isset($_FILES['image'])){
                $safePOST = [];
                $safePOST['date'] = htmlspecialchars($_POST['date']);
                $safePOST['title'] = htmlspecialchars($_POST['title']);
                $safePOST['content'] = htmlspecialchars($_POST['content']);
                $res = $this->model('BeritaModel')->editByID($params['id'], $safePOST);

                $targetFile = '../public/images/news/'.$res.'.'.strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $fileType = $_FILES['image']['type'];
                $tmpName = $_FILES['image']['tmp_name'];

                if($fileType!=='image/png' && $fileType!=='image/jpeg') return $this->flash('error','Failed to upload media file')->redirect('/manage/berita');

                $this->flash('success','Berita edited')->redirect('/manage/berita');
            }
        }

        public function berita_delete($params){
            $res = $this->model('BeritaModel')->deleteByID($params['id']);
            $targetFile = '../public/images/news/'.$params['id'].'.*';
            $files = glob($targetFile);
            foreach ($files as $file) {
                unlink($file);
            }
            $this->flash('success','Berita deleted')->redirect('/manage/berita');
        }

        public function galeri(){
            $this->render('manage/galeri/main', ['title'=>'Galeri']);
        }

        public function galeri_add_get(){
            $this->render('manage/galeri/add', ['title'=>'Add Galeri']);
        }

        public function galeri_add_post(){
            if(isset($_FILES['image'])){
                $targetFile = '../public/images/gallery/'.uniqid('gallery').'.'.strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $fileType = $_FILES['image']['type'];
                $tmpName = $_FILES['image']['tmp_name'];

                if($fileType!=='image/png' && $fileType!=='image/jpeg') return $this->flash('error','Failed to upload image file')->redirect('/manage/galeri');

                if(move_uploaded_file($tmpName, $targetFile)) return $this->flash('success','Image added')->redirect('/manage/galeri'); 

                return $this->flash('error','Failed to upload image file')->redirect('/manage/galeri');
            }
        }

        public function galeri_delete($params){
            $targetFile = '../public/images/gallery/'.$params['filename'];
            if(!unlink($targetFile)) return $this->flash('error','Something went wrong')->redirect('/manage/galeri');

            return $this->flash('success','Image deleted')->redirect('/manage/galeri');
        }

        public function buku_tamu(){
            $locals=['title'=>'Buku Tamu'];
            $rowCount = $this->model('BukuTamuModel')->getRowCount();
            $locals['pagination'] = getPagination($rowCount);
            $locals['rows'] = $this->model('BukuTamuModel')->getAll($locals['pagination']['current']['limit'], $locals['pagination']['current']['offset']);
            $this->render('manage/buku-tamu/main', $locals);
        }

        public function user(){
            $locals=['title'=>'User'];
            $rowCount = $this->model('UserModel')->getRowCount();
            $locals['pagination'] = getPagination($rowCount);
            $locals['rows'] = $this->model('UserModel')->getAll($locals['pagination']['current']['limit'], $locals['pagination']['current']['offset']);
            $this->render('manage/user/main', $locals);
        }

        public function user_add_get(){
            $locals=['title'=>'Add User'];
            $this->render('manage/user/add', $locals);
        }

        public function user_add_post(){
            if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])){
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $role = htmlspecialchars($_POST['role']);
                $this->model('UserModel')->addToDB($username, $password, $role);
                $this->flash('success','User added')->redirect('/manage/user');
            }
        }

        public function user_edit_get($params){
            $locals=['title'=>'Edit User'];
            $locals['data'] = $this->model('UserModel')->getByID($params['id']);
            if($locals['data']===null) return $this->flash('error','User ID Not Found')->redirect('/manage/user');
            $this->render('manage/user/edit', $locals);
        }

        public function user_edit_post($params){
            if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])){
                $safePOST = [];
                $safePOST['username'] = htmlspecialchars($_POST['username']);
                $safePOST['password'] = htmlspecialchars($_POST['password']);
                $safePOST['role'] = htmlspecialchars($_POST['role']);
                $res = $this->model('UserModel')->editByID($params['id'], $safePOST);
                $this->flash('success','User edited')->redirect('/manage/user');
            }
        }
        public function user_delete($params){
            $res = $this->model('UserModel')->deleteByID($params['id']);
            $this->flash('success','User deleted')->redirect('/manage/user');
        }
    }