@extends('app')

@section('content')
<div class="container my-5">
    <h1>Product Details</h1>
    <div class="mb-4">
        <h2>{{ $product->title }}</h2>
        <p>{{ $product->description }}</p>
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" style="width: 200px; height: 200px; object-fit: cover;">
        @else
            <p>No image available</p>
        @endif
    </div>

    <h3>Available in Pharmacies</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Pharmacy Name</th>
                <th>Address</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product->pharmacies as $pharmacy)
            <tr>
                <td>{{ $pharmacy->id }}</td>
                <td>{{ $pharmacy->name }}</td>
                <td>{{ $pharmacy->address }}</td>
                <td>${{ $pharmacy->pivot->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
