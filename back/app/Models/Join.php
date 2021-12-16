<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    use HasFactory;
    protected $fillable = [
        'myevent_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function myevent(){
        return $this->belongsTo(Myevent::class, 'myevent_id');
    }
}
