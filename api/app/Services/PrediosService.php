<?php

namespace App\Services;

use App\Models\Predio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrediosService
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function list()
    {
        try {
            $data = Predio::with('apartamentos.finalidade')
                ->get();

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 409);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validator = $this->validateHandler($request);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toArray(), 422);
            }

            $data = Predio::create($request->all());

            return response()->json(['success' => true, 'data' => $data], 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 409);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $data = Predio::with('apartamentos.finalidade')
                ->where('id', $id)
                ->first();

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 409);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = $this->validateHandler($request);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toArray(), 422);
            }

            $data = Predio::findOrFail($id);
            $data->update($request->all());

            return response()->json(['success' => true], 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 409);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($id)
    {
        try {
            $data = Predio::findOrFail($id);

            foreach ($data->apartamentos as $ap) {
                $ap->delete();
            }

            $data->delete();

            return response()->json(['success' => true], 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 409);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateHandler(Request $request)
    {
        return Validator::make($request->all(), [
            'nome' => 'required|max:192',
            'cep' => 'required|size:8',
            'logradouro' => 'required|max:192',
            'numero' => 'required|max:10',
            'complemento' => 'max:20',
            'bairro' => 'required|max:100',
            'cidade' => 'required|max:50',
            'estado' => 'required|max:50',
        ]);
    }
}
