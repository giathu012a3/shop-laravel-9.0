<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    @include('admin.css')

    <style>
        .title_deg {
            font-size: 25px;
            padding-bottom: 40px;
            width: 99%;
        }

        .img_deg {
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
                <h1 class="title_deg text-center">Tất cả bình luận trong sản phẩm</h1>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert" aria-hidden="true">
                            x
                        </button>
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div style="margin-left: 450px;padding-bottom: 30px">
                    <form action="{{ url('search_comment_product') }}" method="GET">
                        @csrf
                        <input type="text" style="width: 450px; color: black" name="search_comment_product"
                            placeholder="Tìm kiếm cái gì đó ở đây">
                        <input type="submit" value="Search" id="" class="btn btn-primary">
                    </form>
                </div>
                <table class="table table-dark">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tên</th>
                            <th>Tên sản phẩm đã được bình luận</th>
                            <th>Nội dung</th>
                            <th>Thời gian bình luận</th>
                            <th>Xóa</th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @forelse ($comment as $comments)
                                <td scope="row">{{ $comments->name }}</td>
                                @foreach ($product as $products)
                                    @if ($products->id == $comments->product_id)
                                        <td>{{ $products->title }}</td>
                                    @endif
                                    @endforeach
                                    <td>{{ $comments->comments }}</td>
                                    <td>{{ $comments->created_at }}</td>
                                    <td>
                                        <a onclick="return confirm('Bạn chắc chắc muốn xóa không')" class="btn btn-danger"
                                            href="{{ url('/delete_comment_product', $comments->id) }}">Xóa</a>
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
