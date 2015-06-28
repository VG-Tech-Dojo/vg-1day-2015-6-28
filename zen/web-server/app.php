<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new My1DayServer\Application();
$app['debug'] = true;

$app->get('/messages', function () use ($app) {
    $messages = $app->getAllMessages();

    return $app->json($messages);
});

$app->get('/messages/{id}', function ($id) use ($app) {
    $message = $app->getMessage($id);

    return $app->json($message);
});

$app->post('/messages', function (Request $request) use ($app) {
    $data = $app->validateRequestAsJson($request);

    $username = isset($data['username']) ? $data['username'] : '';
    $body = isset($data['body']) ? $data['body'] : '';

    if($body == "uranai"){
        $kekka = mt_rand(1, 6);
        if($kekka == 1){
            $kekka = "大吉";
        }else if($kekka == 2){
            $kekka = "吉";
        }else if($kekka == 3){
            $kekka = "中吉";
        }else if($kekka == 4){
            $kekka = "小吉";
        }else if($kekka == 5){
            $kekka = "凶";
        }else{
            $kekka = "大凶";
        }       
        $createdMessage = $app->createMessage("bot", $kekka, base64_encode(file_get_contents($app['icon_image_path'])));
    }else{
        $createdMessage = $app->createMessage($username, $body, base64_encode(file_get_contents($app['icon_image_path'])));
    }
    return $app->json($createdMessage);
});

$app->delete('/messages/{id}', function ($id) use ($app) {
    $app->deleteMessage($id);

    return new Response('', Response::HTTP_NO_CONTENT, [
        'Access-Control-Allow-Origin' => '*',
    ]);
});

$app->options('/messages/{id}', function ($id) use ($app) {
    return new Response('', Response::HTTP_NO_CONTENT, [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET,DELETE',
    ]);
});

return $app;
