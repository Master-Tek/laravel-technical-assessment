<div class="container mt-3">
    <div class="card">
            <div class="card-header">
                <h2>User Information</h2>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>First name:</strong> {{$user->firstName}}</li>
                <li class="list-group-item"><strong>Last name:</strong> {{$user->lastName}}</li>
                <li class="list-group-item"><strong>Address:</strong> {{$user->address}}</li>
                <li class="list-group-item"><strong>City:</strong> {{$user->city}}</li>
                <li class="list-group-item"><strong>Country:</strong> {{$user->city}}</li>
                <li class="list-group-item"><strong>Date of birth:</strong> {{$this->userDateOfBirth()}}</li>
                <li class="list-group-item"><strong>Married:</strong> {{$this->isMarried()}}</li>
                @if($user->married)
                    <li class="list-group-item"><strong>Date of marriage:</strong> {{$this->userDateOfMarriage()}}</li>
                    <li class="list-group-item"><strong>Country of marriage:</strong> {{$user->marriageCountry}}</li>
                @else
                    <li class="list-group-item"><strong>Widowed:</strong> {{$this->isWidowed()}}</li>
                    <li class="list-group-item"><strong>Married before:</strong> {{$this->wasMarriedBefore()}}</li>
                @endif
            </ul>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" wire:click="redirectToHome">Ok!</button>
            </div>
        </div>
</div>
