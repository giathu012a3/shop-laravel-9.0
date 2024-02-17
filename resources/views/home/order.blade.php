<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Phenix-Zakiel Shop</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
    <style>
        .center {
            margin: auto;
            width: 86%;
            padding: 30px;
            text-align: center;
        }

        .text_deg {

            font-size: 40px;
            padding: 40px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

    <div class="center">
        <table class="table table-striped text-center">
            <hr>
            <h1 class="text_deg">Chi tiết các đơn hàng đã đặt</h1>
            <thead class="thead-light">
                <tr>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Thanh toán</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Ảnh</th>
                    <th scope="col">Hủy đơn</th>
                </tr>
            </thead>
            @foreach ($order as $order)
                <tr>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                    <td><img height="100" width="180" src="product/{{ $order->image }}" alt=""></td>
                    @if ($order->delivery_status == 'Đang Xử lý')
                        <td>
                            <a href="{{ url('cancel_order', $order->id) }}"
                                onclick="return confirm('Bạn cso chắc muốn hủy đơn hàng này')"
                                class="btn btn-danger">Hủy đơn</a>
                        </td>
                    @else
                        <td class="text-primary">Không thể hủy</td>
                    @endif
                </tr>
            @endforeach
        </table>


        <!-- jQery -->
        <script src="home/js/jquery-3.4.1.min.js"></script>
        <!-- popper js -->
        <script src="home/js/popper.min.js"></script>
        <!-- bootstrap js -->
        <script src="home/js/bootstrap.js"></script>
        <!-- custom js -->
        <script src="home/js/custom.js"></script>
</body>

</html>
