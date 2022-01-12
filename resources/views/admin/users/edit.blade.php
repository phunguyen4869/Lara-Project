@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    @include('admin.alert')
    <form action="#" method="POST">
        <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>


        <div class="input-group mb-3">
            <select name="role" id="role" name="role" class="form-control">
                @foreach ($roles as $role)
                    @foreach ($user->roles as $userrole)
                        @if ($userrole->name == $role)
                            <option value="{{ $role }}" selected>{{ $role }}</option>
                        @else
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endif
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <input type="password" name="re_password" class="form-control" placeholder="Retype Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Sửa User</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
