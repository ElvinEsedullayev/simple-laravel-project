<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    function getArticle()
    {
        return $this->hasMany('App\Models\Article','cat_id','id')->where('durum',1)->count();
        //modeli gosteririk..sonta hansi categoriya idsine aid oldugunu ve onun id si ne gore sorgu aliriq..
        //where ile durumu 1 olanlari saydirirq
    }
    use HasFactory;
}
