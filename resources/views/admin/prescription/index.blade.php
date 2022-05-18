
@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Patient</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <form action="{{ route('prescription.index') }}" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="s" placeholder="Search"
                    value="{{ request()->s }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                        <span data-feather="search"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="btn-toolbar mb-2 mb-md-0">
        <a type="button" data-bs-toggle="modal" data-bs-target="#addPatient" class="btn btn-sm btn-secondary">
            Add Patient
            <span data-feather="plus-square"></span>
        </a>
    </div>
</div>
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Hey {{ Auth::user()->name }} !</strong> Failed to add prescription. You should check in on some of those
            fields you have entered.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif




    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Title</th>
            <th>patients</th>
            <th>Description</th>

            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->id }}</td>
                <td>{{ $prescription->name }}</td>

                <td>{{ $prescription->title }}</td>
                <td>
                    @foreach ($prescription->patients as $patient)
                        <span class="badge rounded-pill bg-secondary" >{{ $patient->name }}</span>
                    @endforeach
                </td>
                <td>{{ $prescription->description }}</td>

                <td>
                    @if ($prescription->status === 'on')
                        <span class="badge rounded-pill bg-success">active</span>
                    @else
                        <span class="badge rounded-pill bg-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('prescription.edit', $prescription->id) }}" class="btn btn-sm btn-outline-secondary">Edit
                        <span data-feather="edit"></span>
                    </a>
                    <form action="{{ route('prescription.destroy', $prescription->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete
                            <span data-feather="trash"></span>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach



    </table>
    <div class="modal fade py-5" id="addPatient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h2 class="fw-bold mb-0">Add Patient</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="{{ route('prescription.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                            value="{{ old('name') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="patient">Category</label>
                        <select class="form-select" id="patient" name="patients[]">
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>





                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>


                </form>


            </div>

        </div>
    </div>

</div>
{{ $prescriptions->onEachSide(1)->links() }}


@endsection
