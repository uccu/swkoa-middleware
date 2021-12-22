<?php

namespace Uccu\SwKoaMiddleware;

interface Middleware
{
    /**
     * @param \Uccu\SwKoa\Context $ctx
     */
    public function handle($ctx, callable $next);
}
