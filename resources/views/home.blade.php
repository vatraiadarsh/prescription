@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
           <p>Name: {{ $user->name }}</p>
              <p>Email: {{ $user->email }}</p>
              <br>
              <br>
              {{-- {{$prescriptions->count()}} --}}
                <h1>Prescriptions received</h1>

                @if($prescriptions->count() > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Prescription Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Medication</th>
                            <th>prescription</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescriptions as $prescription)
                        <tr>
                            <td>{{ $prescription->prescription_id }}</td>
                            <td>{{ $prescription->title }}</td>
                            <td>{{ $prescription->description }}</td>
                            <td>{{ $prescription->medication }}</td>
                            <td>{{ $prescription->prescription }}</td>
                            <td>
                                @if ($prescription->status === 'on')
                                    <span class="badge rounded-pill bg-success">active</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{  date('j \\ F Y', strtotime($prescription->created_at)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p>No prescriptions found</p>
                @endif


        </div>

</div>
@endsection
