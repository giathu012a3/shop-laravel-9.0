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
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

    <!-- why section -->
    
    <!-- end why section -->
    
    <!-- arrival section -->
    
    <!-- end arrival section -->
    
    <!-- product section -->
    @include('home.product_new')
    
    @include('home.why')
    <!-- end product section -->

    {{-- Comment --}}

    <div class="text-center" style="padding-bottom: 40px">

        <h1 style="font-size: 30px;text-align: center;padding-top: 20px;padding-bottom: 20px">Bình luận</h1>
        <form action="{{ url('add_comment') }}" method="POST">
            @csrf
            <textarea name="comment" style="height: 150px;width: 700px;" id="" placeholder="Bình luận đều gì đó ở đây"></textarea>
            <br>
            <input href="" type="submit" class="btn btn-primary" value="Bình luận"></input>
            {{-- <input type="text" class="btn btn-primary" name="" id="" value="Bình luận"> --}}
        </form>
    </div>
    <div style="padding-left: 20%">
        <h1 style="font-size: 20px;padding-bottom: 20px">Tất cả bình luận</h1>
        @foreach ($comment as $singleComment)
            <div>
                <b>{{ $singleComment->name }}</b>
                <p>{{ $singleComment->comments }}</p>
                <a href="javascript::void(0)" onclick="reply(this)" data-Commentid="{{ $singleComment->id }}">Trả
                    lời</a>
            </div>
            @foreach ($reply as $rep)
                @if ($rep->comments_id == $singleComment->id)
                    <div style="padding-left: 3%;padding-bottom: 10px;">
                        <b>{{ $rep->name }}</b>
                        <p>{{ $rep->reyly }}</p>
                        <a href="javascript::void(0)" onclick="reply(this)"
                            data-Commentid="{{ $singleComment->id }}">Trả lời</a>
                    </div>
                @endif
            @endforeach
        @endforeach

        <span style="padding-top: 20px">
            {!! $comment->withQueryString()->links('pagination::bootstrap-5') !!}
        </span>

        <div style="display: none" class="replyDiv">
            <form action="{{ url('add_reply') }}" method="POST">
                @csrf
                <input type="text" id="commentId" name="commentId" hidden="">
                <textarea style="height: 100px;width: 600px" name="reply" placeholder="Viết điều gì đó">
                  
                </textarea> <br>
                <button type="submit" class="btn btn-warning">Trả lời</button>
                <a href="javascript::void(0)" onclick="reply_close(this)">Đóng</a>
            </form>
        </div>
    </div>

    {{-- End Comment --}}

    <!-- subscribe section -->
    @include('home.subscribe')

    <!-- end subscribe section -->
    <!-- client section -->
    @include('home.client')

    <!-- end client section -->
    <!-- footer start -->
    @include('home.footer')

    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

        </p>
    </div>

    <script type="text/javascript">
        function reply(caller) {
            document.getElementById('commentId').value = $(caller).attr('data-Commentid')
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
        }

        function reply_close(caller) {
            $('.replyDiv').hide();
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>
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
