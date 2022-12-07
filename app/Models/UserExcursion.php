<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExcursion extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function excurs() {
        return $this->hasMany(Excursion::class, 'id', 'excursion_id');
    }
}
