<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplie extends Model{
    protected $table = 'supplies';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function images(){
        return $this->hasMany(SupplieImage::class);
    }
}