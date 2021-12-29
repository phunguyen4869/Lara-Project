@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    @include('admin.alert')
    <form action="add" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slider">Tên Slider</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Nhập tên slider">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="slider">Đường dẫn</label>
                        <input type="text" name="url" value="{{ old('url') }}" class="form-control"
                            placeholder="Nhập đường dẫn">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="slider">Ảnh Slider</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>


            <div class="form-group">
                <label for="slider">Sắp xếp</label>
                <input type="number" required name="sort_by" value="{{ old('sort_by') }}" class="form-control">
            </div>


            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Thêm Slider</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
