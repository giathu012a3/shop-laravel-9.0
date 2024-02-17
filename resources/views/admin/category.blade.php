<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    @include('admin.css')
    <style>
        .div_center {
            text-align: center;
            padding-top: 40px
        }

        .h2_font {
            font-size: 44px;
            padding-bottom: 40px
        }

        .input_color {
            color: black;
        }
        .center{
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px
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

                <div class="div_center">
                    <h2 class="h2_font">Thêm Danh Mục</h2>
                    <form action="{{ url('/add_category') }}" method="POST">
                        @csrf
                        <input type="text" class="input_color" name="category" id=""
                            placeholder="Viết tên danh mục mới" aria-describedby="helpId">
                        <input type="submit" class="btn btn-primary" name="submit" value="Thêm danh mục">
                    </form>
                </div>
                <table class="center table table-based">
                    <tr class="text-success">
                        <th>Tên Danh Mục</th>
                        <th>Trạng thái</th>
                    </tr>
                    @foreach ($data as $data)
                        
                    <tr>
                        <td>{{ $data->category_name }}</td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc muốn xóa Danh Mục này')" href="{{ url('delete_category',$data->id) }}" class="btn btn-danger" >Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->

        @include('admin.script')
</body>

</html>
