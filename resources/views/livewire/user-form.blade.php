<div class="container mt-3">
    <h2>Comprehensive Personal and Marital Status Form</h1>

    <form wire:submit.prevent="submit">
        @if ($currentPage == 1)
            <div>
                <div class="form-group mb-2">
                    <label for="firstName">First Name:</label>
                    <input type="text" class="form-control" wire:model="firstName" id="firstName">
                    @error('firstName') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="lastName">Last Name:</label>
                    <input type="text" class="form-control" wire:model="lastName" id="lastName">
                    @error('lastName') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" wire:model="address" id="address">
                    @error('address') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" wire:model="city" id="city">
                    @error('city') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-2">
                    <label for="country">Country:</label>
                    <input type="text" class="form-control" wire:model="country" id="country">
                    @error('country') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-2">
                    <label>Date of Birth:</label>
                    <div class="d-flex">
                        <div class="flex-grow-1 d-flex flex-column me-3">
                            <select class="form-control" wire:model="dobDay">
                                <option value="">Day</option>
                                @foreach ($days as $day)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('dobDay') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex-grow-1 d-flex flex-column me-3">
                            <select class="form-control" wire:model="dobMonth">
                                <option value="">Month</option>
                                @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                            @error('dobMonth') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex-grow-1 d-flex flex-column">
                            <select class="form-control" wire:model="dobYear">
                                <option value="">Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            @error('dobYear') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="button" class="btn btn-primary" wire:click="goToNextPage">Next</button>
                </div>
            </div>
        @elseif ($currentPage == 2)
            <div>
                <div class="form-group mb-2">
                    <label>Are you married?</label>
                    <select class="form-control" wire:model.change="married">
                        <option value="">Select...</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    @error('married') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>

                @if ($married == '1')
                    <div>
                        <div class="form-group mb-2">
                            <label>Date of Marriage:</label>
                            <div class="d-flex">
                                <div class="flex-grow-1 d-flex flex-column me-3">
                                    <select class="form-control" wire:model="marriageDateDay">
                                        <option value="">Day</option>
                                        @foreach ($days as $day)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    </select>
                                    @error('marriageDateDay') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex-grow-1 d-flex flex-column me-3">
                                    <select class="form-control" wire:model="marriageDateMonth">
                                        <option value="">Month</option>
                                        @foreach ($months as $month)
                                            <option value="{{ $month }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                    @error('marriageDateMonth') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex-grow-1 d-flex flex-column me-3">
                                    <select class="form-control" wire:model="marriageDateYear">
                                        <option value="">Year</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                    @error('marriageDateYear') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            @error('marriageDate') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="countryOfMarriage">Country of Marriage:</label>
                            <input type="text" class="form-control" wire:model="countryOfMarriage" id="countryOfMarriage">
                            @error('countryOfMarriage') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                @elseif ($married == '0')
                    <div class="form-group mb-2">
                        <label>Are you widowed?</label>
                        <select class="form-control" wire:model="isWidowed">
                            <option value="">Select...</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('isWidowed') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Have you ever been married in the past?</label>
                        <select class="form-control" wire:model="wasMarriedBefore">
                            <option value="">Select...</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        @error('wasMarriedBefore') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                @endif

                <div class="mt-3">
                    <button type="button" class="btn btn-secondary" wire:click="goToPreviousPage">Previous</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        @endif
    </form>
</div>
