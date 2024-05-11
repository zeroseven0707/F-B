<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <!-- Form Input Banner -->
    <form wire:submit.prevent="{{ $updateMode ? 'update' : 'create' }}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" wire:model="email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="province">Province</label>
            <input type="text" class="form-control" id="province" wire:model="province">
            @error('province') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" wire:model="city">
            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="district">District</label>
            <input type="text" class="form-control" id="district" wire:model="district">
            @error('district') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="subdistrict">Sub District</label>
            <input type="text" class="form-control" id="subdistrict" wire:model="subdistrict">
            @error('subdistrict') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" wire:model="address">
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="url">Url Web</label>
            <input type="text" class="form-control" id="url" wire:model="url">
            @error('url') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="image">Password</label>
            <input type="password" class="form-control" id="password" wire:model="password">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ $updateMode ? 'Update' : 'Create' }}</button>
    </form>

    <hr>

    <!-- List of Banners -->
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>API Key</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($client as $clients)
                <tr>
                    <td>{{ $clients->name }}</td>
                    <td>{{ $clients->email }}</td>
                    <td>{{ $clients->api_key }}</td>
                    <td>
                        @if ($clients->status == 'on')
                        <button wire:click="delete({{ $clients->id }})" class="btn btn-primary">On</button>
                            @else
                            <button wire:click="delete({{ $clients->id }})" class="btn btn-danger">Off</button>
                        @endif
                    </td>
                    <td>
                        <button wire:click="edit({{ $clients->id }})" class="btn btn-primary">Edit</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
