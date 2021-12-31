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
    <form action="store" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục">
            </div>

            <div class="form-group">
                <label for="parent_id">Danh mục</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="0">Danh mục cha</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="content">Mô tả chi tiết</label>
                <textarea name="content" id="content" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="category">Ảnh Danh Mục</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">

                </div>
                <input type="hidden" name="thumb" id="thumb">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active">
                    <label for="active" class="custom-control-label">Có</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="not_active" name="active" checked="">
                    <label for="not_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        </div>
    </form>

@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
