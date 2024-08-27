<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description','start_date','end_date', 'cover_image'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function days(){
        return $this->hasMany(Day::class);
    }
}
