<div>
    <style>
        .code-editor {
        font-family: 'Courier New', Courier, monospace;
        font-size: 14px;
        line-height: 1.5;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100%;
        height: 470px;
        white-space: pre-wrap;
        overflow-wrap: break-word;
    }
    </style>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="page-header">
        <h3>About Us</h3>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('home-write/'.$code) }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('detail-product-write/'.$code) }}">Detail Product</a></li>
                <li class="breadcrumb-item"><a href="{{ url('cart-write/'.$code) }}">Cart</a></li>
                <li class="breadcrumb-item"><a href="{{ url('wishlist-write/'.$code) }}">Wishlist</a></li>
                <li class="breadcrumb-item"><a href="{{ url('catalog-write/'.$code) }}">Catalog</a></li>
                <li class="breadcrumb-item"><a href="{{ url('faqs-write/'.$code) }}">Faqs</a></li>
                <li class="breadcrumb-item"><a href="{{ url('about-write/'.$code) }}">About Us</a></li>
            </ol>
        </div>
    </div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <textarea class="code-editor" wire:model.lazy="value"></textarea>
            @error('value') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
