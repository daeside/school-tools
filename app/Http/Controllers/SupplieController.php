<?php

namespace App\Http\Controllers;

use App\Commons\ValidatorRules;
use App\Models\Supplie;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class SupplieController extends Controller
{
    public function getAll()
    {
        $supplies = Supplie::all();
        $supplies->load('images');
        return response()->json($supplies);
    }

    public function get($id)
    {
        try {
            $supplie = Supplie::findOrFail($id);
            $supplie->load('images');
            return response()->json($supplie);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Supplie not found'], 404);
        }
    }

    public function create(Request $request)
    {
        try {
            $validated = $request->validate(ValidatorRules::supplie());
            $supplie = $this->buildSupplie(new Supplie(), $request);
            $this->buildAndLoadImages($supplie, $request);
            return response()->json($supplie, 201);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Invalid request',
                'details' => $e->errors()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate(ValidatorRules::supplie());
            $supplie = $this->buildSupplie(Supplie::findOrFail($id), $request);
            $supplie->images()->delete();
            $this->buildAndLoadImages($supplie, $request);
            return response()->json($supplie);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Invalid request',
                'details' => $e->errors()
            ], 400);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Supplie not found'], 404);
        }
    }

    public function delete($id)
    {
        try {
            $supplie = Supplie::findOrFail($id);
            foreach ($supplie->images as $image) {
                $image->delete();
            }
            $supplie->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Supplie not found'], 404);
        }
    }

    private function buildSupplie(Supplie $supplie, Request $request): Supplie
    {
        $supplie->name = $request->name;
        $supplie->description = $request->description;
        $supplie->grade = $request->grade;
        $supplie->price = $request->price;
        $supplie->save();
        return $supplie;
    }

    private function buildAndLoadImages(Supplie $supplie, Request $request)
    {
        if (isset($request->images) && is_array($request->images)) {
            foreach ($request->images as $image) {
                $supplie->images()->create(['url' => $image['url']]);
            }
        }
        $supplie->load('images');
    }
}
