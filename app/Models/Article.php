<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//melumatlarin berpasi ucun elave edirik..migrationda yaradandanda modulda da yaziriq

class Article extends Model
{
    use SoftDeletes;//yazilmalidi
    function getCategori()
    {
        return $this->hasOne('App\Models\Categories','id','cat_id');
    }
    use HasFactory;
}
