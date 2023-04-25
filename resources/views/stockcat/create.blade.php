@extends('layouts.master')

@section('title')
    {{ __('sentence.New User') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('New Item') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post"
                        action="{{ $data ? route('stock-category.update', $data) : route('stock-category.store') }}">
                        @csrf
                        @if($data)
                            @method('PUT')
                        @endif
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label">{{ __('Stock Category') }}<font
                                    color="red">*</font></label>
                                    <div class="col-sm-9">
                            <input type="text" name="name" value="{{ ($data) ? $data->name : '' }}" required class="form-control">
                                    </div>
                        </div>

                        <div class="form-group row">
                            <button class="btn mx-auto btn-primary w-50">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('header')
@endsection

@section('footer')
@endsection
