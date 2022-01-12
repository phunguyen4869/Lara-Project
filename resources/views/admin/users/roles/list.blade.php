@extends('admin.main')

@section('content')
    @include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Permission</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    {{-- <td>
                        @foreach ($role->permissions as $permission)
                            {{ $permission->name }},
                        @endforeach
                    </td> --}}
                    <td>{{$role->permissions->pluck('name')}}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit/{{ $role->id }}">
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                            onclick="removeRow({{ $role->id }}, '/admin/user/roles/destroy')">
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
