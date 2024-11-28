<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Parsedown;
use ParsedownExtra; // この行を追加

class MarkdownController extends Controller
{
    // public function index()
    // {
    //     // Markdownディレクトリのパス
    //     $directoryPath = resource_path('markdown');

    //     // ディレクトリ内のMarkdownファイルをスキャン
    //     $files = File::files($directoryPath);

    //     // ファイル名のみを抽出して配列に変換
    //     $fileList = collect($files)->map(function ($file) {
    //         return pathinfo($file->getFilename(), PATHINFO_FILENAME);
    //     });

    //     // AdminLTEビューにファイルリストを渡す
    //     return view('markdown_index', compact('fileList'));
    // }
    public function index()
    {
        // Markdownディレクトリ全体をスキャン
        $directoryPath = resource_path('markdown');
        $files = File::allFiles($directoryPath); // サブディレクトリも含む

        // ファイルパスを配列に変換
        $fileList = collect($files)->map(function ($file) use ($directoryPath) {
            $relativePath = str_replace($directoryPath . '/', '', $file->getPathname()); // 相対パス
            return [
                'path' => $relativePath, // サブディレクトリ含むパス
                'name' => ucfirst(str_replace(['-', '/'], ' ', pathinfo($relativePath, PATHINFO_FILENAME))),
            ];
        });

        return view('markdown_index', compact('fileList'));
    }

    // public function show($fileName)
    // {
    //     // Markdownファイルのパス
    //     $filePath = resource_path("markdown/{$fileName}.md");

    //     // ファイルが存在しない場合は404を返す
    //     if (!File::exists($filePath)) {
    //         abort(404, "Markdown file not found.");
    //     }

    //     // Markdownファイルの内容を取得
    //     $markdown = File::get($filePath);

    //     // MarkdownをHTMLに変換
    //     $parsedown = new Parsedown();
    //     $htmlContent = $parsedown->text($markdown);

    //     // AdminLTEのビューにHTMLコンテンツを渡す
    //     return view('markdown', compact('htmlContent'));
    // }
    public function show($path)
    {
        // リクエストされたMarkdownファイルのパスを解決
        $filePath = resource_path("markdown/{$path}");
        if (!File::exists($filePath)) {
            abort(404, "Markdown file not found.");
        }
        // MarkdownをHTMLに変換
        $markdown = File::get($filePath);

        // MarkdownをHTMLに変換
        $parsedown = new ParsedownExtra();
        $htmlContent = $parsedown->text($markdown);
        // MermaidとPlantUMLのコードブロックに対応するクラスを追加
        $htmlContent = str_replace('<pre><code class="language-mermaid">', '<div class="mermaid">', $htmlContent);
        $htmlContent = str_replace('<pre><code class="language-plantuml">', '<div class="plantuml">', $htmlContent);
        $htmlContent = str_replace('</code></pre>', '</div>', $htmlContent);



        return view('markdown', compact('htmlContent'));
    }
}
