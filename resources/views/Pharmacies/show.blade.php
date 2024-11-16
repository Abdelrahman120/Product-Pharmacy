@extends('app')

@section('content')
<div class="container my-5">
    <h1>Pharmacy Details</h1>

    <div class="mb-3">
        <strong>Name:</strong> {{ $pharmacy->name }}
    </div>
    <div class="mb-3">
        <strong>Address:</strong> {{ $pharmacy->address }}
    </div>

    <a href="{{ route('Pharmacies.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
