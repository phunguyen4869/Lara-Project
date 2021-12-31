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
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên danh mục"
                    value="{{ $category->name }}">
            </div>

            <div class="form-group">
                <label for="parent_id">Danh mục</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="0" {{ $category->parent_id == 0 ? 'selected' : '' }}>Danh mục cha</option>
                    @foreach ($categories as $categoryParent)
                        <option value="{{ $categoryParent->id }}"
                            {{ $category->parent_id == $categoryParent->id ? 'selected' : '' }}>
                            {{ $categoryParent->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description" class="form-control">{{ $category->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="content">Mô tả chi tiết</label>
                <textarea name="content" id="content" class="form-control">{{ $category->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="category">Ảnh Danh Mục</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $category->thumb }}" target="_blank">
                        <img src="{{ $category->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $category->thumb }}" id="thumb">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $category->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="not_active" name="active"
                        {{ $category->active == 0 ? 'checked=""' : '' }}>
                    <label for="not_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
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
