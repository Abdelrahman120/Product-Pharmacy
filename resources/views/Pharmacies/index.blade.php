@extends('app')

@section('content')
<div class="container my-5">
    <h1>Pharmacies</h1>

    <a href="{{ route('Pharmacies.create') }}" class="btn btn-primary mb-3">Add New Pharmacy</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pharmacies as $pharmacy)
                <tr>
                    <td>{{ $pharmacy->id }}</td>
                    <td>{{ $pharmacy->name }}</td>
                    <td>{{ $pharmacy->address }}</td>
                    <td>
                        <a href="{{ route('Pharmacies.show', $pharmacy->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('Pharmacies.edit', $pharmacy->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('Pharmacies.destroy', $pharmacy->id) }}" method="POST" style="display:inline-block;">
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
        {{ $pharmacies->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
