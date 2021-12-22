<?php

namespace Uccu\SwKoa;

interface Middleware
{
    /**
     * @param \Uccu\SwKoa\Context $ctx
     */
    public function handle($ctx, callable $next);
}
