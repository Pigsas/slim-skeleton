<?php

namespace App\Controllers;

use Psr\Container\ContainerInterface;

class BaseController
{

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * BaseController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

}