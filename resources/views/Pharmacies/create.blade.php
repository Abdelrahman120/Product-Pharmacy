@extends('app')

@section('content')
<div class="container my-5">
    <h1>Add New Pharmacy</h1>

    <form action="{{ route('Pharmacies.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Pharmacy Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Pharmacy Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
