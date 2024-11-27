<?php

namespace App\Livewire;

use Livewire\Component;

class LivewireSamplePage extends Component
{
    public $message = "こんにちは！Livewireのテストページです。";

    public function render()
    {
        // return view('livewire.livewire-sample-page');
        $message = $this->message;
        return view('livewire.livewire-sample-page', compact('message')); // レイアウトを指定
            // ->layout('vendor.livewire.bootstrap'); // error
            // ->layout('vendor.livewire.simple-bootstrap'); // error
            // ->layout('vendor.adminlte.master'); // nothing
            // ->layout('vendor.adminlte.page'); // error
            // ->layout('layouts.app'); // nothing
    }
}
