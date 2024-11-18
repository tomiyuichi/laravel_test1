<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CsvController extends Controller
{

    public function getTableColumnTypes($tableName)
    {
        $columns = DB::select("DESCRIBE $tableName");
        $columnTypes = [];

        foreach ($columns as $column) {
            $type = $column->Type; // 例: int(11), varchar(255)
            $name = $column->Field;

            // 簡略化された型情報を抽出
            if (str_contains($type, '(')) {
                $type = substr($type, 0, strpos($type, '('));
            }

            $columnTypes[$name] = $type;
        }

        return $columnTypes; // ['column1' => 'int', 'column2' => 'varchar', ...]
    }

    public function validateAndFormatRow($row, $columnTypes)
    {
        $formattedRow = [];

        foreach ($row as $columnName => $value) {
            if (!array_key_exists($columnName, $columnTypes)) {
                throw new Exception("Unknown column: $columnName");
            }

            $type = $columnTypes[$columnName];

            // 型に応じて検証・変換
            if ($type === 'int' || $type === 'bigint') {
                if (is_numeric($value)) {
                    $formattedRow[$columnName] = (int)$value;
                } else {
                    throw new Exception("Invalid integer value for column $columnName: $value");
                }
            } elseif ($type === 'varchar' || $type === 'text') {
                $formattedRow[$columnName] = (string)$value;
            } elseif ($type === 'float' || $type === 'double') {
                if (is_numeric($value)) {
                    $formattedRow[$columnName] = (float)$value;
                } else {
                    throw new Exception("Invalid float value for column $columnName: $value");
                }
            } elseif ($type === 'boolean') {
                $formattedRow[$columnName] = filter_var($value, FILTER_VALIDATE_BOOLEAN);
            } else {
                $formattedRow[$columnName] = $value; // その他の型
            }
        }

        return $formattedRow;
    }

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
        $data = array_map('str_getcsv', file($file->getRealPath()));

        // ヘッダーとデータを分離
        $header = $data[0];
        $rows = array_slice($data, 1);

        // テーブルの型情報を取得
        $tableName = 'auto_mpg_table';
        $columnTypes = $this->getTableColumnTypes($tableName);

        foreach ($rows as $row) {
            // CSVのヘッダーとデータを結合
            $rowData = array_combine($header, $row);

            try {
                // 型検証と整形
                $validatedData = $this->validateAndFormatRow($rowData, $columnTypes);
                // dump($row); // <-- apparently best for Tomi.
                // var_dump($rowData);
                // Log::debug($row);
                // echo "デバッグ情報: " . print_r($row, true);

                // データベースに挿入
                DB::table($tableName)->insert($validatedData);
            } catch (Exception $e) {
                // エラー処理
                // return back()->withErrors("Error on row: " . json_encode($row) . ". " . $e->getMessage());
                Log::debug("Error on row: " . json_encode($row) . ". " . $e->getMessage());
            }
        }

        return back()->with('success', 'CSVデータがアップロードされました。');
    }
}