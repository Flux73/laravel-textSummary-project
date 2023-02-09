<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'text', 'text_summary', 'is_starred'];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
