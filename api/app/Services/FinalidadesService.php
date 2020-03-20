<?php

namespace App\Services;

use App\Models\Finalidade;
use Illuminate\Http\Request;

class FinalidadesService
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        try {
            $data = Finalidade::all();

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 409);
        }
    }
}
