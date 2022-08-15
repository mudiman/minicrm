@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Edit Company') }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Company') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                            <form name="edit-employee-form" id="employee-edit" method="POST" enctype="multipart/form-data"
                                  action="{{ route('employees.update', $employee->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="first_name">First name</label>
                                    <x-adminlte-input id="first_name" name="first_name" type="text" placeholder="first name"
                                                      value="{{ $employee->first_name }}" class="@error('first_name') is-invalid @enderror form-control"></x-adminlte-input>
                                    @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <x-adminlte-input id="last_name" name="last_name" type="text" placeholder="last_name name"
                                                      value="{{ $employee->last_name }}" class="@error('last_name') is-invalid @enderror form-control"/>
                                    @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <x-adminlte-input id="email" name="email" type="email" placeholder="mail@example.com"
                                                      value="{{ $employee->email }}" class="@error('email') is-invalid @enderror form-control"/>
                                    @error('email')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <x-adminlte-input id="phone" name="phone" type="text" placeholder="phone name"
                                                      value="{{ $employee->phone }}" class="@error('phone') is-invalid @enderror form-control"/>
                                    @error('name')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="company_id">Company</label>
                                    <select id="company_id" name="company_id" class="form-select" style="color: #41A7A5" aria-label="Default select example">
                                        @foreach ($companies as $company)
                                            <option value="{{$company->id}}" {{ $employee->company_id == $company->id ? 'selected' : '' }} >{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('website')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button class="btn btn-success btn-submit">Submit</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

