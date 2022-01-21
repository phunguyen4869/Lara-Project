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
                <label for="name">Tên sản phẩm</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sản phẩm"
                    value="{{ $product->name }}">
            </div>

            <div class="form-group">
                <label for="category_id">Danh mục</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($categories as $category)
                        {{-- @if ($category->parent_id != 0)
                            <option value="{{ $category->id }}"
                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endif --}}
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Giá Gốc</label>
                        <input type="number" name="price" value="{{ $product->price }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Giá Giảm</label>
                        <input type="number" name="price_sale" value="{{ $product->price_sale }}" class="form-control">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Mô tả</label>
                <textarea name="description" id="description"
                    class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="content">Mô tả chi tiết</label>
                <textarea name="content" id="content" class="form-control">{{ $product->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="category">Ảnh Sản Phẩm</label>
                <input type="file" class="form-control" id="upload_multiple" multiple>
                <div id="image_show_multi">
                    @foreach (explode(',', $product->thumb) as $thumb)
                        <a href="{{ $thumb }}" target="_blank">
                            <img src="{{ $thumb }}" alt="image" width="50px">
                        </a>
                    @endforeach
                </div>
                <input type="hidden" name="thumb" value="{{ $product->thumb }}" id="thumb">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $product->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="not_active" name="active"
                        {{ $product->active == 0 ? 'checked=""' : '' }}>
                    <label for="not_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
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
