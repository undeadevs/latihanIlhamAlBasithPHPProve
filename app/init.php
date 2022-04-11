<?php
    session_start();
    if(!isset($_SESSION['flash'])) $_SESSION['flash']=[];

    require_once('config/config.php');

    require_once('core/App.php');
    require_once('core/Controller.php');
    require_once('core/Database.php');
    require_once('core/UnsualJWT.php');
    
    foreach (glob("../app/controllers/*.php") as $filename) {
        require_once($filename);
    }
    
    foreach (glob("../app/models/*.php") as $filename) {
        require_once($filename);
    }

    $BerandaController = new BerandaController();
    $ProfileController = new ProfileController();
    $BeritaController = new BeritaController();
    $GaleriController = new GaleriController();
    $BukuTamuController = new BukuTamuController();
    $KontakController = new KontakController();
    $AuthController = new AuthController();
    $ManageController = new ManageController();

    $app = new App();

    function getPagination($rowCount=0){
        $paginationInfo=[];
        $query = ['limit'=>50, 'offset'=>0];
        if(isset($_GET['limit'])){
            if(is_numeric($_GET['limit'])) $query['limit']=$_GET['limit']+0;
        }
        $paginationInfo['current']=$query;
        if(isset($_GET['offset'])){
            if(is_numeric($_GET['offset'])) $query['offset']=$_GET['offset']+0;
        }
        $nextQueryStrings=[];
        $paginationInfo['nextPage']='';
        if($query['offset']+$query['limit']<=$rowCount){
            foreach(['limit'=>$query['limit'], 'offset'=>$query['offset']+$query['limit']] as $key=>$val){
                array_push($nextQueryStrings, $key.'='.$val);
            }
            $paginationInfo['nextPage']=implode('&',$nextQueryStrings);
        }
        $prevQueryStrings=[];
        $paginationInfo['prevPage']='';
        if($query['offset']-$query['limit']>=0){
            foreach(['limit'=>$query['limit'], 'offset'=>$query['offset']-$query['limit']] as $key=>$val){
                array_push($prevQueryStrings, $key.'='.$val);
            }
            $paginationInfo['prevPage']=implode('&',$prevQueryStrings);
        }
        $paginationInfo['currPage'] = floor($query['offset']/$query['limit'])+1;
        $paginationInfo['totalPage'] = ceil($rowCount/$query['limit']);
        if($rowCount===0){
            $paginationInfo['currPage'] = 0;
            $paginationInfo['totalPage'] = 0;
        }
        return $paginationInfo;
    }

    $app->use(function(){
        // Redirect if there's trailing slash
        if(substr($_SERVER['REQUEST_URI'],-1)==='/'&&$GLOBALS['app']->path!=='/'){
            (new Controller())->redirect($GLOBALS['app']->path);
        }
    });

    $app->use(function(){
        // Change or override POST method to DELETE if it has a query string '_method' with the value of 'DELETE' (case insensitive)
        if(isset($_GET['_method'])){
            if($_SERVER['REQUEST_METHOD']==='POST' && strtoupper($_GET['_method'])==='DELETE'){
                $GLOBALS['app']->method='DELETE';
            }
        }
    });

    $app->use(function(){
        $currentPath = $GLOBALS['app']->path;
        $controller = new Controller();
        $authenticated=false;
        if(isset($_COOKIE['token'])){
            $token = $_COOKIE['token'];
            $tokenData = UnsualJWT::decode($token,JWT_SECRET);
            $GLOBALS['user'] = (new Controller())->model('UserModel')->getByID($tokenData['user_id']);
            if($GLOBALS['user']!==null) $authenticated=true;
            if($GLOBALS['user']['role']!=='admin' && preg_match('/^\/manage\/user(.*)/', $currentPath)) return $controller->flash('error', 'Not Authorized')->redirect('/manage');
        }
        if($authenticated===false){
            setcookie('token',null,-1,'/');
            if(preg_match('/^\/manage(.*)/', $currentPath)) return $controller->flash('error', 'Login first')->redirect('/login');
        }
    });

    $isAuthenticated = function(){
        $controller = new Controller();
        if(isset($GLOBALS['user'])) return;
        return $controller->flash('error','Log in first')->redirect('/login');
    };

    $isNotAuthenticated = function(){
        $controller = new Controller();
        if(isset($GLOBALS['user'])) return $controller->flash('error','Already logged in')->redirect('/beranda');
        return;
    };

    $app->get('/',[], function(){
        (new Controller())->redirect('/beranda');
    });

    $app->get('/beranda',[], array($BerandaController,"main"));

    $app->get('/profile',[], array($ProfileController,"main"));

    $app->get('/berita',[], array($BeritaController,"main"));
    $app->get('/berita/:id',[], array($BeritaController,"single"));

    $app->get('/galeri',[], array($GaleriController,"main"));

    $app->get('/buku-tamu',[], array($BukuTamuController,"get"));
    $app->post('/buku-tamu',[], array($BukuTamuController,"post"));

    $app->get('/kontak',[], array($KontakController,"get"));
    $app->post('/kontak',[], array($KontakController,"post"));

    $app->get('/login',[$isNotAuthenticated], array($AuthController, 'main'));
    $app->post('/login',[$isNotAuthenticated], array($AuthController, 'login'));

    $app->delete('/logout',[$isAuthenticated], array($AuthController, 'logout'));

    $app->get('/manage',[], function(){
        (new Controller())->redirect('/manage/dashboard');
    });

    $app->get('/manage/dashboard',[], array($ManageController, 'dashboard'));

    $app->get('/manage/berita',[], array($ManageController, 'berita'));
    $app->get('/manage/berita/add',[], array($ManageController, 'berita_add_get'));
    $app->post('/manage/berita/add',[], array($ManageController, 'berita_add_post'));
    $app->get('/manage/berita/:id',[], array($ManageController, 'berita_edit_get'));
    $app->post('/manage/berita/:id',[], array($ManageController, 'berita_edit_post'));
    $app->delete('/manage/berita/:id',[], array($ManageController, 'berita_delete'));

    $app->get('/manage/galeri',[], array($ManageController, 'galeri'));
    $app->get('/manage/galeri/add',[], array($ManageController, 'galeri_add_get'));
    $app->post('/manage/galeri/add',[], array($ManageController, 'galeri_add_post'));
    $app->delete('/manage/galeri/:filename',[], array($ManageController, 'galeri_delete'));

    $app->get('/manage/buku-tamu',[], array($ManageController, 'buku_tamu'));

    $app->get('/manage/user',[], array($ManageController, 'user'));
    $app->get('/manage/user/add',[], array($ManageController, 'user_add_get'));
    $app->post('/manage/user/add',[], array($ManageController, 'user_add_post'));
    $app->get('/manage/user/:id',[], array($ManageController, 'user_edit_get'));
    $app->post('/manage/user/:id',[], array($ManageController, 'user_edit_post'));
    $app->delete('/manage/user/:id',[], array($ManageController, 'user_delete'));