<div class="theme-inner-banner">
    <div class="mohu"></div>
    <div class="container account-css">
        <h2 class="intro-title text-center">用户登录</h2>
        <p class="text-center">
            <?php echo get_set('login_top_text'); ?>
        </p>
    </div>
    <img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
    <img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
    <div class="main-content">
        <div class="formDiv">
            <h2 class="text-center">登录</h2>
            <div class="dataform">
                <div class="input-warp gap">
                    <span class="input-icon iconfont icon-yonghu1"></span>
                    <input name="account" id="account" type="text" class="inputs" placeholder="手机号码或邮箱" maxlength="64" title="请输入手机号码或邮箱" data-bs-toggle="tooltip">
                </div>
                <div class="error-content">
                    <span id="userNameErr" class="errMsg"></span>
                </div>

                <div class="input-warp gap">
                    <span class="input-icon iconfont icon-baomi"></span>
                    <input class="inputs" type="password" id="passwd" name="password" placeholder="密码" maxlength="20" title="请输入密码" data-bs-toggle="tooltip">
                </div>
                <div class="error-content">
                    <span id="passwordErr" class="errMsg"></span>
                </div>
                <div class="input-warp gap" id="captcha_div" style="display: none;">
                    <span class="input-icon iconfont icon-yanzhengma"></span>
                    <input id="captcha" name="captcha" placeholder="验证码" type="text" class="inputs" value="" maxlength="6" title="请输入验证码" data-bs-toggle="tooltip">
                </div>
                <div class="btn-warp gap">
                    <div class="text-center">
                        <button type="submit" id="sendlogin" class="btn w-100 lgbtn blue">登录</button>
                    </div>
                </div>
                <div class="gap">

                    <div class="float-end" style="margin-top: 6px">
                        <a href="./forgot-password" class="link">忘记密码</a><span class="split-space">|</span><a href="register" class="link">新用户注册</a>
                    </div>

                    <div class="pretty-box">
                        <input type="checkbox" value="1" name="remember" id="remember" class="">
                        <label for="remember" style="font-weight: normal" title="记住登录" data-bs-toggle="tooltip">记住我</label>
                    </div>
                </div>
                <?php if (get_set('admin_qqlogin') == 'on' || get_set('admin_WeChatlogin') == 'on' || get_set('admin_alilogin') == 'on') : ?>
                    <div class="biggap third-party-title">
                        <h5 class="text-center"><span>第三方账号登录</span></h5>
                    </div>
                    <div class="third-auth">
                        <div class="d-flex justify-content-center align-middle pt-3">
                            <?php if (get_set('admin_WeChatlogin') == 'on') : ?>
                                <button class="d-inline me-3" title="用微信账户登录" onclick='toLogin("WeChat")' style="font-size: 1.9rem;padding: 0.25rem 0.269rem;border-radius: 4px;color: #fff;background-color: #2aae67;" data-bs-toggle="tooltip"><i class="fab fa-weixin fa-sm"></i></button>
                            <?php endif; ?>
                            <?php if (get_set('admin_qqlogin') == 'on') : ?>
                                <button class="d-inline me-3" title="用QQ账户登录" onclick='toLogin("qq")' style="font-size: 1.9rem;padding: 0.25rem 0.15rem;border-radius: 4px;color: #fff;background-color: #48b0f7;" data-bs-toggle="tooltip"><i class="fab fa-qq fa-fw fa-sm"></i></button>
                            <?php endif; ?>
                            <?php if (get_set('admin_alilogin') == 'on') : ?>
                                <button class="d-inline" title="用支付宝账户登录" onclick='toLogin("ali")' style="font-size: 2.5rem;color:#1677ff;" data-bs-toggle="tooltip"><i class="fab fa-alipay"></i></button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<style>
    .mohu::before {
        background-image: url(<?php echo get_set('web_back_url'); ?>);
        background-attachment: fixed;
        background-position: center;
        filter: blur(<?php echo get_set('web_back_blur'); ?>px);
        -webkit-filter: blur(<?php echo get_set('web_back_blur'); ?>px);
        -moz-filter: blur(<?php echo get_set('web_back_blur'); ?>px);
        -o-filter: blur(<?php echo get_set('web_back_blur'); ?>px);
        -ms-filter: blur(<?php echo get_set('web_back_blur'); ?>px);
    }

    .theme-inner-banner .shape-one,
    .theme-inner-banner .shape-two {
        top: 80%;
    }

    .theme-inner-banner {
        padding: 150px 0 10px;
    }

    @font-face {
        font-family: "iconfont";
        src: url('//at.alicdn.com/t/font_43459_lbtux0zjkr6yldi.eot?t=1503487127198');
        /* IE9*/
        src: url('//at.alicdn.com/t/font_43459_lbtux0zjkr6yldi.eot?t=1503487127198#iefix') format('embedded-opentype'),
            /* IE6-IE8 */
            url('//at.alicdn.com/t/font_43459_lbtux0zjkr6yldi.woff?t=1503487127198') format('woff'),
            /* chrome, firefox */
            url('//at.alicdn.com/t/font_43459_lbtux0zjkr6yldi.ttf?t=1503487127198') format('truetype'),
            /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
            url('//at.alicdn.com/t/font_43459_lbtux0zjkr6yldi.svg?t=1503487127198#iconfont') format('svg');
        /* iOS 4.1- */
    }

    .formDiv {
        font-family: "微软雅黑", "Verdana", "宋体", "Lucida Grande", "Lucida Sans Unicode", Tahoma, sans-serif;
        font-size: 14px;
    }

    .main-content {
        margin-left: auto;
        margin-right: auto;
        background: #fff;
        margin-bottom: 100px;
    }

    @media (min-width: 1025px) {
        .main-content {
            width: 500px;
            margin-top: 50px;
            padding: 20px 50px;
            border-radius: 4px;
        }
    }

    .formDiv h2 {
        padding: 10px 0 20px;
        font-size: 20px;
        color: #545454;
    }

    .gap {
        margin-top: 20px;
    }

    .input-warp {
        border: 1px solid #e9e9e9;
        border-radius: 2px;
        padding: 7px 0;
    }

    .iconfont {
        font-family: "iconfont" !important;
        font-size: 16px;
        font-style: normal;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .input-icon {
        padding: 0 18px;
        color: #999;
    }

    .icon-yanzhengma:before {
        content: "\e7af";
    }

    .icon-yonghu1:before {
        content: "\e75d";
    }

    .inputs {
        border: 0;
        width: 80%;
        color: #545454;
        background: transparent;
    }

    .error-content {
        text-indent: 18px;
    }

    .errMsg {
        color: rgba(253, 66, 56, .8);
        display: none;
    }

    .icon-baomi:before {
        content: "\e798";
    }

    .btn.blue,
    .btn.blue:ACTIVE {
        background-color: #48b0f7;
        color: #fff;
        border: 1px solid #48b0f7;
    }

    .lgbtn {
        line-height: 26px;
    }

    .btn.blue:hover {
        background-color: #32a5ff;
        border: 1px solid #32a5ff;
    }

    .gap .split-space {
        color: #48b0f7;
        margin: 0 10px;
    }

    .gap .link:hover {
        text-decoration: revert;
    }

    input[type="radio"],
    input[type="checkbox"] {
        margin: 4px 0 0;
        margin-top: 1px \9;
        line-height: normal;
    }

    .pretty-box input[type="radio"]+label,
    .pretty-box input[type="checkbox"]+label {
        position: relative;
        display: inline-block;
        height: 30px;
        padding-left: 20px;
        line-height: 30px;
        max-width: 100%;
        margin-bottom: 5px;
    }

    .pretty-box input[type="radio"],
    .pretty-box input[type="checkbox"] {
        position: absolute;
        clip: rect(0, 0, 0, 0);
    }

    .pretty-box input[type="radio"]+label:before,
    .pretty-box input[type="checkbox"]+label:before {
        border-color: #999;
    }

    .pretty-box input[type="checkbox"]+label:before {
        border-radius: 2px;
    }

    .pretty-box input[type="radio"]+label:before,
    .pretty-box input[type="checkbox"]+label:before {
        content: " ";
        position: absolute;
        box-sizing: content-box;
        left: 0;
        top: 8px;
        width: 12px;
        height: 12px;
        border: 1px solid;
    }

    .pretty-box input[type="checkbox"]:checked+label:before {
        background: transparent;
        border-color: #48b0f7;
    }

    .pretty-box input[type="checkbox"]:checked+label:after {
        border-color: #48b0f7 !important;
    }

    .pretty-box input[type="checkbox"]:checked+label:after {
        content: " ";
        position: absolute;
        top: 9px;
        left: 5px;
        box-sizing: border-box;
        width: 5px;
        height: 10px;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        border: 2px solid;
        border-top: 0;
        border-left: 0;
    }

    .third-party-title {
        border-bottom: 1px solid #dedede;
    }

    .biggap {
        margin-top: 40px;
    }

    .third-party-title h5 {
        margin-bottom: -5px;
        font-size: 14px;
    }

    .third-party-title span {
        background-color: white;
        padding: 0 10px 0 10px;
        color: #545454;
    }

    .third-auth {
        text-align: center;
        position: relative;
        padding: 10px 0;
    }

    .third-auth a.dt {
        background-position: right;
    }

    .third-auth a.wx {
        background-position: center;
    }

    .third-auth a.qq {
        background-position: 0 0;
    }

    .third-auth a {
        color: #666;
        margin: 15px 20px 0 30px;
        width: 40px;
        height: 40px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        display: inline-block;
        border-radius: 4px;
        zoom: 1;
        background: #fff url(/assets/Sinco/images/authn.png) no-repeat center center;
    }

    @media (max-width: 768px) {
        .main-content {
            width: 100%;
            margin-top: 0;
            padding: 20px 20px;
        }
    }
</style>
<script src="/user/js/sweetalert2.3.3.8.pro.min.js"></script>
<script src="/user/js/api.admin.js"></script>
<?php if (get_set('captcha_type') == 1) : ?>
    <script src="https://turing.captcha.qcloud.com/TCaptcha.js"></script>
<?php elseif (get_set('captcha_type') == 2) : ?>
    <script src="//static.geetest.com/v4/gt4.js"></script>
<?php endif; ?>
<script>
    $("#sendlogin").click(function() {
        if (!isemail($("#account").val()) && !isMobile($("#account").val())) {
            swal({
                text: "邮箱或手机格式有误，请检查！",
                title: "出错啦",
                type: "error",
                confirmButtonText: "我再试试"
            });
            $('#account').shake(2, 10, 400);
            throw SyntaxError();
        }
        if ($("#passwd").val().length < 6) {
            swal({
                text: "密码输入有误，请检查！",
                title: "出错啦",
                type: "error",
                confirmButtonText: "我再试试"
            });
            $('#passwd').shake(2, 10, 400);
            throw SyntaxError();
        }

        $.getJSON('?Captcha=1&account=' + $("#account").val(), function(Capres) {
            $("#sendlogin").html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> 正在登录..');
            $("#sendlogin").prop("disabled", true);
            if (Capres.msg == 'true') {
                <?php if (get_set('captcha') == 'on') : ?>
                    <?php if (get_set('captcha_type') == 1) : ?>
                        var captcha = new TencentCaptcha('<?php echo get_set("tcloud_captcha_Appid"); ?>', function(res) {
                            if (res.ret === 0) {
                                login(res);
                            } else {
                                $("#sendlogin").html('登录');
                                $("#sendlogin").prop("disabled", false);
                            }
                        });
                        captcha.show();
                    <?php elseif (get_set('captcha_type') == 2) : ?>
                        initGeetest4({
                            captchaId: '<?php echo get_set("geetest_captcha_id"); ?>',
                            product: 'bind'
                        }, function(captchaObj) {
                            captchaObj.onReady(function() {
                                captchaObj.showCaptcha();
                            }).onSuccess(function() {
                                var res = captchaObj.getValidate();
                                //console.log(res);
                                login(res);
                                captchaObj.reset()
                            }).onError(function() {
                                //err code
                                $("#sendlogin").html('登录');
                                $("#sendlogin").prop("disabled", false);
                            })
                        });
                    <?php elseif (get_set('captcha_type') == 0) : ?>
                        swal({
                            title: '请填写下图验证码：',
                            html: '<img src="/user/captcha_img" class="w-100 mt-3 rounded" id="captcha_img"><br><input id="swal-input1" placeholder="请填写验证码" class="swal2-input my-0" autofocus>',
                            preConfirm: function() {
                                return new Promise(function(resolve) {
                                    resolve([
                                        $('#swal-input1').val(),
                                    ]);
                                });
                            }
                        }).then(function(result) {
                            if (result[0].length == 6) {
                                $("#sendlogin").html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> 正在登录..');
                                $("#sendlogin").prop("disabled", true);
                                login([result[0]]);
                            } else {
                                swal('验证码输入错误！', '', 'error');
                            }
                        });
                        $("#sendlogin").html('登录');
                        $("#sendlogin").prop("disabled", false);
                        $("#captcha_img").click(function() {
                            $(this).attr("src", "/user/captcha_img");
                        });
                    <?php endif; ?>
                <?php else : ?>
                    login();
                <?php endif; ?>
            } else {
                login();
            }
        });

        function login(res = []) {
            $.ajax({
                url: "./login",
                type: "POST",
                dataType: "json",
                data: {
                    account: $("#account").val(),
                    passwd: $("#passwd").val(),
                    captcha_code: $("#captcha").val(),
                    remember: $('#remember').is(':checked'),
                    <?php if (get_set('captcha') == 'on') : ?>
                        <?php if (get_set('captcha_type') == 1) : ?>
                            ket: res.ticket,
                            rand: res.randstr,
                        <?php elseif (get_set('captcha_type') == 2) : ?>
                            lot_number: res.lot_number,
                            captcha_output: res.captcha_output,
                            pass_token: res.pass_token,
                            gen_time: res.gen_time,
                        <?php elseif (get_set('captcha_type') == 0) : ?>
                            captcha: res[0],
                        <?php endif; ?>
                    <?php endif; ?>
                },
                success: function(result) {
                    if (result.code != 200) {
                        if (result.code == 403) {
                            $("#captcha_div").show();
                            $("#captcha").focus().click();
                        }
                        swal({
                            text: result.msg,
                            title: "登录失败",
                            type: "error",
                            confirmButtonText: "我再试试"
                        }).then(function(value) {
                            if (value) {
                                //location.reload();
                                //window.location.href = './';
                            }
                        });
                    } else if (result.code == 200) {
                        swal({
                            text: result.msg,
                            title: "登录成功",
                            type: "success",
                            confirmButtonText: "点击跳转",
                            timer: 2000,
                        }).then(function(value) {
                            //if (value) {
                            var uri = getUrlParam('url');
                            if (!uri) {
                                window.location.href = './';
                            } else {
                                window.location.href = uri;
                            }
                            //}
                        });
                    }
                    $("#sendlogin").html('登录');
                    $("#sendlogin").prop("disabled", false);
                }
            });
        }
    });

    $("#account").keyup(function(event) {
        if (event.which == 13) {
            $('#sendlogin').click();
        }
    });
    $("#passwd").keyup(function(event) {
        if (event.which == 13) {
            $('#sendlogin').click();
        }
    });
    $(function() {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    });
</script>