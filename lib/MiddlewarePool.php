<?php

namespace Uccu\SwKoa;

class MiddlewarePool
{
    private $middlewares = [];

    function push(Middleware $m)
    {
        array_push($this->middlewares, $m);
    }

    function pop(): ?Middleware
    {
        return array_pop($this->middlewares);
    }
}
