<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Update Logo -->
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label for="image">Logo Image</label>
            <input type="file" class="form-control" id="image" wire:model="image">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Logo</button>
    </form>

    <hr>

    <!-- Display Logo Image -->
    <div class="mt-4">
        @if ($image)
            <h4>Current Logo:</h4>
            <img src="{{ asset('storage/'.$image) }}" alt="Logo Image" style="max-width: 200px;">
        @else
            <p>No logo uploaded yet.</p>
        @endif
    </div>
</div>
