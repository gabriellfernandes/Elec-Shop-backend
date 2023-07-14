<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appliances extends Model
{
    use HasFactory;
    protected $table = "appliances";
    protected $fillable = [
        'name',
        'description',
        'marking',
        'voltage'
    ];
}
