<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class HomeController extends BaseController
{
    /**
     * @var Twig
     */
    private $twig;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->twig = $container->get('view');
    }

    public function index(Request $request, Response $response)
    {
        return $this->twig->render($response, 'home/index.html.twig');
    }
}