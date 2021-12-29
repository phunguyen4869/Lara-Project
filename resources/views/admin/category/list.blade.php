@extends('admin.main')

@section('content')
@include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th style="width:5%;">ID</th>
                <th style="width:10%;">Name</th>
                <th style="width:10%;">Parent ID</th>
                <th style="width:20%">Description</th>
                <th style="width:30%;">Content</th>
                <th style="width:5%;">Active</th>
                <th style="width:10%;">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- display content --}}
            {{-- {{ App\Helpers\Helper::categories($categories) }} --}}

            {{-- display html content --}}
            {!! App\Helpers\Helper::categories($categories) !!}
        </tbody>
    </table>
@endsection
