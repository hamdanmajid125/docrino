@extends('layouts.master')

@section('title')
    {{ __('sentence.New User') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Make Furniture Request') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('request-furniture.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label">{{ __('Item') }}<font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <select name="stock_id" class="form-control" id="">
                                    @foreach ($stock as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Name" class="col-sm-3 col-form-label">{{ __('Quantity') }}<font color="red">*
                                </font></label>
                            <div class="col-sm-9">
                                <input type="text" value="1" class="form-control"
                                    id="name" name="qty" required>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <button class="btn btn-primary mx-auto w-50 " type="submit">Request</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
