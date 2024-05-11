<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Input Article -->
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'create' }}">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" wire:model="title">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" wire:model="date">
            @error('date') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="text">Text</label>
            <textarea class="form-control" id="text" rows="3" wire:model="text"></textarea>
            @error('text') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" wire:model="image">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update' : 'Create' }}</button>
    </form>

    <hr>

    <!-- List of Articles -->
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Text</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article)
                <tr>
                    <td>{{ $article->title }}</td>
                    <td>{{ $article->date }}</td>
                    <td>{{ $article->text }}</td>
                    <td><img src="{{ asset('storage/'.$article->image) }}" alt="Article Image" style="max-width: 100px;"></td>
                    <td>
                        <button wire:click="edit({{ $article->id }})" class="btn btn-primary">Edit</button>
                        <button wire:click="delete({{ $article->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
