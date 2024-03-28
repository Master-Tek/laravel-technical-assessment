<div>
    <form wire:submit.prevent="submit">
        {{-- Page Navigation --}}
        @if ($currentPage == 1)
            {{-- Page 1: Personal Information --}}
            <div>
                <label>First Name:</label>
                <input type="text" wire:model="firstName">
                @error('firstName') <span class="error">{{ $message }}</span> @enderror

                <label>Last Name:</label>
                <input type="text" wire:model="lastName">
                @error('lastName') <span class="error">{{ $message }}</span> @enderror

                <label>Address:</label>
                <input type="text" wire:model="address">
                @error('address') <span class="error">{{ $message }}</span> @enderror

                <label>City:</label>
                <input type="text" wire:model="city">
                @error('city') <span class="error">{{ $message }}</span> @enderror

                <label>Country:</label>
                <input type="text" wire:model="country">
                @error('country') <span class="error">{{ $message }}</span> @enderror

                <label>Date of Birth:</label>
                <select wire:model="dobDay">
                    <option value="">Day</option>
                    @foreach ($days as $day)
                        <option value="{{ $day }}">{{ $day }}</option>
                    @endforeach
                </select>
                <select wire:model="dobMonth">
                    <option value="">Month</option>
                    @foreach ($months as $month)
                        <option value="{{ $month }}">{{ $month }}</option>
                    @endforeach
                </select>
                <select wire:model="dobYear">
                    <option value="">Year</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
                @error('dobDay') <span class="error">{{ $message }}</span> @enderror
                @error('dobMonth') <span class="error">{{ $message }}</span> @enderror
                @error('dobYear') <span class="error">{{ $message }}</span> @enderror

                <button type="button" wire:click="goToNextPage">Next</button>
            </div>
        @elseif ($currentPage == 2)
            {{-- Page 2: Marital Status --}}
            @error('marriageDate') <span class="error">{{ $message }}</span> @enderror
            <div>
                <label>Are you married?</label>
                <select wire:model.change="married">
                    <option value="">Select...</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('married') <span class="error">{{ $message }}</span> @enderror

                @if ($married == '1')
                    {{-- Fields shown if married --}}
                    <div>
                        <label>Date of Marriage:</label>
                        <select wire:model="marriageDateDay">
                            <option value="">Day</option>
                            @foreach ($days as $day) <!-- Make sure these are the correct variables for marriage date -->
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                        <select wire:model="marriageDateMonth">
                            <option value="">Month</option>
                            @foreach ($months as $month)
                                <option value="{{ $month }}">{{ $month }}</option>
                            @endforeach
                        </select>
                        <select wire:model="marriageDateYear">
                            <option value="">Year</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        @error('marriageDateDay') <span class="error">{{ $message }}</span> @enderror
                        @error('marriageDateMonth') <span class="error">{{ $message }}</span> @enderror
                        @error('marriageDateYear') <span class="error">{{ $message }}</span> @enderror

                        <label>Country of Marriage:</label>
                        <input type="text" wire:model="countryOfMarriage">
                        @error('countryOfMarriage') <span class="error">{{ $message }}</span> @enderror
                    </div>
                @elseif ($married == '0')
                    {{-- Fields shown if not married --}}
                    <label>Are you widowed?</label>
                    <select wire:model="isWidowed">
                        <option value="">Select...</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    @error('isWidowed') <span class="error">{{ $message }}</span> @enderror

                    <label>Have you ever been married in the past?</label>
                    <select wire:model="wasMarriedBefore">
                        <option value="">Select...</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    @error('wasMarriedBefore') <span class="error">{{ $message }}</span> @enderror
                @endif

                <button type="button" wire:click="goToPreviousPage">Previous</button>
                <button type="submit">Submit</button>
            </div>
        @endif
    </form>
</div>
 