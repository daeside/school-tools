<?php

namespace App\Http\Controllers;

use App\Commons\Rules;
use App\Commons\Validator;
use App\Models\Supplie;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class SupplieController extends Controller
{
    public function getAllForDataTables()
    {
        try {
            $query = Supplie::orderBy('created_at', 'desc');
            return DataTables::of($query)->make(true);
        } catch (Exception $ex) {
            return $this->handleException(null, $ex);
        }
    }

    public function getAll(Request $request)
    {
        try {
            $size = Validator::getQuerySize($request->query('size'));
            $supplies = Supplie::with('images')->orderBy('created_at', 'desc')->paginate($size);
            return response()->json($supplies, Response::HTTP_OK);
        } catch (Exception $ex) {
            return $this->handleException(null, $ex);
        }
    }

    public function get($id)
    {
        try {
            $supplie = Supplie::with('images')->where('id', $id)->firstOrFail();
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
            $query = Supplie::with('images')->where('id', $id)->firstOrFail();
            $supplie = $this->buildSupplie($query, $request);
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
            $supplie = Supplie::with('images')->where('id', $id)->firstOrFail();
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
