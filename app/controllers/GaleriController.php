<?php
    class GaleriController extends Controller{
        public function main(){
            $locals['title']='Galeri';
            $this->render('galeri', $locals);
        }
    }