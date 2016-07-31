<?php
    $dsn = "mysql:host='localhost';dbname='wizzfoia_Edous-Food';charset='utf8'";
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    try{
        $pdo = new PDO($dsn, 'wizzfoia_fadmin', '150638Egr$', $opt);
    }  catch (PDOException $e){
        echo json_encode(
            array(
                'error_code'=>1,
                'error_text'=>'PHP/authorization.php: '.$e->getMessage()
            )
        );
        exit();
    }

