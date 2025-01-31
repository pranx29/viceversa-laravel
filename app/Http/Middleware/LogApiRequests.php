<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/*')) {
            $startTime = microtime(true);
            $response = $next($request);
            $endTime = microtime(true);

            // Log API request
            ApiLog::create([
                'endpoint' => $request->path(),
                'method' => $request->method(),
                'user_id' => auth()->id(),
                'request' => json_encode($request->all()),
                'response' => json_encode($response->getContent()),
                'status_code' => $response->status(),
                'execution_time' => round(($endTime - $startTime) * 1000, 2), // In ms
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
            ]);

            return $response;
        }

        // If not an API route, just pass the request through
        return $next($request);
    }
}
