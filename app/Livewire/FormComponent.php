<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;
class FormComponent extends Component
{
    public $currentPage = 1;

    // Fields for page 1
    public $firstName;
    public $lastName;
    public $address;
    public $city;
    public $country;
    public $dobMonth;
    public $dobDay;
    public $dobYear;

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


    // Fields for page 2
    public $married;
    public $marriageDateMonth;
    public $marriageDateDay;
    public $marriageDateYear;
    public $countryOfMarriage;
    public $isWidowed;
    public $wasMarriedBefore;

    public function goToNextPage()
    {
        $this->validatePage($this->currentPage);
        $this->currentPage++;
    }

    public function goToPreviousPage()
    {
        $this->currentPage--;
    }

    public function submit()
    {
        $this->validatePage(2); // Validates the second page fields

        // Combine the date of birth fields
        $dob = Carbon::createFromDate($this->dobYear, $this->dobMonth, $this->dobDay);

        // Validate if marriage date is before 18th birthday (if applicable)
        if ($this->married == '1') {
            $marriageDate = Carbon::createFromDate($this->marriageDateYear, $this->marriageDateMonth, $this->marriageDateDay);
            $eighteenthBirthday = $dob->copy()->addYears(18);

            if ($marriageDate->lessThan($eighteenthBirthday)) {
                $this->addError('marriageDate', 'You are not eligible to apply because your marriage occurred before your 18th birthday.');
                return;
            }
        }

        $marriedData = $this->married == '1' ? [
            'Marriage Date' => $marriageDate->toDateString(),
            'Country of Marriage' => $this->countryOfMarriage,
        ] : [
            'Is Widowed' => $this->isWidowed ? 'Yes' : 'No',
            'Was Married Before' => $this->wasMarriedBefore ? 'Yes' : 'No'
        ];

        $formData = array_merge([
            'First Name' => $this->firstName,
            'Last Name' => $this->lastName,
            'Address' => $this->address,
            'City' => $this->city,
            'Country' => $this->country,
            'Date of Birth' => $dob ? $dob->toDateString() : 'N/A',
            'Married' => $this->married == '1' ? 'Yes' : 'No',
        ], $marriedData);

        // Set the form data to the session
        session(['formData' => $formData]);

        // Redirect to a page to show the results or just show them on the current page
        return redirect()->to('/results-page');
    }

    protected function validatePage($page)
    {
        if ($page === 1) {
            $this->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'country' => 'required|string|max:255',
                'dobDay' => 'required|integer|min:1|max:31',
                'dobMonth' => 'required|integer|min:1|max:12',
                'dobYear' => 'required|integer|min:1900|max:2023',
            ]);
        } elseif ($page === 2) {
            $this->validate([
                'married' => 'required|boolean',
            ]);

            if ($this->married == '1')
            {
                $this->validate([
                    'marriageDateDay' => 'required|integer|min:1|max:31',
                    'marriageDateMonth' => 'required|integer|min:1|max:12',
                    'marriageDateYear' => 'required|integer|min:1900|max:2023',
                    'countryOfMarriage' => 'required|string|max:255',
                ]);
            } else if ($this->married == '0') {
                $this->validate([
                    'married' => 'required|boolean',
                    'isWidowed' => 'required|boolean',
                    'wasMarriedBefore' => 'required|boolean',
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.form-component')->layout('layouts.app');
    }
}
