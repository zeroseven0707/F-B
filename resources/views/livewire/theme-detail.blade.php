<div>
    <table class="table">
        <thead>
            <tr>
                <th>Page</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>Home</td>
                    <td>
                        <a href="{{ url('home-write/'.$code)  }}">
                            <button class="btn btn-danger">Write</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Detail Product</td>
                    <td>
                        <a href="{{ url('detail-product-write/'.$code)  }}">
                            <button class="btn btn-danger">Write</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Cart</td>
                    <td>
                        <a href="{{ url('cart-write/'.$code)  }}">
                            <button class="btn btn-danger">Write</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Wishlist</td>
                    <td>
                        <a href="{{ url('wishlist-write/'.$code)  }}">
                            <button class="btn btn-danger">Write</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Catalog</td>
                    <td>
                        <a href="{{ url('catalog-write/'.$code)  }}">
                            <button class="btn btn-danger">Write</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Faqs</td>
                    <td>
                        <a href="{{ url('faqs-write/'.$code)  }}">
                            <button class="btn btn-danger">Write</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>About Us</td>
                    <td>
                        <a href="{{ url('about-write/'.$code)  }}">
                            <button class="btn btn-danger">Write</button>
                        </a>
                    </td>
                </tr>
        </tbody>
    </table>
</div>
