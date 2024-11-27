<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Auto_mpg;
use Livewire\WithPagination;


class LiveMpgTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap'; // これを追加

    public $message = "こんにちは！Livewireのテストページです。";
    public $search = ''; // 検索条件を保持するプロパティ

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $message = $this->message;
        $cars = Auto_mpg::where('car_name', 'like', '%' . $this->search . '%')
            ->orWhere('mpg', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.live-mpg-table', compact('cars', 'message'));
    }
}
