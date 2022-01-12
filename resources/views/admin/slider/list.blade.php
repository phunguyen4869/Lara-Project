@extends('admin.main')

@section('content')
    @include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>URL</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Thời gian cập nhật</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
                <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->name }}</td>
                    <td>{{ $slider->url }}</td>
                    <td>
                        <a href="{{ $slider->thumb }}" target="_blank">
                            <img src="{{ $slider->thumb }}" alt="image" width="50px">
                        </a>
                    </td>
                    <td>{!! App\Helpers\Helper::active($slider->active, 'sliders', $slider->id) !!}</td>
                    <td>{{ $slider->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit/{{ $slider->id }}">
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                            onclick="removeRow({{ $slider->id }}, '/admin/sliders/destroy')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Hiển thị phần phân trang --}}
    {!! $sliders->links() !!}
@endsection
