<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;

class UserForm extends Component
{
    public $currentPage = 1;

    // Fields for page 1
    public $firstName, $lastName, $address, $city, $country;
    public $dobDay, $dobMonth, $dobYear;

    // Fields for page 2
    public $married, $marriageDateDay, $marriageDateMonth, $marriageDateYear;
    public $countryOfMarriage, $isWidowed, $wasMarriedBefore;

    public $days = [];
    public $months = [];
    public $years = [];

    public function mount()
    {
        session()->forget('formData');
        // Populate days
        for ($i = 1; $i <= 31; $i++) {
            $this->days[] = $i;
        }

        // Populate months
        for ($i = 1; $i <= 12; $i++) {
            $this->months[] = $i;
        }

        // Populate years (example range: 1900 - current year)
        for ($i = 1900; $i <= now()->year; $i++) {
            $this->years[] = $i;
        }
    }

    public function goToNextPage()
    {
        $this->validatePage();
        $this->currentPage++;
    }

    public function goToPreviousPage()
    {
        $this->currentPage--;
    }

    public function submit()
    {
        $this->validatePage();

        $dob = Carbon::createFromDate($this->dobYear, $this->dobMonth, $this->dobDay);
        $formData = $this->collectFormData($dob);

        if ($formData['married']) {
            if ($formData['dateOfMarriage']->lessThan($dob->copy()->addYears(18))) {
                $this->addError('marriageDate', 'You are not eligible to apply because your marriage occurred before your 18th birthday.');
                return;
            }
        }

        $user = User::create($formData);

        session()->flash('sucess-message', 'User saved successfully.');
        return redirect()->to('/users/'. $user->id);
    }

    protected function validatePage()
    {
        $rules = [
            1 => [
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'dobDay' => 'required|integer|min:1|max:31',
                'dobMonth' => 'required|integer|min:1|max:12',
                'dobYear' => 'required|integer|min:1900|max:2024',
            ],
            2 => [
                'married' => 'required|boolean',
            ]
        ];

        if ($this->currentPage === 2) {
            if ($this->married === '1') {
                $rules[2] += [
                    'marriageDateDay' => 'required|integer|min:1|max:31',
                    'marriageDateMonth' => 'required|integer|min:1|max:12',
                    'marriageDateYear' => 'required|integer|min:1900|max:2023',
                    'countryOfMarriage' => 'required|string|max:255',
                ];
            } elseif ($this->married === '0') {
                $rules[2] += [
                    'isWidowed' => 'required|boolean',
                    'wasMarriedBefore' => 'required|boolean',
                ];
            }
        }

        $this->validate($rules[$this->currentPage]);
    }

    private function collectFormData(Carbon $dob)
    {
        $formData = [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'dateOfBirth' => $dob,
            'married' => $this->married,
        ];

        if ($this->married) {
            $marriageDate = Carbon::createFromDate($this->marriageDateYear, $this->marriageDateMonth, $this->marriageDateDay);
            $formData += [
                'dateOfMarriage' => $marriageDate,
                'marriageCountry' => $this->countryOfMarriage,
            ];
        } else {
            $formData += [
                'widowed' => $this->isWidowed,
                'marriedInPast' => $this->wasMarriedBefore,
            ];
        }

        return $formData;
    }

    public function render()
    {
        return view('livewire.user-form')->layout('layouts.app');
    }
}
