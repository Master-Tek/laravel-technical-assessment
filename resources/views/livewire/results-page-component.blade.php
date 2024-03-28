<div>
    @if($formData)
        <div>
            <h2>User Information</h2>
            <ul>
                @foreach($formData as $key => $value)
                    <li>{{ $key }}: {{ $value }}</li>
                @endforeach
            </ul>
            <button type="button" wire:click="redirectToHome">Ok!</button>
        </div>
    @endif
</div>
