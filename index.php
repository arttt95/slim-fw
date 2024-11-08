<?php

//use Slim\Http\Request;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as response;

require 'vendor/autoload.php';

$app = new \Slim\App;

// Padrão Psr7
$app->get('/postagens', function(Request $request, Response $response) {
    
    $response->getBody()->write("Listagem de postagens");

    return $response;
    //echo "Listagem de postagens";

});

/*
Tipos de requisição ou Verbos HTTP

get -> Recuperar recursos do servidor (Select)
post -> Criar dado no servidor (Insert)
put -> Atualizar dados no servidor (Update)
delete -> Deletar dados no servidor (Delete)

*/

/////////////////
// POST METHOD //
/////////////////

$app->post('/usuarios/adiciona', function(Request $request, Response $response) {
    
    // Recuperar post ($_POST)
    $post = $request->getParsedBody();
    $nome = $post['nome'];
    $email = $post['email'];

    /*
    Salavar no banco de dados com INSERT INTO...
    ... Lógica ...
    */

    return $response->getBody()->write(
        "Nome: " . $nome . " - E-mail: " . $email
    );

});

////////////////
// PUT METHOD //
////////////////

$app->put('/usuarios/atualiza', function(Request $request, Response $response) {
    
    // Recuperar post ($_POST)
    $post = $request->getParsedBody();
    $id = $post['id'];
    $nome = $post['nome'];
    $email = $post['email'];

    /*
    Atualizar o banco de dados utilizando o UPDATE...
    ... Lógica ...
    */

    return $response->getBody()->write(
        "Sucesso ao atualizar e o ID é: " . $id 
    );

});

///////////////////
// DELETE METHOD //
///////////////////

$app->delete('/usuarios/remove/{id}', function(Request $request, Response $response) {
    
    $id = $request->getAttribute('id');

    /*
    Deletar no banco de dados utilizando o DELETE...
    ... Lógica ...
    */

    return $response->getBody()->write(
        "Sucesso ao deletar e o ID é: " . $id 
    );

});


$app->run();

/*
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
*/
