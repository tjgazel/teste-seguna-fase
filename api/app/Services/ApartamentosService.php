<?php

namespace App\Services;

use App\Models\Apartamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApartamentosService
{
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

            $data = Apartamento::create($request->all());

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
            $data = Apartamento::findOrFail($id);

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

            $data = Apartamento::findOrFail($id);
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
            $data = Apartamento::findOrFail($id);

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
            'predio_id' => 'required',
            'finalidade_id' => 'required',
            'andar' => 'required|max:10',
            'numero' => 'max:12',
            'quartos' => 'required|max:2',
            'banheiros' => 'required|max:2',
            'metros' => 'required|max:20',
            'status' => 'required|boolean',
        ]);
    }
}
