@extends('app')

@section('content')
<div class="container my-5">
    <h1>Edit Pharmacy</h1>

    <form action="{{ route('Pharmacies.update', $pharmacy->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Pharmacy Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $pharmacy->name }}" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Pharmacy Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $pharmacy->address }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
