<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class FormComponent extends Component
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

        if ($this->married) {
            $marriageDate = Carbon::createFromDate($this->marriageDateYear, $this->marriageDateMonth, $this->marriageDateDay);
            if ($marriageDate->lessThan($dob->copy()->addYears(18))) {
                $this->addError('marriageDate', 'You are not eligible to apply because your marriage occurred before your 18th birthday.');
                return;
            }
            $formData['Marriage Date'] = $marriageDate->toDateString();
            $formData['Country of Marriage'] = $this->countryOfMarriage;
        }

        session(['formData' => $formData]);
        return redirect()->to('/results-page');
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
                'dobYear' => 'required|integer|min:1900|max:2023',
            ],
            2 => [
                'married' => 'required|boolean',
            ]
        ];

        if ($this->currentPage === 2) {
            if ($this->married) {
                $rules[2] += [
                    'marriageDateDay' => 'required|integer|min:1|max:31',
                    'marriageDateMonth' => 'required|integer|min:1|max:12',
                    'marriageDateYear' => 'required|integer|min:1900|max:2023',
                    'countryOfMarriage' => 'required|string|max:255',
                ];
            } else {
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
            'First Name' => $this->firstName,
            'Last Name' => $this->lastName,
            'Address' => $this->address,
            'City' => $this->city,
            'Country' => $this->country,
            'Date of Birth' => $dob->toDateString(),
            'Married' => $this->married ? 'Yes' : 'No',
        ];

        if ($this->married) {
            $marriageDate = Carbon::createFromDate($this->marriageDateYear, $this->marriageDateMonth, $this->marriageDateDay);
            $formData += [
                'Marriage Date' => $marriageDate->toDateString(),
                'Country of Marriage' => $this->countryOfMarriage,
            ];
        } else {
            $formData += [
                'Is Widowed' => $this->isWidowed ? 'Yes' : 'No',
                'Was Married Before' => $this->wasMarriedBefore ? 'Yes' : 'No',
            ];
        }

        return $formData;
    }

    public function render()
    {
        return view('livewire.form-component')->layout('layouts.app');
    }
}
