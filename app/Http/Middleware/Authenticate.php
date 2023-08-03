<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        
         
        // log request
        Log::info('Request: ' . $request->fullUrl());
        if ($request->expectsJson()) {
            
            return null;
        }

        // For non-API requests, redirect to the login page
        return route('login');
    }
}

