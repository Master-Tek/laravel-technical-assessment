<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;

class UsersInfo extends Component
{
    public $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }
    
    public function userDateOfBirth()
    {   
        return \Carbon\Carbon::parse($this->user?->dateOfBirth)->format('d-m-Y');
    }

    public function isMarried()
    {   
        return $this->user?->married ? 'Yes' : 'No';
    }

    public function userDateOfMarriage()
    {   
        return \Carbon\Carbon::parse($this->user?->dateOfMarriage)->format('d-m-Y');
    }

    public function isWidowed()
    {   
        return $this->user?->widowed ? 'Yes' : 'No';
    }

    public function wasMarriedBefore()
    {   
        return $this->user?->marriedInPast ? 'Yes' : 'No';
    }

    public function redirectToHome()
    {
        session()->forget('formData');
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.users-info', ['user' => $this->user])->layout('layouts.app');
    }
}
