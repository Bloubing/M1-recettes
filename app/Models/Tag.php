<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }

    public function isDefaultTag() {
        return $this->name == "Apéritif" || $this->name == "Entrée" || $this->name == "Plat" || $this->name == "Boisson" || $this->name == "Dessert";
    }
}
