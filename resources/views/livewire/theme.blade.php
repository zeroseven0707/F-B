<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Input FAQ -->
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'create' }}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="picture">Picture</label>
            <input type="file" class="form-control" id="picture" wire:model="picture" multiple>
            @error('picture.*') <span class="text-danger">{{ $message }}</span> @enderror
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
                <th>Picture</th>
                <th>Theme Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($set as $theme)
                <tr>
                    <td>
                            <div class="card w-75">
                                <div id="themeCarousel_{{ $theme->id }}" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($theme->picture as $key => $image)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . $image) }}" width="170" alt="...">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#themeCarousel_{{ $theme->id }}" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#themeCarousel_{{ $theme->id }}" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                    </td>
                    <td>{{ $theme->name }}</td>
                    <td>
                        <button wire:click="edit({{ $theme->id }})" class="btn btn-danger">Edit</button>
                        <a href="{{ url('home-write/'.$theme->code) }}"><button class="btn btn-primary">Write</button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
