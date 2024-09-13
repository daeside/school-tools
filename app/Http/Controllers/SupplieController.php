<?php

namespace App\Http\Controllers;

use App\Models\Supplie;
use Illuminate\Http\Request;

class SupplieController extends Controller
{
    public function getAll()
    {
        $model = new Supplie();
        $supplies = $model->all();
        $supplies->load('supplieImages');
        return $supplies;
    }

    public function get($id)
    {
        $model = new Supplie();
        $supplie = $model->find($id);
        $supplie->load('supplieImages');
        return $supplie;
    }

    public function create(Request $request)
    {
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
        return $supplie->id;
    }
}