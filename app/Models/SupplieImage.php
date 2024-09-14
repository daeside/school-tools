<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplieImage extends Model{
    protected $table = 'supplies_images';

    protected $fillable = ['url'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function supplie(){
        return $this->belongsTo(Supplie::class, 'supplie_id');
    }
}