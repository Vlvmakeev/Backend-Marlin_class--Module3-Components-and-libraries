<?php
    require '../vendor/autoload.php';
    
    
    $templates = new League\Plates\Engine('../app/views');
    

    echo $templates->render('homepage', ['title' => 'Our Company']);

?>