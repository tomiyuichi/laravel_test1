<?php

namespace App\Http\Controllers;

use App\Models\Auto_mpg;
use Illuminate\Http\Request;

class Dynamic_mpg_Controller extends Controller
{
    public function index(Request $request)
    {
        // クエリパラメータで表示するカラムを指定
        $columns = $request->input('columns', ['id', 'car_name', 'mpg', 'cylinders', 'horsepower']); // デフォルトのカラムを指定

        // // 絞り込み条件を取得
        // $query = Auto_mpg::query();

        // 指定されたカラムのみ取得
        $cars = Auto_mpg::select($columns)->get();

        return view('dynamic_mpg.index', compact('cars', 'columns'));
    }
}
