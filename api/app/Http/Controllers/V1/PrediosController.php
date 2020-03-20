<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Services\PrediosService;
use Illuminate\Http\Request;

class PrediosController extends Controller
{
    /**
     * @var PrediosService
     */
    private $service;

    /**
     * Create a new AuthController instance.
     *
     * @param PrediosService $service
     */
    public function __construct(PrediosService $service)
    {
        $this->service = $service;
    }

    /**
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->service->list();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return $this->service->store($request);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request, $id);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        return $this->service->remove($id);
    }
}
