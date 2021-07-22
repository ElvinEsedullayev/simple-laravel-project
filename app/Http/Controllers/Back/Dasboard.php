<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;//yazdigimiz modeli elave edirik
use App\Models\Categories;//yazdigimiz modeli elave edirik
use App\Models\Page;//yazdigimiz modeli elave edirik

class Dasboard extends Controller
{
    public function index()
    {
        $article=Article::all()->count();
        $hit=Article::sum('hit');
        $category=Categories::all()->count();
        $page=Page::all()->count();
        return view('back.home',compact('article','hit','category','page'));
    }
}
