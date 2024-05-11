<div>
    <form wire:submit.prevent="store">
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" wire:model="image">
            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control" wire:model="code" placeholder="Code">
        </div>
        <div class="form-group">
            <label>Type</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" wire:model="type" id="public" value="public">
                <label class="form-check-label" for="public">Public</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" wire:model="type" id="private" value="private">
                <label class="form-check-label" for="private">Private</label>
            </div>
        </div>
        <div class="form-group">
            <label for="usage_limits">Usage Limits</label>
            <input type="text" class="form-control" wire:model="usage_limits" placeholder="Usage Limits">
        </div>
        <div class="form-group">
            <label for="qty">Qty</label>
            <input type="text" class="form-control" wire:model="qty" placeholder="Qty">
        </div>
        <div class="form-group">
            <label for="min_spend">Min Spend</label>
            <input type="text" class="form-control" wire:model="min_spend" placeholder="Min Spend">
        </div>
        <div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date" class="form-control" wire:model="start_date">
        </div>
        <div class="form-group">
            <label for="exp_date">Exp Date</label>
            <input type="date" class="form-control" wire:model="exp_date">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
