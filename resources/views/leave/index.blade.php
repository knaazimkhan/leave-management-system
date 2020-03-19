@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Apply for Leave
                </div>

                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form action="{{ route('leave.store') }}" method="POST">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">Leave Type</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="leave_type">
                                <option value="AL">Annual</option>
                                <option value="CL">Casual</option>
                                <option value="SL">Sick</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">Start date</label>
                            <input type="date" class="form-control" id="sdate" name="start_date">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date">End date</label>
                            <input type="date" class="form-control" id="edate" name="end_date">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlTextarea1">Note</label>
                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection