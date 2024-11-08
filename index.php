<?php

require 'vendor/autoload.php';

$app = new \Slim\App;

$app->get('/postagens-2', function() {
    
    //echo '{"nome": "Papai Cris"}';
    echo 'Listagem de postagens';

});

$app->get('/usuarios[/{id}]', function($request, $response) {
    
    $id = $request->getAttribute('id');
    //echo 'Listagem de usuarios';
    echo "Listagem de usuarios ou ID: " . $id;

});

$app->get('/postagens[/{ano}[/{mes}]]', function($request, $response) {
    
    $ano = $request->getAttribute('ano');
    $mes = $request->getAttribute('mes');

    //echo 'Listagem de usuarios';

    echo "Listagem de postagens Ano: " . $ano . " mes: " . $mes;

});

$app->get('/lista/{itens:.*}', function($request, $response) {
    
    $itens = $request->getAttribute('itens');

    //echo 'Listagem de usuarios';

    //echo $itens;

    var_dump(explode("/", $itens));

});

//////////////////
// NOMEAR ROTAS //
//////////////////

$app->get('/blog/postagens/{id}', function($request, $response) {

    echo "Listar postagem para um ID";

})->setName("blog");

$app->get('/meusite', function($request, $response) {

    $retorno = $this->get("router")->pathFor("blog", ["id" => "5"]);

    echo $retorno;

});

///////////////////
// AGRUPAR ROTAS //
///////////////////

$app->group('/v5', function() {
    
    $this->get('/usuarios', function() {
    
        echo 'Listagem de usuarios';
    
    });
    
    $this->get('/postagens', function() {
        
        echo 'Listagem de postagens';
    
    });

});




$app->run();
