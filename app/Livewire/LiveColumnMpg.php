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
    public $search = ''; // 検索キーワード

    public function mount()
    {
        // データベースからカラムを取得
        $this->allColumns = DB::getSchemaBuilder()->getColumnListing('auto_mpg_table'); // 'auto_mpg_table'はテーブル名
        // $this->allColumns = Schema::getColumnListing('auto_mpg_table');
        $this->columns = $this->allColumns; // 初期表示では全カラムを表示
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
        if ($property === 'search') {
            $this->resetPage(); // 検索キーワード変更時にページ番号をリセット
        }
    }

    public function render()
    {
        // クエリに検索条件を適用
        $query = Auto_mpg::select($this->columns);

        if ($this->search) {
            // すべてのカラムを検索条件に使用
            foreach ($this->columns as $column) {
                $query->orWhere($column, 'LIKE', "%{$this->search}%");
            }
        }

        // if ($this->search) {
        //     // 特定のカラムを検索条件に使用
        //     $query->where(function ($query) {
        //         $query->where('car_name', 'LIKE', "%{$this->search}%")
        //               ->orWhere('mpg', 'LIKE', "%{$this->search}%");
        //     });
        // }


        // $cars = Auto_mpg::select($this->columns)->get();
        // $cars = Auto_mpg::select($this->columns)->paginate(10);
        $cars = $query->paginate(10);
        return view('livewire.live-column-mpg', compact('cars'));
    }
}

