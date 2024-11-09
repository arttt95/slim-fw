<?php

//use Slim\Http\Request;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use Illuminate\Database\Capsule\Manager as Capsule;

require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

//////////////
// AULA 554 //
//////////////

$container = $app->getContainer();
$container['db'] = function() {

    $capsule = new Capsule;

    $capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'slim',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
    ]);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;

};

$app->get('/usuarios', function(Request $request, Response $response) {

    $db = $this->get('db');

    //////////////////////
    // CRIANDO TABELAS  //
    // COM SCHEMA BUILD //
    //////////////////////

    // $db->schema()->dropIfExists('usuarios');
    // $db->schema()->create('usuarios', function($table) {
    //     $table->increments('id');
    //     $table->string('nome');
    //     $table->string('email');
    //     $table->timestamps();
    // });

    //////////////////////
    //  INSERIR DADOS   //
    // COM SCHEMA BUILD //
    //////////////////////

    // $db->table('usuarios')->insert([

    //     'nome' => 'Lionel Pessi',
    //     'email' => 'boludo@gmail.com'

    // ]);

    ////////////////////////
    //  ATUALIZAR DADOS   //
    //  COM SCHEMA BUILD  //
    ////////////////////////

    // $db->table('usuarios')->where(
    //     'id', 1
    // )->update([
    //     'nome' => 'Lionel Pessi',
    //     'email' => 'boludo@gmail.com'
    // ]);

    ////////////////////////
    //    DELETAR DADOS   //
    //  COM SCHEMA BUILD  //
    ////////////////////////

    // $db->table('usuarios')->where(
    //     'id', 1
    // )->delete();

    ////////////////////////
    //    LISTAR DADOS    //
    //  COM SCHEMA BUILD  //
    ////////////////////////

    $tb_usuarios = $db->table('usuarios');

    $usuarios = $tb_usuarios->get();

    foreach($usuarios as $chave => $usuario) {

        echo $chave . ' => ' . $usuario->nome;
        echo '<br>';

    }
    

});





$app->run();

/*
////////////////////////
// Tipos de Respostas //
////////////////////////

// CABEÇALHO, TEXTO, JSON, XML

////////////
// HEADER //
////////////

$app->get('/header', function(Request $request, Response $response) {

    $response->getBody()->write('Esse é um retorno header');
    return $response->withHeader('allow', 'PUT')
                    ->withAddedHeader('Content-Length', 10);

});

//////////
// JSON //
//////////

$app->get('/json', function(Request $request, Response $response) {

    $data = [
        "nome" => "Cristiano Penaldo",
        "endereco" => "Rua Um"
    ];

    $response = $response->withHeader(
        'Content-Type', 'application/json'
    );

    $response->getBody()->write(json_encode($data));
    
    return $response;

});

/////////
// XML //
/////////

$app->get('/xml', function(Request $request, Response $response) {

    $xml = file_get_contents('arquivo');

    $response = $response->withHeader(
        'Content-Type', 'application/xml'
    );

    $response->getBody()->write($xml);

    return $response;

});

$app-get();

////////////////
// MIDDLEWARE //
////////////////

// Camada 1 -> Middleware
$app->add(function($request, $response, $next) {

    $response->write('Início camada 1 + ');
    //return $next($request, $response);
    $response = $next($request, $response);

    return $response->write(' + Fim da camada 1');

});


// Camada 2 -> Middleware
$app->add(function($request, $response, $next) {

    $response->write('Início camada 2 + ');
    //return $next($request, $response);
    $response = $next($request, $response);

    return $response->write(' + Fim da camada 2');

});

$app->get('/usuarios', function(Request $request, Response $response) {

    $response->getBody()->write('Ação principal usuarios');

});

$app->get('/postagens', function(Request $request, Response $response) {

    $response->getBody()->write('Ação principal postagens');

});*/




//////////////
// AULA 553 //
//////////////

/*

////////////////////////////////////
// Container Dependency Injection //
////////////////////////////////////

class Servico {
}

// Container Pimple

$container = $app->getContainer();
$container['servico'] = function() {
    return new Servico;
};

$app->get('/servico', function(Request $request, Response $response) {

    $servico = $this->get('servico');
    var_dump($servico);

});

///////////////////////////////
// Controllers como Serviços //
///////////////////////////////
*/
/*
$container = $app->getContainer();
$container['View'] = function() {
    return new MyApp\View;
};

$app->get('/usuario', '\MyApp\controllers\Home:index');
*/
/*
$container = $app->getContainer();
$container['Home'] = function() {
    return new MyApp\controllers\Home( new MyApp\View);
};

$app->get('/usuario', 'Home:index');
*/

//////////////
// AULA 552 //
//////////////

/*

// Padrão Psr7
$app->get('/postagens', function(Request $request, Response $response) {
    
    $response->getBody()->write("Listagem de postagens");

    return $response;
    //echo "Listagem de postagens";

});

// Tipos de requisição ou Verbos HTTP

// get -> Recuperar recursos do servidor (Select)
// post -> Criar dado no servidor (Insert)
// put -> Atualizar dados no servidor (Update)
// delete -> Deletar dados no servidor (Delete)

/////////////////
// POST METHOD //
/////////////////

$app->post('/usuarios/adiciona', function(Request $request, Response $response) {
    
    // Recuperar post ($_POST)
    $post = $request->getParsedBody();
    $nome = $post['nome'];
    $email = $post['email'];

    //Salavar no banco de dados com INSERT INTO...
    //... Lógica ...

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

    
    //Atualizar o banco de dados utilizando o UPDATE...
    //... Lógica ...
    

    return $response->getBody()->write(
        "Sucesso ao atualizar e o ID é: " . $id 
    );

});

///////////////////
// DELETE METHOD //
///////////////////

$app->delete('/usuarios/remove/{id}', function(Request $request, Response $response) {
    
    $id = $request->getAttribute('id');

    // Deletar no banco de dados utilizando o DELETE...
    // ... Lógica ...

    return $response->getBody()->write(
        "Sucesso ao deletar e o ID é: " . $id 
    );

});

/*

//////////////
// AULA 551 //
//////////////

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

?>