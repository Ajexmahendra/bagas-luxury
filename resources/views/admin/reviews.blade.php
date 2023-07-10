@extends('admin.layout.app')

@section('heading', 'Review List')

@section('right_top_button')
    <a href="{{ route('admin_home') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
@endsection

@section('main_content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ruangan</th>
                                        <th>Nama Customer</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($review as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @foreach ($row->order->orderDetail as $item)
                                                    {{ $item->room->name }}
                                                @endforeach
                                            </td>
                                            <td>{{ $row->customer->name }}</td>
                                            <td>{{ $row->rating }}</td>
                                            <td>{{ $row->review }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
