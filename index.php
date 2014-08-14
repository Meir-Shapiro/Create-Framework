<?php

require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$request = Request::createFromGlobals();

$input = $request->get('name', 'World!');

$response = new Response('Hello there ' .  htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));

print_r($response->getDate());

$response->send();