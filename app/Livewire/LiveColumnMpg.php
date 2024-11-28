<?php

namespace App\Livewire;
use App\Models\Auto_mpg;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class LiveColumnMPG extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; // これを追加

    public $columns = []; // 表示するカラム
    public $allColumns = []; // データベースから取得した全てのカラム候補

    public $search = '';           // 検索キーワード
    public $minMpg = null;         // 数値範囲検索の最小値
    public $maxMpg = null;         // 数値範囲検索の最大値
    public $minHorsepower = null;  // 数値範囲検索の最小値
    public $maxHorsepower = null;  // 数値範囲検索の最大値

    public function mount()
    {
        // データベースからカラムを取得
        $this->allColumns = DB::getSchemaBuilder()->getColumnListing('auto_mpg_table'); // 'auto_mpg_table'はテーブル名
        // $this->allColumns = Schema::getColumnListing('auto_mpg_table');
        $this->columns = $this->allColumns; // 初期表示では全カラムを表示

        $this ->minMpg = Auto_mpg::min('mpg'); //null;         // 数値範囲検索の最小値
        $this ->maxMpg = Auto_mpg::max('mpg'); //null;         // 数値範囲検索の最大値
        $this ->minHorsepower = Auto_mpg::min('horsepower'); //null;  // 数値範囲検索の最小値
        $this ->maxHorsepower = Auto_mpg::max('horsepower'); //null;  // 数値範囲検索の最大値
    }

    public function toggleColumn($column)
    {
        // カラムをトグル（追加/削除）する
        if (in_array($column, $this->columns)) {
            $this->columns = array_diff($this->columns, [$column]);
        } else {
            $this->columns[] = $column;
        }
    }

    public function updating($property)
    {
        // if ($property === 'search') {
        //     $this->resetPage(); // 検索キーワード変更時にページ番号をリセット
        // }
        // 検索条件変更時にページ番号をリセット
        if (in_array($property, ['search', 'minMpg', 'maxMpg', 'minHorsepower', 'maxHorsepower'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        // クエリに検索条件を適用
        $query = Auto_mpg::select($this->columns);

        // if ($this->search) {
        //     // すべてのカラムを検索条件に使用
        //     // 数値の範囲検索と同時実装すると、挙動が変になったので、特定のカラムの検索に変更
        //     foreach ($this->columns as $column) {
        //         $query->orWhere($column, 'LIKE', "%{$this->search}%");
        //     }
        // }

        if ($this->search) {
            // 特定のカラムを検索条件に使用
            $query->where(function ($query) {
                $query->where('car_name', 'LIKE', "%{$this->search}%")
                      ->orWhere('weight', 'LIKE', "%{$this->search}%");
            });
        }

        // 日付範囲検索
        if (!is_null($this->minMpg) && !is_null($this->maxMpg)) {
            $query->whereBetween('mpg', [$this->minMpg, $this->maxMpg]);
        }

        // 数値範囲検索
        if (!is_null($this->minHorsepower) && !is_null($this->maxHorsepower)) {
            $query->whereBetween('horsepower', [$this->minHorsepower, $this->maxHorsepower]);
        }

        // $cars = Auto_mpg::select($this->columns)->get();
        // $cars = Auto_mpg::select($this->columns)->paginate(10);
        $cars = $query->paginate(10);//->appends($request->query());
        return view('livewire.live-column-mpg', compact('cars'));
    }
}

