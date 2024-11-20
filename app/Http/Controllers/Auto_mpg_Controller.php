<?php

namespace App\Http\Controllers;

use App\Models\Auto_mpg;
use Illuminate\Http\Request;

class Auto_mpg_Controller extends Controller
{
    public function index(Request $request)
    {

        $limits = [
            'debug_1' => 'hoge',
            'debug_2' => 'hige',
            'displacement' => [
                'min' => Auto_mpg::min('displacement'),
                'max' => Auto_mpg::max('displacement'),
            ],
            'mpg' => [
                'min' => Auto_mpg::min('mpg'),
                'max' => Auto_mpg::max('mpg'),
            ],
            'cylinders' => [
                'min' => Auto_mpg::min('cylinders'),
                'max' => Auto_mpg::max('cylinders'),
            ],
            'horsepower' => [
                'min' => Auto_mpg::min('horsepower'),
                'max' => Auto_mpg::max('horsepower'),
            ],
        ];

        // ソート条件を取得
        $sortColumn = $request->input('sort_column', 'id'); // デフォルトは'id'
        $sortOrder = $request->input('sort_order', 'asc');  // デフォルトは'asc'

        // 絞り込み条件を取得
        $query = Auto_mpg::query();

        if ($request->filled('mpg')) {
            $query->where('mpg', $request->mpg);
        }

        // if ($request->filled('cylinders')) {
        //     $query->where('cylinders', $request->cylinders);
        // }

        if ($request->filled('min_cylinders')) {
            $query->where('cylinders', '>=', $request->min_cylinders);
        }
        if ($request->filled('max_cylinders')) {
            $query->where('cylinders', '<=', $request->max_cylinders);
        }

        // if ($request->filled('min_horsepower') && $request->filled('max_horsepower')) {
        //     $query->whereBetween('horsepower', [$request->min_horsepower, $request->max_horsepower]);
        // }

        // min以上
        if ($request->filled('min_horsepower')){
            $query->where('horsepower', '>=', $request->min_horsepower);
        }
        // max以下
        if ($request->filled('max_horsepower')){
            $query->where('horsepower', '<=', $request->max_horsepower);
        }

        // 絞り込んだ結果を取得
        // dump($request -> session() -> get('cylinders'));
        dump($request -> query() );
        $cars = $query
            ->orderBy($sortColumn, $sortOrder)
            ->paginate(10)                // 1ページあたり10件
            ->appends($request->query()); // クエリパラメータを保持

        return view('auto_mpg.index', compact('cars', 'limits', 'sortColumn', 'sortOrder'));
    }
}
