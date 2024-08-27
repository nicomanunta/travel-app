<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    use HasFactory;

    protected $fillable = ['day_id', 'title', 'description', 'latitude', 'longitude', 'image', 'food', 'curiosities'];

    public function day(){
        return $this->belongsTo(Day::class);
    }
    public function notes(){
        return $this->hasMany(Note::class);
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}
