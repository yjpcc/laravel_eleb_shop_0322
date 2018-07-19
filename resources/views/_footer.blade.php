@auth

<div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="text-align: center">修改个人密码</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('editPwd',[auth()->user()]) }}" method="post">
                    <div class="form-group">
                        <input type="password" name="oldpassword" class="form-control" placeholder="旧密码">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="新密码">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
                    </div>
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <button class="btn btn-info btn-block">修改</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#btn1").click(function () {
        $(".name").html('<input type="text" name="name" placeholder="用户名" value="{{ auth()->user()->name }}">');
        $(".submit").html('<button class="btn btn-info" type="submit">修改</button>')
    });

    $("#logout").click(function () {
        $.ajax({
            url:"{{ route('logout') }}",
            type:"DELETE",
            dataType:"json",
            success:function(e){
                location.href="{{ route('shops.index') }}";
            }
        });
    })
</script>
@endauth

</body>
</html>