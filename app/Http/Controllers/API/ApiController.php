<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class ApiController extends Controller
{
    /**
     * Determine if the request wants extended information
     *
     * @param Request $request
     * @return bool
     */
    public function wantsExtendedInformation(Request $request)
    {
        return $request->filled('extended') && $request->boolean('extended');
    }
}
