<?php

namespace Uccu\SwKoaMiddleware;

use Uccu\SwKoaPlugin\Plugin\HttpServerHandleBeforePlugin;

class MiddlewarePlugin implements HttpServerHandleBeforePlugin
{

    /**
     * @param \Uccu\SwKoa\Context $ctx
     */
    public function httpServerHandleBefore($ctx)
    {
        $middlewarePool = new MiddlewarePool;

        $path =  getcwd() . '/Middleware.php';
        if (file_exists($path)) {
            $middlewares = require($path);
            foreach ($middlewares as $m) {
                $middlewarePool->push(new $m);
            }
        }

        static::generateNextFunc($ctx, $middlewarePool)();
    }

    /**
     * @param \Uccu\SwKoa\Context $ctx
     */
    public static function generateNextFunc($ctx, MiddlewarePool $pool)
    {
        return function (...$p) use ($ctx, $pool) {
            $cla = $pool->pop();
            if ($cla === null) {
                return function () {
                };
            }
            return $cla->handle($ctx, static::generateNextFunc($ctx, $pool), ...$p);
        };
    }
}
