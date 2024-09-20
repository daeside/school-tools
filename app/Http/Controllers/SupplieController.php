<?php

namespace App\Http\Controllers;

use App\Commons\Rules;
use App\Models\Supplie;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SupplieController extends Controller
{
    public function getAll(Request $request)
    {
        try {
            $size = $request->query('size');
            $supplies = Supplie::orderBy('created_at', 'desc')->paginate($size);
            $supplies->load('images');
            return response()->json($supplies, Response::HTTP_OK);
        } catch (Exception $ex) {
            return $this->handleException(null, $ex);
        }
    }

    public function get($id)
    {
        try {
            $supplie = Supplie::findOrFail($id);
            $supplie->load('images');
            return response()->json($supplie, Response::HTTP_OK);
        } catch (Exception $ex) {
            return $this->handleException(null, $ex);
        }
    }

    public function create(Request $request)
    {
        try {
            $validated = $request->validate(Rules::SUPPLIE_RULES);
            $supplie = $this->buildSupplie(new Supplie(), $request);
            $this->buildAndLoadImages($supplie, $request);
            return response()->json($supplie, Response::HTTP_CREATED);
        } catch (Exception $ex) {
            return $this->handleException($request, $ex);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate(Rules::SUPPLIE_RULES);
            $supplie = $this->buildSupplie(Supplie::findOrFail($id), $request);
            $supplie->images()->delete();
            $this->buildAndLoadImages($supplie, $request);
            return response()->json($supplie, Response::HTTP_OK);
        } catch (Exception $ex) {
            return $this->handleException($request, $ex);
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
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (Exception $ex) {
            return $this->handleException(null, $ex);
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
