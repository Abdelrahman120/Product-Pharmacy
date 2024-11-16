@extends('app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Products</h1>
        <form method="GET" action="{{ route('products.index') }}" class="mb-3" id="searchForm">
            <div class="input-group">
                <input 
                    type="text" 
                    name="query" 
                    id="searchQuery" 
                    value="{{ request('query') }}" 
                    class="form-control" 
                    placeholder="Search for products..."
                >
                <button class="btn btn-primary" type="submit">Search</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary ml-2">Reset</a> 
            </div>
        </form>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create Product</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>${{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td class="d-flex gap-2">
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#searchQuery').on('input', function() {
        let query = $(this).val();

        $.ajax({
            url: '{{ route("products.index") }}',
            method: 'GET',
            data: { query: query },
            success: function(data) {
                $('#productsTable').html(data); 
            }
        });
    });
});
</script>
@endpush