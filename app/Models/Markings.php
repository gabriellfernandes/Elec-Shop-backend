<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Markings extends Model
{
    use HasFactory;
    protected $table = "markings";
    protected $fillable = [
        'name',
    ];

    public function domesticAppliances()
    {
        return $this->hasMany(related: DomesticAppliances::class, foreignKey: 'marking', localKey: 'id');
    }
}
