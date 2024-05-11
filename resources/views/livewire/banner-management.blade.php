<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Input Banner -->
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'create' }}">
        <div class="form-group">
            <label for="type">Type</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="default" wire:model="type" value="default">
                    <label class="form-check-label" for="default">Default</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="body" wire:model="type" value="body">
                    <label class="form-check-label" for="body">Body</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="body2" wire:model="type" value="body2">
                    <label class="form-check-label" for="body2">Body 2</label>
                </div>
            </div>
            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
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

    <!-- List of Banners -->
    <table class="table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Link</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <td>{{ $banner->type }}</td>
                    <td>{{ $banner->link }}</td>
                    <td><img src="{{ asset('storage/'.$banner->image) }}" alt="Banner Image" style="max-width: 100px;"></td>
                    <td>
                        <button wire:click="edit({{ $banner->id }})" class="btn btn-primary">Edit</button>
                        <button wire:click="delete({{ $banner->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
