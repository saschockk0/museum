<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Excursion extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user() {
        return $this->belongsToMany(User::class, 'user_excursions');
    }

    public function status() {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
