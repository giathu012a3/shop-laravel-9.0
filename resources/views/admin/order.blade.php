<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    @include('admin.css')

    <style>
        .title_deg{
            font-size: 25px;
            padding-bottom: 40px;
            width: 99%;
        }
        .img_deg{
            width: 150px !important;
            height: 100px !important;
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
                <h1 class="title_deg text-center">Tất cả đơn hàng</h1>
                <div style="margin-left: 450px;padding-bottom: 30px">
                    <form action="{{ url('search') }}" method="GET">
                        @csrf
                        <input type="text" style="width: 450px; color: black" name="search"
                            placeholder="Tìm kiếm cái gì đó ở đây">
                        <input type="submit" value="Search" id="" class="btn btn-primary">
                    </form>
                </div>
                <table class="table table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Tên <br> Sản phẩm</th>
                            <th>Số <br> lượng</th>
                            <th>Giá</th>
                            <th>Trạng thái <br> thanh toán </th>
                            <th>Trạng thái <br> giao hàng</th>
                            <th>Hình ảnh</th>
                            <th>Đã giao <br>hàng</th>
                            <th>In file <br>PDF</th>
                            <th>Gửi <br> Email</th>
    
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order as $order)
                            <tr>
                                <td scope="row">{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->product_title }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->price }}</td>
                                <td >{{ $order->payment_status }}</td>
                                <td>{{ $order->delivery_status }}</td>
                                <td><img class="img_deg" src="product/{{ $order->image }}" alt=""></td>
    
                                <td>
                                    @if ($order->delivery_status == 'Đang Xử lý')
                                        <a href="{{ url('delivered', $order->id) }}"
                                            onclick="return confirm('Bạn có chắc chắc hàng đã được giao')"
                                            class="btn btn-success">Đã giao <br>
                                            hàng</a>
                                    @else
                                        <p class="text-success">Đã giao <br> hàng</p>
                                    @endif
    
                                </td>
                                <td>
                                    <a href="{{ url('print_pdf', $order->id) }}" class="btn btn-secondary">Xuất file <br>
                                        DPF</a>
                                </td>
                                <td>
                                    <a href="{{ url('send_email', $order->id) }}" class="btn btn-info">Gửi <br> Email</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="17">Không tìm thấy dữ liệu</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->

    @include('admin.script')
</body>

</html>
