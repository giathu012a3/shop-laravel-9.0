<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        .page-header {
            padding: 30px;
            background: #191c24;
            margin-bottom: 25px;
            border-radius: 12px;
            text-align: center;
        }

        .search-box {
            background: #191c24;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            max-width: 800px;
            margin: 0 auto 30px auto;
        }

        .product-table-card {
            background: #191c24;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .table thead th {
            background: #0090e7;
            color: white;
            white-space: nowrap;
            padding: 15px;
            border: none;
        }

        .table tbody td {
            color: #ffffff;
            padding: 12px 15px;
            vertical-align: middle;
            border-top: 1px solid #2c2e33;
        }

        .product-image {
            width: 100px !important;
            height: 70px !important;
            object-fit: cover !important;
            border-radius: 8px !important;
            transition: transform 0.3s;
            border: 2px solid #2c2e33;
        }

        .product-image:hover {
            transform: scale(1.5);
            z-index: 10;
        }

        .input-style {
            background: #2a3038 !important;
            border: 1px solid #2c2e33 !important;
            color: white !important;
            height: 45px;
        }

        .badge-price {
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        @include('admin.sidebar')
        @include('admin.header')
        
        <div class="main-panel">
            <div class="content-wrapper">
                
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                        <strong>Xác nhận:</strong> {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="page-header">
                    <h2 class="text-white"><i class="mdi mdi-format-list-bulleted"></i> DANH SÁCH TẤT CẢ SẢN PHẨM</h2>
                </div>

                <div class="search-box">
                    <form action="{{ url('search_product_admin') }}" method="GET" class="d-flex align-items-center">
                        @csrf
                        <input type="text" class="form-control input-style mr-2" name="search_products"
                            placeholder="🔍 Tìm theo tên sản phẩm hoặc danh mục...">
                        <button type="submit" class="btn btn-info btn-lg px-4"><i class="mdi mdi-magnify"></i> Tìm kiếm</button>
                    </form>
                </div>

                <div class="product-table-card">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr class="text-center">
                                <th>Tên Sản Phẩm</th>
                                <th>Số lượng</th>
                                <th>Danh Mục</th>
                                <th>Giá gốc</th>
                                <th>Khuyến mãi</th>
                                <th>Hình ảnh</th>
                                <th colspan="2">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr class="text-center">
                                    <td class="text-left font-weight-bold">{{ $product->title }}</td>
                                    <td><span class="badge badge-outline-warning">{{ $product->quantity }}</span></td>
                                    <td><span class="badge badge-outline-success">{{ $product->category }}</span></td>
                                    <td class="text-primary font-weight-bold">{{ number_format($product->price) }} đ</td>
                                    <td>
                                        @if ($product->discount_price != null && $product->discount_price > 0)
                                            <span class="text-danger font-weight-bold">{{ number_format($product->discount_price) }} đ</span>
                                        @else
                                            <span class="text-muted small">Không giảm giá</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img class="product-image shadow-sm" src="product/{{ $product->image }}" alt="Sản phẩm">
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Bạn chắc chắn muốn xóa không?')" 
                                           class="btn btn-outline-danger btn-sm" 
                                           href="{{ url('/delete_product', $product->id) }}">
                                            <i class="mdi mdi-delete"></i> Xóa
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-success btn-sm" 
                                           href="{{ url('/update_product', $product->id) }}">
                                            <i class="mdi mdi-pencil"></i> Sửa
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-5 text-center text-muted italic">
                                        <i class="mdi mdi-information-outline"></i> Không tìm thấy sản phẩm nào phù hợp
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('admin.script')
</body>

</html>
