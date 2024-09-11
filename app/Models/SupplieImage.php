<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplieImage extends Model
{
    protected $table = 'supplies_images';

    public function supplie()
    {
        return $this->belongsTo(Supplie::class, 'supplie_id');
    }
}