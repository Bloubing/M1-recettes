<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileRecipe extends Model
{

    public $fillable = ['image_url', 'recipe_id'];
    
    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }

    
}
