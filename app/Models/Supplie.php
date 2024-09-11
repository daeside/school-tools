<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplie extends Model
{
    protected $table = 'supplies';

    public function supplieImages()
    {
        return $this->hasMany(SupplieImage::class);
    }
}