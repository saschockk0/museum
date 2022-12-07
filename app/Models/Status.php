<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function excurs() {
        return $this->hasMany(Excursion::class, 'status_id', 'id');
    }

    public function exhib() {
        return $this->hasMany(Excursion::class, 'status_id', 'id');
    }
}
