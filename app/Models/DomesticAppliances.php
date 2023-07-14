<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomesticAppliances extends Model
{
    use HasFactory;
    protected $table = "domestic_appliances";
    protected $fillable = [
        'name',
        'description',
        'marking',
        'voltage'
    ];

    public function marking()
    {
        return $this->belongsTo(related: Markings::class, foreignKey: 'marking', ownerKey: 'id');
    }
}
