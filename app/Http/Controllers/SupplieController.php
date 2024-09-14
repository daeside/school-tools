<?php

namespace App\Http\Controllers;

use App\Models\Supplie;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class SupplieController extends Controller
{
    public function getAll(){
        $model = new Supplie();
        $supplies = $model->all();
        $supplies->load('supplieImages');
        return response()->json($supplies);
    }

    public function get($id){
        try{
            $model = new Supplie();
            $supplie = $model->findOrFail($id);
            $supplie->load('supplieImages');
            return response()->json($supplie);
        }catch(ModelNotFoundException $e){
            return response()->json(['message' => 'Supplie not found'], 404);
        }
    }

    public function create(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'description' => 'required|string',
                'grade' => 'required|integer|min:1|max:6',
                'price' => 'required|numeric',
            ]);
            $supplie= new Supplie();
            $supplie->name = $request->name;
            $supplie->description = $request->description;
            $supplie->grade = $request->grade;
            $supplie->price = $request->price;
            $supplie->save();
            if (isset($request->supplie_images) && is_array($request->supplie_images)) {
                foreach ($request->supplie_images as $image) {
                    $supplie->supplieImages()->create(['url' => $image['url']]);
                }
            }
            $supplie->load('supplieImages');
            return response()->json($supplie, 201);
        }catch(ValidationException $e){
            return response()->json([
                'error' => 'Invalid request',
                'details' => $e->errors()
            ], 400);
        }
    }

    public function update(Request $request, $id){
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:100',
                'description' => 'required|string',
                'grade' => 'required|integer|min:1|max:6',
                'price' => 'required|numeric',
            ]);
            $model = new Supplie();
            $supplie = $model->findOrFail($id);
            $supplie->name = $request->name;
            $supplie->description = $request->description;
            $supplie->grade = $request->grade;
            $supplie->price = $request->price;
            $supplie->update();
            //$supplie->supplieImages()->delete();
            if (isset($request->supplie_images) && is_array($request->supplie_images)) {
                foreach ($request->supplie_images as $image) {
                    $supplie->supplieImages()->update(['url' => $image['url']]);
                }
            }
            $supplie->load('supplieImages');
            return response()->json($supplie);
        }catch(ValidationException $e){
            return response()->json([
                'error' => 'Invalid request',
                'details' => $e->errors()
            ], 400);
        }catch(ModelNotFoundException $e){
            return response()->json(['message' => 'Supplie not found'], 404);
        }
    }

    public function delete($id){
        try{
            $model = new Supplie();
            $supplie = $model->findOrFail($id);
            foreach ($supplie->supplieImages as $image) {
                $image->delete();
            }
            $supplie->delete();
            return response()->json(null, 204);
        }catch(ModelNotFoundException $e){
            return response()->json(['message' => 'Supplie not found'], 404);
        }
    }
}