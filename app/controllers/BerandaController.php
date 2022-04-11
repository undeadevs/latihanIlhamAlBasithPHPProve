<?php
    class BerandaController extends Controller{
        public function main(){
            $locals['title']='Beranda';
            $locals['rows'] = $this->model('BeritaModel')->getAll(5,0);
            $this->render('beranda', $locals);
        }
    }