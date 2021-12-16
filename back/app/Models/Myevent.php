<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myevent extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'start_date',
        'end_date',
        'description',
        'city',
        'country',
        'image'
    ];
    public function join(){
        return $this->hasMany(Join::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}