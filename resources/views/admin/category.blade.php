<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        .page-header {
            padding: 30px 0;
            text-align: center;
            background: #191c24;
            margin-bottom: 30px;
            border-radius: 10px;
        }
        .form-container {
            background: #191c24;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 0 auto 40px auto;
        }
        .custom-table {
            background: #191c24;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        .table thead th {
            background: #0090e7;
            color: white;
            border: none;
            padding: 15px;
        }
        .table tbody td {
            color: #ffffff;
            padding: 15px;
            vertical-align: middle;
            border-top: 1px solid #2c2e33;
        }
        .input-style {
            background: #2a3038 !important;
            border: 1px solid #2c2e33 !important;
            color: white !important;
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
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Thành công!</strong> {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger shadow">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><i class="mdi mdi-alert-circle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="page-header">
                    <h2 class="text-white">QUẢN LÝ DANH MỤC SẢN PHẨM</h2>
                </div>

                <div class="form-container">
                    <form action="{{ url('/add_category') }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="text" class="form-control input-style mr-2" name="category" 
                               placeholder="Nhập tên danh mục mới..." required>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="mdi mdi-plus-circle"></i> Thêm mới
                        </button>
                    </form>
                </div>

                <div class="custom-table">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="70%">Tên Danh Mục</th>
                                <th width="30%" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $category)
                                <tr>
                                    <td>
                                        <span class="badge badge-outline-info p-2">{{ $category->category_name }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')" 
                                           href="{{ url('delete_category', $category->id) }}" 
                                           class="btn btn-danger btn-sm shadow">
                                            <i class="mdi mdi-delete"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @include('admin.script')
</body>

</html>
