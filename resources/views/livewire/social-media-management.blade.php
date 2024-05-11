<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Input Social Media -->
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'create' }}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input type="text" class="form-control" id="link" wire:model="link">
            @error('link') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" wire:model="image">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update' : 'Create' }}</button>
    </form>

    <hr>

    <!-- List of Social Media -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Link</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($socialMedias as $socialMedia)
                <tr>
                    <td>{{ $socialMedia->name }}</td>
                    <td>{{ $socialMedia->link }}</td>
                    <td><img src="{{ asset('storage/'.$socialMedia->image) }}" alt="Social Media Image" style="max-width: 100px;"></td>
                    <td>
                        <button wire:click="edit({{ $socialMedia->id }})" class="btn btn-primary">Edit</button>
                        <button wire:click="delete({{ $socialMedia->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
