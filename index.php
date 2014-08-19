<?php
require_once 'vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;



$request = Request::createFromGlobals();
$routes = include 'src/pages/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

try
{
    extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
    echo "<pre>";
    print_r($matcher->match($request->getPathInfo()));
    echo "</pre>";
    die;
    ob_start();


    include sprintf('src/pages/%s.php', $_route);

    $response = new Response(ob_get_clean());
} catch(Routing\Exception\ResourceNotFoundException $e)
{
    $response = new Response('Not Found', 404);
}
catch(Exception $e)
{
    $response = new Response('An error occurred', 500);
}

$response->send();
