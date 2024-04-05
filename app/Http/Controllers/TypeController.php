<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;

class TypeController extends Controller
{
    public function index()
    {
        $datas = Type::with('items.company')->get();
        return response()->json($datas);
    }
}
