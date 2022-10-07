<?php

namespace App\Http\Controllers;

use App\Models\Breakdown;
use App\Models\Random;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RandomController extends Controller
{
    //

    public function index() {
        return Random::all();
    }

    public function totalRandoms() {
        return count(Random::all());
    }

    public function getBreakdown($id) {
        return Random::find($id)->breakdown;
    }
}
