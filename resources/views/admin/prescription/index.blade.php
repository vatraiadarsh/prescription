
@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Prescriptions given to users</h1>
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
            Give Prescription
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



    <div class="table-responsive-xl">
    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Prescription Id</th>
            <th>Qr code</th>
            <th>Prescription title</th>
            <th>patient</th>
            <th>Description</th>
            <th>Diagnosis</th>
            <th>Chronic Diagnosis</th>
            <th>Acute Diagnosis</th>
            <th>Social History</th>
            <th>Post Medical History</th>
            <th>Allergies</th>
            <th>Drug Allergies</th>
            <th>Food Allergies</th>
            <th>Medication</th>
            <th>Prescription</th>
            <th>Status</th>
            <th>Action</th>

        </tr>

        @foreach ($prescriptions as $prescription)
            <tr>
                <td>{{ $prescription->id }}</td>
                <td>{{ $prescription->prescription_id }}</td>
                {{-- qr code to generate prescription id --}}
                <td>{!! QrCode::size(100)->generate($prescription->prescription_id) !!}</td>
                <td>{{ $prescription->title }}</td>
                <td>
                    @foreach ($prescription->patients as $patient)
                        <span class="badge rounded-pill bg-secondary" >{{ $patient->name }}</span>
                    @endforeach
                </td>
                <td>{{ $prescription->description }}</td>
                <td>{{ $prescription->diagnosis }}</td>
                <td>{{ $prescription->chronic_diagnosis }}</td>
                <td>{{ $prescription->acute_diagnosis }}</td>
                <td>{{ $prescription->social_history }}</td>
                <td>{{ $prescription->post_medical_history }}</td>
                <td>{{ $prescription->allergies }}</td>
                <td>{{ $prescription->drug_allergies }}</td>
                <td>{{ $prescription->food_allergies }}</td>
                <td>{{ $prescription->medication }}</td>
                <td>{{ $prescription->prescription }}</td>
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


{{ $prescriptions->links() }}

    </table>
</div>
    <div class="modal fade py-5" id="addPatient" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h2 class="fw-bold mb-0">Prescription</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="{{ route('prescription.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf


                    <div class="mb-3">
                        <label for="patient">Patient</label>
                        <select class="form-select" id="patient" name="patients[]">
                            <option value="">Select Patient</option>
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="eg. Prescription for ..."
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description">Description</label>
                        <textarea class="form-control" placeholder="please enter a short description about the patient condition/others" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="diagnosis">Diagnosis</label>
                        <textarea class="form-control" placeholder="diagnosis for patient" id="diagnosis" name="diagnosis" rows="3">{{ old('diagnosis') }}</textarea>
                        @error('diagnosis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="chronic-diagnosis">Chronic Diagnosis</label>
                        <textarea class="form-control" placeholder="please enter the list of chronic diseases" id="chronic_diagnosis" name="chronic_diagnosis" rows="3">{{ old('chronic_diagnosis') }}</textarea>
                        @error('chronic_diagnosis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="acute-diagnosis">Acute Diagnosis</label>
                        <textarea class="form-control" placeholder="please enter acute diagnosis" id="acute_diagnosis" name="acute_diagnosis" rows="3">{{ old('acute_diagnosis') }}</textarea>
                        @error('acute_diagnosis')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="social_history">Social History</label>
                        <textarea class="form-control" placeholder="please enter any social history " id="social_history" name="social_history" rows="3">{{ old('social_history') }}</textarea>
                        @error('social_history')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="post_medical_history">Post Medical History</label>
                        <textarea class="form-control" placeholder="please enter a short post medical history about the patient" id="post_medical_history" name="post_medical_history" rows="3">{{ old('post_medical_history') }}</textarea>
                        @error('post_medical_history')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="allergies">Allergies</label>
                        <textarea class="form-control" placeholder="please enter allergies that the patient have" id="allergies" name="allergies" rows="3">{{ old('allergies') }}</textarea>
                        @error('allergies')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="drug_allergies">Drug Allergies</label>
                        <textarea class="form-control" placeholder="please enter a  drug allergies that the patient have" id="drug_allergies" name="drug_allergies" rows="3">{{ old('drug_allergies') }}</textarea>
                        @error('drug_allergies')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="food_allergies">Food Allergies</label>
                        <textarea class="form-control" placeholder="please enter any food allergies " id="food_allergies" name="food_allergies" rows="3">{{ old('food_allergies') }}</textarea>
                        @error('food_allergies')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="medication">Medication</label>
                        <textarea class="form-control" placeholder="please enter the medication for the patient" id="medication" name="medication" rows="3">{{ old('medication') }}</textarea>
                        @error('medication')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="prescription">Prescription</label>
                        <textarea class="form-control" placeholder="please enter the prescription for the patient" id="prescription" name="prescription" rows="3">{{ old('prescription') }}</textarea>
                        @error('prescription')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror






                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>


                </form>


            </div>

        </div>
    </div>

</div>


@endsection

