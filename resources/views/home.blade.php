@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                    <a href="{{ route('leave.index') }}" class="btn btn-primary float-right">Apply Leave</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <h3> Leave Balance</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Leave Type</th>
                                <th scope="col">Leave Used</th>
                                <th scope="col">Leave Left</th>
                                <th scope="col">Total Leave</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leave_balance as $leave)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $leave->leave_type }}</td>
                                <td>{{ $leave->used }}</td>
                                <td>{{ $leave->left }}</td>
                                <td>{{ $leave->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <h3> Leave Request</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Leave Type</th>
                                <th scope="col">Applied Leave</th>
                                <th scope="col">Leave Status</th>
                                <th scope="col">Requested At</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leave_apply as $leave)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $leave->leave_type }}</td>
                                <td>{{ $leave->count }}</td>
                                <td>{{ $leave->status }}</td>
                                <td>{{ $leave->created_at->format('Y-m-d') }}</td>
                                <td>{{ $leave->description }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection