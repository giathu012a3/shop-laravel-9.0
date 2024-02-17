<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    @include('admin.css')
    <style>
        .font_size {
            text-align: center;
            font-size: 44px;
            padding-top: 20px;
        }

        .center {
            margin: auto;
            /* width: 75%; */
            text-align: center;
            margin-top: 40px
        }

        .imgage_size {
            width: 200px !important;
            height: 150px !important;
            border-radius: 0 !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if (session()->has('message'))
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert" aria-hidden="true">
                        x
                    </button>
                    {{ session()->get('message') }}
                </div>
            @endif
            <h1 class="font_size">Tất cả sản phẩm</h1>
            <div style="margin-left: 450px;padding-bottom: 30px">
                <form action="{{ url('search_product_admin') }}" method="GET">
                    @csrf
                    <input type="text" style="width: 450px; color: black" name="search_products"
                        placeholder="Tìm kiếm cái gì đó ở đây">
                    <input type="submit" value="Search" id="" class="btn btn-primary">
                </form>
            </div>
                <table class="center table text-white">
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        {{-- <th>Mô tả</th> --}}
                        <th>Số lượng</th>
                        <th>Danh Mục</th>
                        <th>Giá</th>
                        <th>Giá Giảm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->title }}</td>
                            {{-- <td style="max-width: 150px;">{{ $product->description }}</td> --}}
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category }}</td>
                            <td>{{ $product->price }}</td>
                            @if ($product->discount_price!=null)
                                
                            <td>{{ $product->discount_price }}</td>
                            @else
                            <td>Sản phẩm chưa có giảm giá</td>

                            @endif
                            <td>
                                <img class="imgage_size" src="product/{{ $product->image }}" alt="">
                            </td>
                            <td>
                                <a onclick="return confirm('Bạn chắc chắc muốn xóa không')" class="btn btn-danger" href="{{ url('/delete_product', $product->id) }}">Xóa</a>
                            </td>
                            <td><a class="btn btn-success" href="{{ url('/update_product', $product->id) }}">Cập Nhập</a></td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Không tìm thấy dữ liệu</td>
                        </tr>

                    @endforelse
                </table>
            </div>
        </div>

        <!-- container-scroller -->
        <!-- plugins:js -->

        @include('admin.script')
</body>

</html>
