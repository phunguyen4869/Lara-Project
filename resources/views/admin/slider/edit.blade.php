@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')

    @include('admin.alert')

    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="#" method="POST">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slider">Tên Slider</label>
                        <input type="text" name="name" value="{{ $slider->name }}" class="form-control"
                            placeholder="Nhập tên slider">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slider">Đường dẫn</label>
                        <input type="text" name="url" value="{{ $slider->url }}" class="form-control"
                            placeholder="Nhập đường dẫn">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="slider">Ảnh Slider</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $slider->thumb }}" target="_blank">
                        <img src="{{ $slider->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $slider->thumb }}" id="thumb">
            </div>

            <div class="form-group">
                <label for="slider">Sắp xếp</label>
                <input type="number" name="sort_by" value="{{ $slider->sort_by }}" class="form-control">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $slider->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="not_active" name="active"
                        {{ $slider->active == 0 ? 'checked=""' : '' }}>
                    <label for="not_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật slider</button>
        </div>
    </form>

@endsection

@section('footer')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('content');
    </script>
@endsection
