<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CsvController extends Controller
{
    public function showUploadForm()
    {
        return view('upload'); // アップロードフォーム用のビュー
    }

    public function uploadCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // CSVファイルを取得
        $file = $request->file('file');

        // ファイルを読み込む
        $data = array_map('str_getcsv', file($file->getRealPath()));

        // 必要に応じてデータの整形
        $header = $data[0];
        $rows = array_slice($data, 1);

        // データベースに挿入
        foreach ($rows as $row) {
            DB::table('auto_mpg_table')->insert(array_combine($header, $row));
        }

        return back()->with('success', 'CSVデータがアップロードされました。');
    }
}