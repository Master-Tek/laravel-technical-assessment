<div class="container mt-3">
    @if($formData)
        <div class="card">
            <div class="card-header">
                <h2>User Information</h2>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($formData as $key => $value)
                    <li class="list-group-item"><strong>{{ $key }}:</strong> {{ $value }}</li>
                @endforeach
            </ul>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" wire:click="redirectToHome">Ok!</button>
            </div>
        </div>
    @endif
</div>
