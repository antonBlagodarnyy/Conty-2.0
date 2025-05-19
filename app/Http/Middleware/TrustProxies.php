<?php
namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;


class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies = '*'; // Trust all proxies; or set specific proxy IPs

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = 15;
}
