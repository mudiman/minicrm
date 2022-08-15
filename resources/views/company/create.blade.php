@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ __('Create Company') }}</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Company') }}</div>

                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form name="add-company-form" id="company-add" method="POST" enctype="multipart/form-data"
                              action="{{ route('companies.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <x-adminlte-input id="name" name="name" type="text" placeholder="name"
                                                  value="{{old('name')}}" class="@error('name') is-invalid @enderror form-control"/>
                                @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="email">Email</label>
                                <x-adminlte-input id="email" name="email" type="email" placeholder="mail@example.com"
                                                  value="{{old('email')}}" class="@error('email') is-invalid @enderror form-control"/>
                                @error('email')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="logo">Logo</label>

                                <input type="file" name="logo" class="form-control" value="{{old('logo')}}">
                                @error('logo')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="text" id="website" name="website"
                                       value="{{old('website')}}" class="@error('website') is-invalid @enderror form-control">
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
