<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Parsedown;

class MarkdownController extends Controller
{
    public function index()
    {
        // Markdownディレクトリのパス
        $directoryPath = resource_path('markdown');

        // ディレクトリ内のMarkdownファイルをスキャン
        $files = File::files($directoryPath);

        // ファイル名のみを抽出して配列に変換
        $fileList = collect($files)->map(function ($file) {
            return pathinfo($file->getFilename(), PATHINFO_FILENAME);
        });

        // AdminLTEビューにファイルリストを渡す
        return view('markdown_index', compact('fileList'));
    }

    public function show($fileName)
    {
        // Markdownファイルのパス
        $filePath = resource_path("markdown/{$fileName}.md");

        // ファイルが存在しない場合は404を返す
        if (!File::exists($filePath)) {
            abort(404, "Markdown file not found.");
        }

        // Markdownファイルの内容を取得
        $markdown = File::get($filePath);

        // MarkdownをHTMLに変換
        $parsedown = new Parsedown();
        $htmlContent = $parsedown->text($markdown);

        // AdminLTEのビューにHTMLコンテンツを渡す
        return view('markdown', compact('htmlContent'));
    }
}
