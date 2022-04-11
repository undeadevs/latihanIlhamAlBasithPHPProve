<?php
    class ProfileController extends Controller{
        public function main(){
            $locals['title']='Profile';
            $this->render('profile', $locals);
        }
    }