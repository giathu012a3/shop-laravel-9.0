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
                    <h1 class="font_size">Cập Nhật sản phẩm</h1>
                    <form action="{{ url('/update_product_confirm',$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="div_desgin">
                            <label for="">Tên sản phẩm:</label>
                            <input type="text" name="title" class="text_color" id=""
                                placeholder="Nhập tên sản phẩm" aria-describedby="helpId" required="" value="{{ $product->title }}">
                        </div>
                        <div class="div_desgin">
                            <label for="">Mô tả sản phẩm:</label>
                            <input type="text" name="description" class="text_color" id=""
                                placeholder="Viết Mô tả sản phẩm" aria-describedby="helpId" required="" value="{{ $product->description }}">
                        </div>
                        <div class="div_desgin">
                            <label for="">Giá sản phẩm:</label>
                            <input type="number" name="price" class="text_color" id=""
                                placeholder="Nhập giá sản phẩm" aria-describedby="helpId" required="" value="{{ $product->price }}">
                        </div>
                        <div class="div_desgin">
                            <label for="">Giảm giá:</label>
                            <input type="number" name="dis_price" class="text_color" id=""
                                placeholder="Nhập giá giảm của sản phẩm" aria-describedby="helpId"  value="{{ $product->discount_price }}">
                        </div>
                        <div class="div_desgin">
                            <label for="">Số lượng sản phẩm:</label>
                            <input type="number" min="0" name="quantity" class="text_color" id=""
                                placeholder="Nhập số lượng sản phẩm" aria-describedby="helpId" required="" value="{{ $product->quantity }}">
                        </div>

                        <div class="div_desgin">
                            <label for="">Danh mục sản phẩm:</label>
                            <select class="text_color" name="category" id="" required="" ">
                                <option value="{{ $product->category }}" selected>{{ $product->category }}</option>
                                @foreach ($category as $item)
                                <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="div_desgin">
                            <label for="">Ảnh sản phẩm:</label>
                            <img style="margin: auto" src="/product/{{ $product->image }}" height="100px" width="100px" alt="">
                        </div>
                        <div class="div_desgin">
                            <label for="">Chọn Ảnh sản phẩm:</label>
                            <input type="file" name="image" >
                        </div>
                        <div class="div_desgin">
                            <input type="submit" value="Cập Nhật sản phẩm" class="btn btn-primary">
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
