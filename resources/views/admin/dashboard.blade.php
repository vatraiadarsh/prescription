@extends('layouts.admin')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>
    <div class="alert alert-dark" role="alert">
        <h4> Total Patients: {{ $total_patients }} </h4>
    </div>
    <div class="alert alert-success" role="alert">
        <h4> Total Active patients: {{ $total_active_patients }} </h4>
    </div>
    <div class="alert alert-danger" role="alert">
        <h4> Total Inactive patients: {{ $total_inactive_patients }} </h4>
    </div>
    <div class="alert alert-dark" role="alert">

        <h4> Total Prescriptions: {{ $total_prescriptions }} </h4>
    </div>
    <div class="alert alert-success" role="alert">
        <h4> Total Active Prescriptions: {{ $total_active_prescriptions }} </h4>
    </div>
    <div class="alert alert-danger" role="alert">
        <h4> Total Inactive Prescriptions: {{ $total_inactive_prescriptions }} </h4>
    </div>
    <div class="alert alert-dark" role="alert">
        <h4> Total Users: {{ $total_users }} </h4>
    </div>
@endsection
