<?php
    
    use App\QueryBuilder;

    $db = new QueryBuilder();
    $db->getAll('posts');
    
?>