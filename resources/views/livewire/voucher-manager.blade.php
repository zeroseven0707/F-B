<div>
    @if($isOpen)
        @include('livewire.create')
    @endif

    <button class="btn btn-primary" wire:click="create()">Create New Voucher</button>

    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Code</th>
                <th>Type</th>
                <th>Usage Limits</th>
                <th>Qty</th>
                <th>Min Spend</th>
                <th>Start Date</th>
                <th>Exp Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
                <tr>
                    <td><img src="{{ asset('storage/'.$voucher->image) }}" width="90" alt=""></td>
                    <td>{{ $voucher->code }}</td>
                    <td>{{ $voucher->type }}</td>
                    <td>{{ $voucher->usage_limits }}</td>
                    <td>{{ $voucher->qty }}</td>
                    <td>{{ $voucher->min_spend }}</td>
                    <td>{{ $voucher->start_date }}</td>
                    <td>{{ $voucher->exp_date }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="edit({{ $voucher->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $voucher->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
