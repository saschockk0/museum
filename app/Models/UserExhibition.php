<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExhibition extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function exhib() {
        return $this->hasMany(Exhibition::class, 'id', 'exhibition_id');
    }
}
