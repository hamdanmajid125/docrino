@extends('layouts.master')

@section('title')
    {{ __('sentence.All Stocks') }}
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-8">
                    <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('All Stocks') }}</h6>
                </div>
                <div class="col-4">
                    <a href="{{ route('stock.create') }}" class="btn btn-primary btn-sm float-right "><i
                            class="fa fa-plus"></i> {{ __('New Stocks') }}</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="text-center">{{ __('sentence.Name') }}</th>
                            <th class="text-center">{{ __('sentence.Register Date') }}</th>
                            <th class="text-center">{{ __('sentence.Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $stock)
                            <tr>
                                <td>{{ $stock->id }}</td>
                                <td>{{ $stock->name }}</td>
                                <td class="text-center"><label
                                        class="badge badge-primary-soft">{{ $stock->created_at->format('d M Y H:i') }}</label>
                                </td>

                                <td class="text-center">
                                    @can('edit stock')
                                        <a href="{{ route('stock.edit', ['stock' => $stock]) }}"
                                            class="btn btn-outline-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                                    @endcan

                                    <a href="#" class="btn btn-outline-danger btn-circle btn-sm" data-toggle="modal"
                                        data-target="#DeleteModal" data-link="#"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <span class="float-right mt-3">{{ $data->links() }}</span>

            </div>
        </div>
    </div>
@endsection
