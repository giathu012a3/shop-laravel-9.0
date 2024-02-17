<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{ url('/') }}"><img height="90px" src="/images/logo.png"
                    alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collaps e navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Danh mục sản phẩm <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $category)
                                <li><a href="{{ url('view_product_category' ,$category->id) }}">{{ $category->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('view_all_product') }}">Products</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('show_cart') }}">Cart</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('show_order') }}">Order</a>
                    </li>




                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <x-app-layout>

                                </x-app-layout>

                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-primary" id="logincss" href="{{ route('login') }}">Đăng Nhập</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-success" href="{{ route('register') }}">Đăng Ký</a>
                            </li>
                        @endauth
                    @endif
                </ul>
            </div>

        </nav>

    </div>

    <div>
        <form action="{{ url('product_search') }}" method="GET">
            @csrf
            <input style="text-transform: none !important;width: 600px;margin-left: 35% ;" type="text" name="search"
                placeholder="Bạn có thể tìm kiếm sản phẩm ở đây">

            <input type="submit" value="search">
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
</header>
