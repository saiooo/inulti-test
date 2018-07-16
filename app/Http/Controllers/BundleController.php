<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bundle;

class BundleController extends Controller
{
    public function index() {
        $bundles = Bundle::all();
        return response()->json($bundles);
    }
}
