<?php

namespace App\Http\Controllers;

use App\Models\Auto_mpg;
use Illuminate\Http\Request;

class Auto_mpg_Controller extends Controller
{
    public function index(Request $request)
    {
        // 絞り込み条件を取得
        $query = Auto_mpg::query();

        if ($request->filled('mpg')) {
            $query->where('mpg', $request->mpg);
        }

        if ($request->filled('cylinders')) {
            $query->where('cylinders', $request->cylinders);
        }

        if ($request->filled('min_horsepower') && $request->filled('max_horsepower')) {
            $query->whereBetween('horsepower', [$request->min_horsepower, $request->max_horsepower]);
        }

        // 絞り込んだ結果を取得
        // var_dump($query);
        $cars = $query->paginate(10);

        return view('auto_mpg.index', compact('cars'));
    }
}
