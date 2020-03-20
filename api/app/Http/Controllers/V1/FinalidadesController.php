<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\FinalidadesService;
use Illuminate\Http\Request;

class FinalidadesController extends Controller
{
    /**
     * @var FinalidadesService
     */
    private $service;

    /**
     * Create a new AuthController instance.
     *
     * @param FinalidadesService $service
     */
    public function __construct(FinalidadesService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return $this->service->list($request);
    }
}
