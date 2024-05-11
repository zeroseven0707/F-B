<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Input FAQ -->
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'create' }}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="pictures">Pictures</label>
            <input type="file" class="form-control" id="pictures" wire:model="pictures" multiple>
            @error('pictures.*') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update' : 'Create' }}</button>
    </form>
    <hr>

    <!-- List of FAQs -->
    <table class="table">
        <thead>
            <tr>
                <th>Theme Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($set as $theme)
                <tr>
                    <td>{{ $theme->name }}</td>
                    <td>
                        <button wire:click="edit({{ $theme->id }})" class="btn btn-primary">Edit</button>
                        <a href="{{ url('theme/'.$theme->code) }}"><button class="btn btn-primary">View</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
