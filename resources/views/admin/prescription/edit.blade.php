@extends("layouts.admin")
@section('content')
    <div class="modal modal-signin position-static d-block bg-light py-5" tabindex="-1" role="dialog" id="editProduct">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Edit prescription</h2>
                </div>

                <div class="modal-body">
                    <form action=" {{ url('admin/prescription/' . $prescription->id) }} " enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="prescription Id">Prescription Id</label>
                            <input type="text" class="form-control" id="prescription_id" name="prescription_id" readonly
                                value={{ $prescription->prescription_id }}>
                            @error('prescription_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="patient">Patient</label>
                            <select class="form-select" id="patient" name="patients[]">
                                <option value="">Select patient</option>
                                @foreach ($patients as $patient)
                                    <option {{ $prescription->patients->contains($patient->id) ? 'selected' : '' }}
                                        value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>

                        </div>


                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                                value={{ $prescription->title }}>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $prescription->description }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{--  --}}


                        <div class="mb-3">
                            <label for="diagnosis">Diagnosis</label>
                            <textarea class="form-control" placeholder="diagnosis for patient" id="diagnosis" name="diagnosis" rows="3">{{$prescription->diagnosis}}</textarea>
                            @error('diagnosis')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="chronic-diagnosis">Chronic Diagnosis</label>
                            <textarea class="form-control" placeholder="please enter the list of chronic diseases" id="chronic_diagnosis" name="chronic_diagnosis" rows="3">{{$prescription->chronic_diagnosis}}</textarea>
                            @error('chronic_diagnosis')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="acute-diagnosis">Acute Diagnosis</label>
                            <textarea class="form-control" placeholder="please enter acute diagnosis" id="acute_diagnosis" name="acute_diagnosis" rows="3">{{$prescription->acute_diagnosis}}</textarea>
                            @error('acute_diagnosis')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="social_history">Social History</label>
                            <textarea class="form-control" placeholder="please enter any social history " id="social_history" name="social_history" rows="3">{{$prescription->social_history}}</textarea>
                            @error('social_history')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="post_medical_history">Post Medical History</label>
                            <textarea class="form-control" placeholder="please enter a short post medical history about the patient" id="post_medical_history" name="post_medical_history" rows="3">{{$prescription->post_medical_history}}</textarea>
                            @error('post_medical_history')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="allergies">Allergies</label>
                            <textarea class="form-control" placeholder="please enter allergies that the patient have" id="allergies" name="allergies" rows="3">{{$prescription->allergies}}</textarea>
                            @error('allergies')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="drug_allergies">Drug Allergies</label>
                            <textarea class="form-control" placeholder="please enter a  drug allergies that the patient have" id="drug_allergies" name="drug_allergies" rows="3">{{$prescription->drug_allergies}}</textarea>
                            @error('drug_allergies')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="food_allergies">Food Allergies</label>
                            <textarea class="form-control" placeholder="please enter any food allergies " id="food_allergies" name="food_allergies" rows="3">{{$prescription->food_allergies}}</textarea>
                            @error('food_allergies')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="medication">Medication</label>
                            <textarea class="form-control" placeholder="please enter the medication for the patient" id="medication" name="medication" rows="3">{{$prescription->medication}}</textarea>
                            @error('medication')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prescription">Prescription</label>
                            <textarea class="form-control" placeholder="please enter the prescription for the patient" id="prescription" name="prescription" rows="3">{{$prescription->prescription}}</textarea>
                            @error('prescription')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror



                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    {{ $prescription->status == 'on' ? 'checked' : '' }} name="status" role="switch"
                                    id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="/admin/prescription" type="button" class="btn btn-secondary">Go Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
