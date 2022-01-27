@extends('admin.main')

@section('content')
    @include('admin.alert')
    <form action="#" method="POST">
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $role->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Permission</th>
                    <th>Access</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allPermissions as $allPermission)
                    <tr>
                        <td>{{ $allPermission->name }}</td>
                        <td>
                            <input type="checkbox" name="permissions[]" value="{{ $allPermission->name }}"
                                @if ($role->hasPermissionTo($allPermission->name))
                                    checked
                                @endif
                            >
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <input type="hidden" name="roleId" value="{{ $role->id }}">

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Sửa role</button>
        </div>
        @csrf
    </form>
@endsection
