@extends("layouts.admin")
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">pharmacist</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <form action="{{ route('pharmacist.index') }}" method="get">
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
                Add Pharmacist
                <span data-feather="plus-square"></span>
            </a>
        </div>

    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Hey {{ Auth::user()->name }} !</strong> Failed to add pharmacist. You should check in on some of those
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
            <th>Prescription Id</th>
            <th>Medicine Name</th>
            <th>Per Day</th>
            <th>Duration</th>
            <th>Total Quantity</th>
            <th>Remarks</th>
            <th>Action</th>
        </tr>
        @foreach ($pharmacists as $pharmacist)
            <tr>
                {{-- prescription id --}}
                <td>{{ $pharmacist->id }}</td>
                <td>{{ $pharmacist->total_quantity }}</td>
                <td>{{ $pharmacist->medicine_name }}</td>
                <td>{{ $pharmacist->per_day }}</td>
                <td>{{ $pharmacist->duration }}</td>
                <td>{{ $pharmacist->per_day * $pharmacist->duration }}</td>
                <td>{{ $pharmacist->remarks }}</td>

                <td>



                    <a href="{{ route('pharmacist.edit', $pharmacist->id) }}" type="button"
                        class="btn btn-sm btn-outline-success">
                        Edit
                        <span data-feather="edit-3"></span>
                    </a>

                    <form action="{{ route('pharmacist.destroy', $pharmacist->id) }}" method="POST" style="display: inline;">
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
                    <h2 class="fw-bold mb-0">Add pharmacist</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('pharmacist.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="total_quantity">Prescription Id</label>
                            <input type="text" class="form-control" id="total_quantity" name="total_quantity" placeholder="Enter prescription id"
                                value="{{ old('total_quantity') }}">
                            @error('total_quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="medicine_name">Medicine Name</label>
                            {{-- <input type="text" class="form-control" id="medicine_name" name="medicine_name" placeholder="Enter medicine name"
                                value="{{ old('medicine_name') }}"> --}}

                            <textarea class="form-control" id="medicine_name" name="medicine_name" placeholder="Enter medicine name"
                                value="{{ old('medicine_name') }}"></textarea>

                            @error('medicine_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="per_day">Per Day</label>
                            <input type="text" class="form-control" id="per_day" name="per_day" placeholder="Enter per day"
                                value="{{ old('per_day') }}">
                            @error('per_day')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Enter duration"
                                value="{{ old('duration') }}">
                            @error('duration')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for="remarks">Remarks</label>

                            <textarea class="form-control" id="remarks" name="remarks" placeholder="Enter remarks">{{ old('remarks') }}</textarea>
                            @error('remarks')
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
    {{ $pharmacists->onEachSide(1)->links() }}
@endsection
