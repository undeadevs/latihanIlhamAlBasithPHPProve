<?php
    class BeritaController extends Controller{
        public function main(){
            $locals['title']='Berita';
            $rowCount = $this->model('BeritaModel')->getRowCount();
            $locals['pagination'] = getPagination($rowCount);
            $locals['rows'] = $this->model('BeritaModel')->getAll($locals['pagination']['current']['limit'], $locals['pagination']['current']['offset']);
            $this->render('berita', $locals);
        }
        public function single($params){
            $locals['title']='Berita';
            $locals['data'] = $this->model('BeritaModel')->getByID(htmlspecialchars($params['id']));
            if($locals['data']===null) return $this->flash('error','Berita ID Not Found')->redirect('/berita');
            $this->render('single-berita', $locals);
        }
    }