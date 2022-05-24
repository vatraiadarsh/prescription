@extends("layouts.admin")
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">prescriptionform</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <form action="{{ route('prescriptionform.index') }}" method="get">
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
                Add PrescriptionForm
                <span data-feather="plus-square"></span>
            </a>
        </div>

    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Hey {{ Auth::user()->name }} !</strong> Failed to add prescriptionform. You should check in on some of those
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
            <th>Priscription Id</th>
            <th>Medicine Name</th>
            <th>Per Day</th>
            <th>Duration (in days)</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        @foreach ($prescriptionforms as $prescriptionform)
            <tr>
                <td>{{ $prescriptionform->id }}</td>
                <td>{{ $prescriptionform->type }}</td>
                <td>{{ $prescriptionform->medicine_name }}</td>
                <td>{{ $prescriptionform->per_day }}</td>
                <td>{{ $prescriptionform->duration }}</td>
                <td>{{ $prescriptionform->quantity }}</td>

                <td>



                    <a href="{{ route('prescriptionform.edit', $prescriptionform->id) }}" type="button"
                        class="btn btn-sm btn-outline-success">
                        Edit
                        <span data-feather="edit-3"></span>
                    </a>

                    <form action="{{ route('prescriptionform.destroy', $prescriptionform->id) }}" method="POST" style="display: inline;">
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
                    <h2 class="fw-bold mb-0">Add prescriptionform</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('prescriptionform.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="type">Prescription Id</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Enter prescription id"
                                value="{{ old('type') }}">
                            @error('type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="medicine_name">Medicine Names</label>

                                <textarea class="form-control" id="medicine_name" name="medicine_name" placeholder="Enter medicine name"
                                value="{{ old('medicine_name') }}"></textarea>
                            @error('medicine_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="mb-3">
                            <label for="duration">Duration(in days)</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="eg 5 days"
                                value="{{ old('duration') }}">
                            @error('duration')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="per_day">Per Day</label>
                            <input type="text" class="form-control" id="per_day" name="per_day" placeholder="eg: 3 times"
                                value="{{ old('per_day') }}">
                            @error('per_day')
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
    {{ $prescriptionforms->onEachSide(1)->links() }}
@endsection
