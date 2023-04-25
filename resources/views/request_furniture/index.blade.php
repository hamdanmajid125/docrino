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
                    @role('Supervisor')
                        <a href="{{ route('request-furniture.create') }}" class="btn btn-primary btn-sm float-right "><i
                                class="fa fa-plus"></i> {{ __('New Stocks') }}</a>
                    @endrole
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="text-center">{{ __('Request From') }}</th>
                            <th class="text-center">{{ __('Item') }}</th>
                            <th class="text-center">{{ __('Item Category') }}</th>
                            <th class="text-center">{{ __('Quantity') }}</th>
                            <th class="text-center">{{ __('Status') }}</th>
                            <th class="text-center">{{ __('sentence.Register Date') }}</th>
                            @role('Supervisor')
                                <th class="text-center">{{ __('Actions') }}</th>
                            @endrole

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->stock->name }}</td>
                                <td>{{ $request->stock->category->name }}</td>

                                <td class="text-center">{{ $request->qty }} units</td>
                                <td class="text-center">

                                    <span
                                        class="badge badge-{{ $request->approved ? 'success' : 'danger' }}">{{ $request->approved ? 'Approved' : 'Pending' }}</span>

                                </td>
                                <td><label
                                        class="badge badge-primary-soft">{{ $request->created_at->format('d M Y H:i') }}</label>
                                </td>
                                @role('Supervisor')
                                    <td class="text-center" id="changestauts">
                                        <input type="checkbox" data-id={{ $request->id }} data-toggle="toggle"
                                            data-onstyle="secondary" data-on="Approve" data-off="UnApprove"
                                            {{ $request->approved ? 'checked' : '' }}>
                                    </td>
                                @endrole


                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <span class="float-right mt-3">{{ $data->links() }}</span>

            </div>
        </div>
    </div>
@endsection
@section('footer')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script>
        $('#changestauts input[type="checkbox"]').change(function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('changestautsrequest') }}",
                type: "post",
                data: {
                    val: $(this).prop('checked'),
                    id: $(this).data('id')
                }
            });
        })
    </script>
@endsection
