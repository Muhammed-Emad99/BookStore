<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    function Categories(){
        return $this->belongsToMany('App\Models\Category','book_category')  ;
    }
}
