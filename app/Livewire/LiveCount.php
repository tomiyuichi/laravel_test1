<?php

namespace App\Livewire;

use Livewire\Component;

class LiveCount extends Component
{
    public $text = ''; // 入力フィールドの内容を保持するプロパティ

    public function render()
    {
        return view('livewire.live-count');
    }
}
