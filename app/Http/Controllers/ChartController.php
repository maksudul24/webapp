<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students;

class ChartController extends Controller
{
    public function getData()
    {
        $data = Students::all();

        return response()->json($data);
    }
}
