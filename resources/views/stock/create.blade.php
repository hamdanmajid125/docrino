@extends('layouts.master')

@section('title')
    {{ __('sentence.New User') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Create Category') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ $data ? route('stock.update', $data) : route('stock.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label">{{ __('Stock Category') }}<font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <select name="category" class="form-control" id="">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ ($data)?($item->id == $data->stock_category_id ? 'selected' : ''):'' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label">{{ __('Name') }}<font color="red">*
                                </font></label>
                            <div class="col-sm-9">
                                <input type="text" value="{{ $data ? $data->name : '' }}" class="form-control"
                                    id="name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label">{{ __('Quantity') }}<font color="red">*
                                </font></label>
                            <div class="col-sm-9">
                                <input type="number" value="{{ $data ? $data->qty : '' }}" class="form-control"
                                    id="name" name="name" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label">{{ __('Stock Category') }}<font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <select name="category" class="form-control" id="">
                                    @foreach ($users as $item)
                                        <option value="{{ $item->id }}"
                                            {{ ($data)?($item->id == $data->assigned_to ? 'selected' : ''):'' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <button class="btn btn-primary mx-auto w-50 " type="submit">Save</button>
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
