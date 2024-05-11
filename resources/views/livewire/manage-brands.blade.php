<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Input Article -->
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'create' }}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" class="form-control" id="logo" wire:model="logo">
            @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update' : 'Create' }}</button>
    </form>

    <hr>

    <!-- List of Articles -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Logo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr>
                    <td>{{ $brand->name }}</td>
                    <td><img src="{{ asset('storage/'.$brand->logo) }}" alt="brand Image" style="max-width: 100px;"></td>
                    <td>
                        <button wire:click="edit({{ $brand->id }})" class="btn btn-primary">Edit</button>
                        <button wire:click="delete({{ $brand->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
