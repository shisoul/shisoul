<div class="theme-inner-banner" style="background: linear-gradient( #fff,#f5f6fa,#fff);">
    <div class="mohu"></div>
    <div class="container account-css">
        <h2 class="intro-title text-center">找回密码</h2>
        <p class="text-center">
            忘记账户？ <a href="/about/#message">联系我们</a>
        </p>
    </div>
    <img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
    <img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
    <div class="main-content">
        <div class="formDiv">
            <h2 class="text-center">找回密码</h2>
            <div class="switch">

            </div>
            <div class="form-item">
                <div class="input-warp">
                    <span class="input-icon iconfont icon-yonghu1"></span>
                    <?php if (get_set('captcha_send_type') == 1) : ?>
                        <input id="account" name="account" placeholder="手机号码" type="text" class="inputs" value="" />
                    <?php elseif (get_set('captcha_send_type') == 0) : ?>
                        <input id="account" name="account" placeholder="邮箱地址" type="text" class="inputs" value="" />
                    <?php elseif (get_set('captcha_send_type') == 2) : ?>
                        <input id="account" name="account" placeholder="手机号码/邮箱地址" type="text" class="inputs" value="" />
                    <?php endif; ?>
                </div>
                <p id="userNameErr" class="errMsg"></p>
            </div>
            <?php if (get_set('captcha_send_type') != 'off') : ?>
            <div class="form-item">
                <div class="input-warp s">
                    <span class="input-icon iconfont icon-yanzhengma"></span>

                    <input id="captcha" name="captcha" placeholder="验证码" type="text" class="inputs" value="" />
                    <div id="popup-captcha" style="display: none"></div>
                </div>
                <div class="float-end">
                    <button id="sendcode" class="btn lgbtn blue">获取验证码</button>
                </div>
                <p id="kaptchaErr" class="errMsg"></p>
            </div>
            <?php endif; ?>
            <div class="form-item">
                <div class="input-warp">
                    <span class="input-icon iconfont icon-baomi"></span>

                    <input id="Password" type="Password" placeholder="新密码至少6位字母或数字" maxlength="20" name="Password" value="" class="inputs" />
                </div>
                <p id="passwordErr" class="errMsg"></p>
            </div>
            <div class="form-item">
                <div class="input-warp">
                    <span class="input-icon iconfont icon-baomi"></span>

                    <input id="SPassword" type="Password" placeholder="再次输入密码" maxlength="20" name="SPassword" value="" class="inputs" />
                </div>
                <p id="passwordErr2" class="errMsg"></p>
            </div>
            <div class="btn-warp">
                <div class="text-center">
                    <button type="button" id="sendreg" class="btn lgbtn blue w-100">找回密码</button>
                    <input id="appName" name="appName" type="hidden" value="jsform" />
                </div>
            </div>
            <div class="agreement gap">
                <div class="text-center">
                    <p>
                        已知密码，<a href="login" class="link">登录</a>
                    </p>
                </div>
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

    .switch {
        text-align: right;
        padding-right: 15px;
        line-height: 34px;
    }

    .text-right {
        text-align: right;
    }

    .text-right p {
        font-size: 13px;
    }

    .agreement,
    .switch,
    .pretty-box {
        font-size: 13px;
        color: #999;
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

    .icon-yonghu1:before {
        content: "\e75d";
    }

    .inputs {
        border: 0;
        width: 70%;
        color: #545454;
        background: transparent;
    }

    .error-content {
        text-indent: 18px;
    }

    .errMsg {
        color: rgba(253, 66, 56, .8);
        margin-bottom: 14px;
    }

    .icon-baomi:before {
        content: "\e798";
    }

    .icon-yanzhengma:before {
        content: "\e7af";
    }

    .icon-youxiangbangding:before {
        content: "\e753";
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

    .input-warp.s {
        display: inline-block;
        box-sizing: border-box;
    }

    @media (min-width: 1025px) {
        .input-warp.s {
            width: 70%;
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
    $("#sendcode").click(function() {
        <?php if (get_set('captcha_send_type') == 1) : ?>
            if (!isMobile($("#account").val())) {
                swal({
                    text: "手机号格式有误，请检查！",
                    title: "出错啦",
                    type: "error",
                    confirmButtonText: "我再试试"
                });
                $('#phone').shake(2, 10, 400);
                throw SyntaxError();
            }
        <?php elseif (get_set('captcha_send_type') == 0) : ?>
            if (!isemail($("#account").val())) {
                swal({
                    text: "邮箱格式有误，请检查！",
                    title: "出错啦",
                    type: "error",
                    confirmButtonText: "我再试试"
                });
                $('#phone').shake(2, 10, 400);
                throw SyntaxError();
            }
        <?php endif; ?>
        <?php if (get_set('captcha_send_type') == 2) : ?>
            if (!isMobile($("#account").val()) && !isemail($("#account").val())) {
                swal({
                    text: "手机号或邮箱格式有误，请检查！",
                    title: "出错啦",
                    type: "error",
                    confirmButtonText: "我再试试"
                });
                $('#phone').shake(2, 10, 400);
                throw SyntaxError();
            }
        <?php endif; ?>
        else {
            <?php if (get_set('captcha') == 'on') : ?>
                <?php if (get_set('captcha_type') == 1) : ?>
                    var captcha = new TencentCaptcha('<?php echo get_set("tcloud_captcha_Appid"); ?>', function(res) {
                        if (res.ret === 0) {
                            get_email_code(res);
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
                            get_email_code(res);
                            captchaObj.reset()
                        }).onError(function() {
                            //err code
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
                            get_email_code([result[0]]);
                        } else {
                            swal('验证码输入错误！', '', 'error');
                        }
                    });
                    $("#captcha_img").click(function() {
                        $(this).attr("src", "/user/captcha_img");
                    });
                <?php endif; ?>
            <?php else : ?>
                get_email_code();
            <?php endif; ?>

            function get_email_code(res = []) {
                document.getElementById("sendcode").disabled = true;
                $("#sendcode").text("发送中..");
                $.ajax({
                    url: "./fpasswd",
                    type: "POST",
                    dataType: "json",
                    data: {
                        type: "get_captcha_code",
                        account: $("#account").val(),
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
                            swal({
                                text: result.msg,
                                title: "出错啦",
                                type: "error",
                                confirmButtonText: "我再试试"
                            });
                            $("#sendcode").removeAttr("disabled");
                            $("#sendcode").text("获取验证码");
                        } else if (result.code == 200) {
                            swal({
                                text: result.msg,
                                title: "获取成功",
                                type: "success",
                                confirmButtonText: "确定",
                            });
                            var time = 180;
                            var flag = true;
                            var timer = setInterval(function() {
                                    flag = false;
                                    if (time == 0) {
                                        $("#sendcode").removeAttr("disabled");
                                        $("#sendcode").text("获取验证码");
                                        clearInterval(timer);
                                        time = 180;
                                        flag = true;
                                    } else {
                                        $("#sendcode").text(time + " s 重发");
                                        time--;
                                    }
                                },
                                1000);
                        }
                    }
                });
            }
        }
    });
    $("#sendreg").click(function() {
        if ($("#Password").val().length < 6) {
            swal({
                text: "密码必须设置6位以上！",
                title: "出错啦",
                type: "error",
                confirmButtonText: "我再试试"
            });
            $('#Password').shake(2, 10, 400);
            throw SyntaxError();
        }
        if ($("#Password").val() !== $("#SPassword").val()) {
            swal({
                text: "两次输入的密码不一致，请检查！",
                title: "出错啦",
                type: "error",
                confirmButtonText: "我再试试"
            });
            $('#SPassword').shake(2, 10, 400);
            throw SyntaxError();
        }
        <?php if (get_set('captcha_send_type') == 1) : ?>
            if (!isMobile($("#account").val())) {
                swal({
                    text: "手机号格式有误，请检查！",
                    title: "出错啦",
                    type: "error",
                    confirmButtonText: "我再试试"
                });
                $('#phone').shake(2, 10, 400);
                throw SyntaxError();
            }
        <?php elseif (get_set('captcha_send_type') == 0) : ?>
            if (!isemail($("#account").val())) {
                swal({
                    text: "邮箱格式有误，请检查！",
                    title: "出错啦",
                    type: "error",
                    confirmButtonText: "我再试试"
                });
                $('#phone').shake(2, 10, 400);
                throw SyntaxError();
            }
        <?php endif; ?>
        <?php if (get_set('captcha_send_type') == 2) : ?>
            if (!isMobile($("#account").val()) && !isemail($("#account").val())) {
                swal({
                    text: "手机号或邮箱格式有误，请检查！",
                    title: "出错啦",
                    type: "error",
                    confirmButtonText: "我再试试"
                });
                $('#phone').shake(2, 10, 400);
                throw SyntaxError();
            }
        <?php endif; ?>
        <?php if (get_set('captcha_send_type') != 'off') : ?>
        if ($("#captcha").val().length != 6) {
            swal({
                text: "验证码输入错误！",
                title: "出错啦",
                type: "error",
                confirmButtonText: "我再试试"
            });
            $('#captcha').shake(2, 10, 400);
            throw SyntaxError();
        }
        <?php endif; ?>
        <?php if (get_set('captcha') == 'on') : ?>
            <?php if (get_set('captcha_type') == 1) : ?>
                var captcha = new TencentCaptcha('<?php echo get_set("tcloud_captcha_Appid"); ?>', function(res) {
                    if (res.ret === 0) {
                        get_reg(res);
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
                        get_reg(res);
                        captchaObj.reset()
                    }).onError(function() {
                        //err code
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
                        get_reg([result[0]]);
                    } else {
                        swal('验证码输入错误！', '', 'error');
                    }
                });
                $("#captcha_img").click(function() {
                    $(this).attr("src", "/user/captcha_img");
                });
            <?php endif; ?>
        <?php else : ?>
            get_reg();
        <?php endif; ?>

        function get_reg(res) {
            $("#sendreg").attr("disabled", true).css("pointer-events", "none");
            $("#sendreg").html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> '+"正在重设密码...");
            $.ajax({
                url: "./fpasswd",
                type: "POST",
                dataType: "json",
                data: {
                    type: "get_new_passwd",
                    account: $("#account").val(),
                    newpasswd: $("#Password").val(),
                    captcha: $("#captcha").val(),
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
                            captcha_code: res[0],
                        <?php endif; ?>
                    <?php endif; ?>
                },
                success: function(result) {
                    if (result.code != 200) {
                        swal({
                            text: result.msg,
                            title: "出错啦",
                            type: "error",
                            confirmButtonText: "我再试试"
                        });
                        $("#sendreg").attr("disabled", false).css("pointer-events", "auto");
                        $("#sendreg").html("找回密码");
                    } else if (result.code == 200) {
                        swal({
                            text: result.msg,
                            title: "重置密码成功",
                            type: "success",
                            confirmButtonText: "点击跳转",
                        }).then(function(value) {
                            if (value) {
                                window.location.href = './login';
                            }
                        });
                        $("#sendreg").attr("disabled",
                            false).css("pointer-events",
                            "auto");
                        $("#sendreg").html("找回密码");
                    }
                }
            });
        }
    });
</script>