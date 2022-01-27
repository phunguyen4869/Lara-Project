@extends('admin.main')

@section('content')
    @include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Payment Method</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->payment_method }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit/{{ $user->id }}">
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                            onclick="removeRow({{ $user->id }}, '/admin/user/payment/destroy')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Hiển thị phần phân trang
    <div class="card-footer clearfix">
        {!! $users->links() !!}
    </div> --}}
@endsection
