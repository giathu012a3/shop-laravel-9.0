<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <!-- Required meta tags -->

    @include('admin.css')
    <style>
        label{
            display: inline-block;
            width: 150px;
            font-size: 15px;
            font-weight: bold;
        }
        input{
            color: black;
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
                <h1 style="text-align: center;font-size: 25px">Gửi Email đến {{ $order->email }}</h1>
                <form action="{{ url('send_user_email',$order->id) }}" method="POST">
                    @csrf
                    <div style="padding-left: 35%;padding-top: 30px;">

                        <label for="">Email Gerrting: </label>
                        <input style="color: black" type="text" name="gerrting">
                    </div>


                    <div style="padding-left: 35%;padding-top: 30px;">

                        <label for="">Email Fistling: </label>
                        <input style="color: black" type="text" name="firstline">
                    </div>

                    <div style="padding-left: 35%;padding-top: 30px;">

                        <label for="">Nôi dung Email: </label>
                        <input style="color: black" type="text" name="body">
                    </div>

                    <div style="padding-left: 35%;padding-top: 30px;">

                        <label for="">Email Button name: </label>
                        <input style="color: black" type="text" name="button">
                    </div>

                    <div style="padding-left: 35%;padding-top: 30px;">

                        <label for="">Email url: </label>
                        <input style="color: black" type="text" name="url">
                    </div>

                    <div style="padding-left: 35%;padding-top: 30px;">

                        <label for="">Email Last Line: </label>
                        <input style="color: black" type="text" name="lastline">
                    </div>

                    <div style="padding-left: 35%;padding-top: 30px;">

                        <input  type="submit" value="Gửi Email" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->

        @include('admin.script')
</body>

</html>
