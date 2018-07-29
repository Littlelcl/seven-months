<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="三国杀,三国杀online,三国游戏,桌游,卡牌游戏,杀人游戏,sgs" />
    <meta name="description" content="三国杀是一款风靡中国的智力卡牌桌游，以三国为背景、以身份为线索、以武将为角色，构建起一个集历史、文学、美术、游戏等元素于一身的桌面游戏世界，已经推出PC版、手机版等产品。 " />
    <title>电脑租赁服务平台</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/index/auth/base.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/index/auth/style.css') }}">
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="bookmark" href="favicon.ico" type="image/x-icon"/>
</head>
<body>
<div class="wrap-login">
    <div class="login-top">七月放飞自我</div>
    <div class="login" id="login">
        <h3 class="login-title">管理员登录</h3>
        <form id="form1" method="post" action="{{ route('adminLogin') }}" autocomplete="off">
            <div class="login-list">
                <label for="textfield" class="default-text">输入账号</label>
                <input type="text" name="phone"  class="default-input"/>
                <span class="checktip"></span>
            </div>
            <div class="login-list">
                <label for="textfield2" class="default-text">密码</label>
                <input type="password" name="password"  class="default-input"/>
                <span class="checktip"></span>
            </div>
            {{ csrf_field() }}
            <div>
                <input type="submit"  value="登录" class="submit-input"/>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/lib/jquery-1.10.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin/auth/index.js') }}"></script>
<script type="text/javascript">
    /*var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "//hm.baidu.com/hm.js?5a27affb7986a65f49feab53f3c60e49";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();*/
</script>
<!--[if IE 6]>
<script src="{{ asset('js/lib/ie6.js') }}"></script>
<script>
    DD_belatedPNG.fix('*');
</script>
<![endif]-->
</body>
</html>
