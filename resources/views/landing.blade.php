@extends('app')

@section('content')
<div class="container text-center my-5">
    <h1>Welcome to Our App</h1>
    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="btn btn-primary mx-2">View Products</a>
        <a href="{{ route('Pharmacies.index') }}" class="btn btn-secondary mx-2">View Pharmacies</a>
    </div>
</div>
@endsection
