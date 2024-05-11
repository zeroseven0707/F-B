<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Update Address -->
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" id="address" rows="3" wire:model="address"></textarea>
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Address</button>
    </form>

    <hr>

    <!-- Display Address -->
    <div class="mt-4">
        <h4>Current Address:</h4>
        <p>{{ $address }}</p>
    </div>
</div>
