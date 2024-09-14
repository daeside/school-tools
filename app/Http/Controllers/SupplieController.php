<?php

namespace App\Http\Controllers;

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
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'description' => 'required|string',
                'grade' => 'required|integer|min:1|max:6',
                'price' => 'required|numeric',
            ]);
            $supplie = new Supplie();
            $supplie->name = $request->name;
            $supplie->description = $request->description;
            $supplie->grade = $request->grade;
            $supplie->price = $request->price;
            $supplie->save();
            if (isset($request->images) && is_array($request->images)) {
                foreach ($request->images as $image) {
                    $supplie->images()->create(['url' => $image['url']]);
                }
            }
            $supplie->load('images');
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
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'description' => 'required|string',
                'grade' => 'required|integer|min:1|max:6',
                'price' => 'required|numeric',
            ]);
            $supplie = Supplie::findOrFail($id);
            $supplie->name = $request->name;
            $supplie->description = $request->description;
            $supplie->grade = $request->grade;
            $supplie->price = $request->price;
            $supplie->save();
            $supplie->images()->delete();
            if (isset($request->images) && is_array($request->images)) {
                foreach ($request->images as $image) {
                    $supplie->images()->create(['url' => $image['url']]);
                }
            }
            $supplie->load('images');
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
}
