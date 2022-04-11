<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?=str_replace(isset($_SERVER['PATH_INFO'])?ltrim($_SERVER['PATH_INFO'],"/"):"","",$_SERVER['REQUEST_URI'])?>">
    <title>BSJ | <?= $locals['title'] ?></title>
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="js/flash.js" defer></script>
    <link rel="stylesheet" href="css/login.css">
</head>