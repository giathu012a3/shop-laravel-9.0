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
            margin-top: 0;
            margin: 0 auto;
            width: 80%;
        }

        .img_des {
            margin: auto;
            width: 200px;
            height: 200px;
        }


        .total_deg {
            text-align: right;
            font-size: 24px;
            font-weight: 600;
            padding: 40px
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert" aria-hidden="true">
                            x
                        </button>
                        {{ session()->get('message') }}
                    </div>
                @endif
        <div class="center">

            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Giá</th>
                        <th>Ảnh minh họa</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalprice = 0; ?>
                    @foreach ($cart as $cart)
                        <tr>
                            <td scope="row">{{ $cart->product_title }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td> ${{ $cart->price}}</td>
                            <td><img class="img_des" src="product/{{ $cart->image }}" alt=""></td>
                            <td>
                                <a href="{{ url('remove_cart', $cart->id) }}"
                                    onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này trong giỏ hàng của bạn')"
                                    class="btn btn-danger">Xóa sản phẩm</a>
                            </td>
                        </tr>
                        <?php $totalprice = $totalprice + $cart->price; ?>
                    @endforeach
                </tbody>
            </table>
            <div class="total_deg">
                <h1>Tổng tiền: ${{$totalprice}}</h1>
                <hr style="height: 2px;background-color: black ">
                <h1>Phương thức thanh toán</h1>
                <a href="{{ url('cash_order') }}" class="btn btn-danger">Thanh toán bằng tiên mặt</a>
                <a href="{{ url('stripe',$totalprice) }}" class="btn btn-danger">Thanh toán bằng Thẻ</a>
            </div>
        </div>
    </div>


    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>
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
