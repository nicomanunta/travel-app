<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    
    protected $fillable = ['stop_id', 'content'];

    public function stop(){
        return $this->belongsTo(Stop::class);
    }
}
