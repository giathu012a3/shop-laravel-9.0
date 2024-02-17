<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    @include('admin.css')

    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .font_size {
            font-size: 44px;
            padding-bottom: 40px;
        }

        .text_color {
            color: #000;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_desgin {
            padding-bottom: 12px
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
                    <h1 class="font_size">Thêm sản phẩm</h1>
                    <form action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_desgin">
                            <label for="">Tên sản phẩm:</label>
                            <input type="text" name="title" class="text_color" id=""
                                placeholder="Nhập tên sản phẩm" aria-describedby="helpId" required="">
                        </div>
                        <div class="div_desgin">
                            <label for="">Mô tả sản phẩm:</label>
                            <input type="text" name="description" class="text_color" id=""
                                placeholder="Viết Mô tả sản phẩm" aria-describedby="helpId" required="">
                        </div>
                        <div class="div_desgin">
                            <label for="">Giá sản phẩm:</label>
                            <input type="number" name="price" class="text_color" id=""
                                placeholder="Nhập giá sản phẩm" aria-describedby="helpId" required="">
                        </div>
                        <div class="div_desgin">
                            <label for="">Giảm giá:</label>
                            <input type="number" name="dis_price" class="text_color" id=""
                                placeholder="Nhập giá giảm của sản phẩm" aria-describedby="helpId" >
                        </div>
                        <div class="div_desgin">
                            <label for="">Số lượng sản phẩm:</label>
                            <input type="number" min="0" name="quantity" class="text_color" id=""
                                placeholder="Nhập số lượng sản phẩm" aria-describedby="helpId" required="">
                        </div>

                        <div class="div_desgin">
                            <label for="">Danh mục sản phẩm:</label>
                            <select class="text_color" name="category" id="" required="">
                                <option value="" selected>Thêm danh mục ở đây</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="div_desgin">
                            <label for="">Ảnh sản phẩm:</label>
                            <input type="file" name="image" required="">
                        </div>
                        <div class="div_desgin">
                            <input type="submit" value="Thêm sản phẩm" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->

    @include('admin.script')
</body>

</html>
