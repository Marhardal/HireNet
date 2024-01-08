<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    function Job(Request $request) {
        if ($request->get('search') != Null) {
            $search = Post::where('id', 'LIKE', "%$request->get('search')%")->get();
            return response()->json(['search'=>$search]);
        }
    }
}
