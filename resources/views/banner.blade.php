<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Link</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td><img src="{{ asset('storage/' . $banner->image) }}" alt="Banner Image" style="max-width: 100px;"></td>
                    <td>{{ $banner->link }}</td>
                    <td>{{ $banner->type }}</td>
                    <td>
                        <button wire:click="edit({{ $banner->id }})" class="btn btn-sm btn-primary">Edit</button>
                        <button wire:click="delete({{ $banner->id }})" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
