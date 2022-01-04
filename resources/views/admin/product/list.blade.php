@extends('admin.main')

@section('content')
    @include('admin.alert')
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Giá</th>
                <th>Giá sale</th>
                <th>Ảnh</th>
                <th>Active</th>
                <th width="10%">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- {!! App\Helpers\Helper::products($products) !!} --}}
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @if ($product->category->name)
                            {{ $product->category->name }}
                        @else
                            {{ 'Không có danh mục' }}
                        @endif
                    </td>
                    <td>{{ number_format($product->price) }}</td>
                    <td>
                        @if ($product->price_sale)
                            {{ number_format($product->price_sale) }}
                        @else
                            {{ 'Không có giá sale' }}
                        @endif
                    </td>
                    <td>
                        <a href="{{ $product->thumb }}" target="_blank">
                            <img src="{{ $product->thumb }}" alt="image" width="50px">
                        </a>
                    </td>
                    <td>{!! App\Helpers\Helper::active($product->active, 'products', $product->id) !!}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="edit/{{ $product->id }}">
                            <i class="far fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                            onclick="removeRow({{ $product->id }}, '/admin/products/destroy')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Hiển thị phần phân trang --}}
    <div class="card-footer clearfix">
        {!! $products->links() !!}
    </div>
@endsection
