<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
class ResultsPageComponent extends Component
{
    public function mount()
    {
        if (!session()->has('formData')) {
            return redirect('/');
        }
    }

    public function redirectToHome()
    {
        session()->forget('formData');
        return redirect('/');
    }

    public function render()
    {
         $formData = session('formData');
        return view('livewire.results-page-component', ['formData' => $formData])->layout('layouts.app');
    }
}
