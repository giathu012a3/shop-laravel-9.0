<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    <style>
        .title_deg {
            font-size: 25px;
            padding-bottom: 40px;
            width: 99%;
        }

        .img_deg {
            width: 150px !important;
            height: 100px !important;
            buser-radius: 0 !important;
        }
    </style>
    @include('admin.css')
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
                <h1 class="title_deg text-center">Quản lý người dùng</h1>
                <div style="margin-left: 450px;padding-bottom: 30px">
                    <form action="{{ url('search_admin') }}" method="GET">
                        @csrf
                        <input type="text" style="width: 450px; color: black" name="search_admin"
                            placeholder="Tìm kiếm cái gì đó ở đây">
                        <input type="submit" value="Search_admin" id="" class="btn btn-primary">
                    </form>
                </div>
                <table class="table table-dark text-center">
                    <thead class="thead-dark ">
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Quyền</th>
                            <th>Tình trạng email</th>
                            <th>Số điện thoại</th>
                            <th>Xóa</th>
                            <th>Phân quyền</th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $user)
                            <tr>
                                <td scope="row">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->address }}</td>
                                <td>
                                    @if ($user->usertype == 1)
                                        Admin
                                    @else
                                        User
                                    @endif

                                </td>
                                @if ($user->email_verified_at != null)
                                    <td class="text-success">
                                        Email đã được xác thực
                                    </td>
                                @else
                                    <td class="text-danger">
                                        Email chưa được xác thực
                                    </td>
                                @endif
                                <td>{{ $user->phone }}</td>


                                <td>
                                    <a onclick="return confirm('Bạn có chắc muốn xóa Danh Mục này')"
                                        href="{{ url('delete_user', $user->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                                @if ($user->usertype == 1)
                                    <td class="text-center">
                                        <a onclick="return confirm('Bạn có chắc muốn đổi quyền người dùng này')"
                                            href="{{ url('chagne_rosle', $user->id) }}" class="btn btn-success  ">Chuyển
                                            thành User</a>
                                    </td>
                                @else
                                    <td class="text-center">
                                        <a onclick="return confirm('Bạn có chắc muốn đổi quyền người dùng này')"
                                            href="{{ url('chagne_rosle', $user->id) }}" class="btn btn-success  ">Chuyển
                                            thành Admin</a>
                                    </td>
                                @endif
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8">Không tìm thấy dữ liệu</td>
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


                            </tr </tbody>
                    </table>
                </div>

            </div>

            <!-- container-scroller -->
            <!-- plugins:js -->

            @include('admin.script')
    </body>

    </html>
