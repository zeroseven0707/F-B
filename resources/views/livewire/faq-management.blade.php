<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Input FAQ -->
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'create' }}">
        <div class="form-group">
            <label for="question">Question</label>
            <input type="text" class="form-control" id="question" wire:model="question">
            @error('question') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="answer">Answer</label>
            <textarea class="form-control" id="answer" rows="3" wire:model="answer"></textarea>
            @error('answer') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update' : 'Create' }}</button>
    </form>

    <hr>

    <!-- List of FAQs -->
    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($faqs as $faq)
                <tr>
                    <td>{{ $faq->question }}</td>
                    <td>{{ $faq->answer }}</td>
                    <td>
                        <button wire:click="edit({{ $faq->id }})" class="btn btn-primary">Edit</button>
                        <button wire:click="delete({{ $faq->id }})" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
