@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Content</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            {!! App\Helpers\Helper::menus($menus) !!}
        </tbody>
    </table>
@endsection
