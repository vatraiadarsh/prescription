@extends("layouts.admin")
@section('content')
    <div class="modal modal-signin position-static d-block bg-light py-5" tabindex="-1" role="dialog" id="editCategory">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Edit pharmacist</h2>
                </div>

                <div class="modal-body">
                    <form action=" {{ url('admin/pharmacist/' . $pharmacist->id) }} " enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="total_quantity">Prescription Id</label>
                            <input type="text" class="form-control" id="total_quantity" name="total_quantity" placeholder="Enter prescription Id"
                                value="{{ $pharmacist->total_quantity }}">
                            @error('total_quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="medicine_name">Medicine Name</label>
                            <input type="text" class="form-control" id="medicine_name" name="medicine_name" placeholder="Enter medicine name"
                                value="{{ $pharmacist->medicine_name }}">
                            @error('medicine_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="per_day">Per Day</label>
                            <input type="text" class="form-control" id="per_day" name="per_day" placeholder="Enter per day"
                                value="{{ $pharmacist->per_day }}">
                            @error('per_day')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Enter duration"
                                value="{{ $pharmacist->duration }}">
                            @error('duration')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>



                        <div class="mb-3">
                            <label for="remarks">Remarks</label>
                           <textarea class="form-control" id="remarks" name="remarks" rows="3">{{ $pharmacist->remarks }}</textarea>
                            @error('remarks')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>






                        <div class="modal-footer">
                            <a href="/admin/pharmacist" type="button" class="btn btn-secondary">Go Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
