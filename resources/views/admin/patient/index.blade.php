@extends("layouts.admin")
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">patient</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <form action="{{ route('patient.index') }}" method="get">
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
            <strong>Hey {{ Auth::user()->name }} !</strong> Failed to add patient. You should check in on some of those
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
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($patients as $patient)
            <tr>
                <td>{{ $patient->id }}</td>
                <td>{{ $patient->name }}</td>
                <td>{{ $patient->description }}</td>
                <td>
                    @if ($patient->status === 'on')
                        <span class="badge rounded-pill bg-success">active</span>
                    @else
                        <span class="badge rounded-pill bg-danger">Inactive</span>
                    @endif
                </td>
                <td>



                    <a href="{{ route('patient.edit', $patient->id) }}" type="button"
                        class="btn btn-sm btn-outline-success">
                        Edit
                        <span data-feather="edit-3"></span>
                    </a>

                    <form action="{{ route('patient.destroy', $patient->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"> Delete
                            <span data-feather="trash-2"></span></button>
                    </form>

                </td>


                </div>

                </div>
                </td>
            </tr>
        @endforeach
    </table>


    <div class="modal fade py-5" id="addPatient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Add patient</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('patient.store') }}" enctype="multipart/form-data" method="POST">
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
    {{ $patients->onEachSide(1)->links() }}
@endsection
