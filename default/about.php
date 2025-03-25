<?php
$map = get_set('about_map');
$maparr = json_decode($map, true);
?>
<div class="theme-inner-banner space-fix-one">
    <div class="mohu about"></div>
    <div class="container">
        <h2 class="intro-title text-center">关于我们</h2>
        <p class="text-center lg-mt-30">
            <?php echo get_set('web_footer_slogan'); ?>
        </p>
        <ul class="page-breadcrumb style-none d-flex justify-content-center float-start">
            <li><a href="/">首页</a></li>
            <li class="current-page">关于我们</li>
        </ul>
    </div>
    <img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
    <img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
</div>
<div class="fancy-short-banner-four">
    <div class="container">
        <?php if (get_set('cloud_map_on') == 'on') : ?>
            <div class="alert alert-primary" role="alert">
                您的访问、API请求，都会在地图上留下痕迹；该数据只统计当日API请求数据，是以您的IP所在地请求到API服务器或者CDN节点的弧线，只统计独立IP用户，同一IP访问任何节点和服务器在24小时内只统计一次，数据不会重复，本页数据实时更新，真实有效。<br>温馨提示：左键点击拖动地图，右键点击拖动360°查看，滚轮放大缩小。
            </div>
            <div class="bg-wrapper d-flex align-items-center justify-content-center">
                <!--<iframe src="https://v.yuntus.com/tcv/cb3801941955790322dc1372428917b0" width="100%" height="100%" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowtransparency="yes" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true"></iframe>-->
                <script src="//map.qq.com/api/gljs?v=1.exp&key=ULGBZ-BP3KX-FGY4F-7URRZ-WSGNT-B7BWJ&libraries=visualization" type="text/javascript" charset="UTF-8"></script>
                <style>
                    #mapbody {
                        height: 100%;
                        width: 100%;
                        position: relative;
                        top: 0;
                        left: 0;
                    }
                </style>
                <div id="mapbody"></div>
                <script src="/map/api"></script>
                <script>
                    function initMap() {
                        //初始化地图
                        var map = new TMap.Map("mapbody", {
                            zoom: 5, //设置地图缩放级别
                            pitch: 35, //地图俯仰角度
                            rotation: 10, //地图在水平面上的旋转角度
                            center: new TMap.LatLng(35.3349, 106.3319), //设置地图中心点坐标
                            mapStyleId: "DARK", //个性化样式
                            renderOptions: {
                                enableBloom: true, // 泛光
                            },
                            baseMap: {
                                type: "vector",
                                //features: ["base", "building3d"], // 隐藏矢量文字
                            },
                        });

                        //初始化弧线图并添加至map图层
                        var arc = new TMap.visualization.Arc({
                                pickStyle: function(item) {
                                    //轨迹图样式映射函数
                                    var style;
                                    if (item.count < 100) {
                                        style = {
                                            width: 2,
                                            color: "rgba(230,129,28,0.1)",
                                            animateColor: "#FFCA1F",
                                        };
                                    } else {
                                        style = {
                                            width: 2,
                                            color: "rgba(1,124,247,0.1)",
                                            animateColor: "#1DFAF2",
                                        };
                                    }
                                    var stylearr = [{
                                            width: 2,
                                            color: "rgba(230,129,28,0.1)",
                                            animateColor: "#FFCA1F",
                                        },
                                        style = {
                                            width: 2,
                                            color: "rgba(1,124,247,0.1)",
                                            animateColor: "#1DFAF2",
                                        }
                                    ];
                                    var indexstyle = Math.floor((Math.random() * stylearr.length));
                                    return stylearr[indexstyle];
                                },
                                enableBloom: true,
                                //泛光
                                processAnimation: {
                                    duration: 2000,
                                    //动画时长
                                    tailFactor: 0.7,
                                    //尾迹比例
                                },
                                mode: "vertical",
                                // 弧线平面与地平面垂直,
                                selectOptions: {
                                    action: 'hover',
                                    style: {
                                        width: 4,
                                        color: "#1CD5FF",
                                        animateColor: "#A8EFFF"
                                    },
                                    enableHighlight: true
                                },
                            })
                            .addTo(map)
                            .setData(arcData); //设置数据

                        // 初始化辐射圈
                        var radiationCircle = new TMap.visualization.Radiation({
                                styles: {
                                    default: {
                                        fillColor: "rgba(0,0,0,0)",
                                        // 辐射圈填充颜色
                                        strokeColor: "#FFF",
                                        // 辐射圈边线颜色
                                        strokeWidth: 25536,
                                        //	区域边线宽度
                                    },
                                },
                                number: 2,
                                // 每一时刻，辐射圈的同心圆个数
                            })
                            .addTo(map)
                            .setData(radiationData);

                        //初始化散点图
                        var dot = new TMap.visualization.Dot({
                                styles: {
                                    default: {
                                        fillColor: "#FFF",
                                        //圆形填充颜色
                                        radius: 2,
                                        //圆形半径
                                    },
                                },
                                enableBloom: true,
                                // 泛光
                            })
                            .addTo(map)
                            .setData(dotData); //设置数据

                    }
                </script>
                <script type="text/javascript">
                    $(function() {
                        initMap();
                    });
                    var arr = [
                        "1358414746",
                        "1448106398",
                        "1448104758",
                        "28346647"
                    ];
                    var index = Math.floor((Math.random() * arr.length));
                    //document.write('<audio src="https://api.tjit.net/api/netease/?key=1193755ae99702b0&type=url&id=' + arr[index] + '" autoplay="autoplay" loop="loop"></audio>');
                </script>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="contact-section-one mt-50 mb-50 lg-mb-50" style="background: linear-gradient( #fff,#f5f6fa,#fff);">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="address-block-two text-center mb-40 sm-mb-20">
                    <div class="icon d-flex align-items-center justify-content-center m-auto">
                        <img src="/assets/Sinco/images/icon/icon_17.svg" alt="">
                    </div>
                    <h5 class="title border-0">我们的地址</h5>
                    <p>
                        <?php echo get_set('corporate_address'); ?> <br><?php echo get_set('corporate_name'); ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="address-block-two text-center mb-40 sm-mb-20">
                    <div class="icon d-flex align-items-center justify-content-center m-auto">
                        <img src="/assets/Sinco/images/icon/icon_18.svg" alt="">
                    </div>
                    <h5 class="title border-0">联系方式</h5>
                    <p>
                        打开链接或加我QQ为好友<br><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo get_set('web_index_qq'); ?>&site=qq&menu=yes" class="" target="_blank">联系QQ</a>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="address-block-two text-center mb-40 sm-mb-20">
                    <div class="icon d-flex align-items-center justify-content-center m-auto">
                        <img src="/assets/Sinco/images/icon/icon_19.svg" alt="">
                    </div>
                    <h5 class="title border-0">在线客服</h5>
                    <p>
                        与我们实时在线沟通 <br><a href="<?php echo get_set('web_index_im'); ?>" class="" target="_blank">在线咨询</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-100 lg-mt-70" id="message">
        <div class="container">
            <div class="row gx-xxl-5">
                <div class="col-lg-6 d-flex order-lg-last">
                    <div class="form-style-one">
                        <h3 class="mt-3 pb-40 lg-pb-20">联系我们</h3>
                        <form id="form" data-toggle="validator">
                            <div class="messages"></div>
                            <div class="row controls">
                                <div class="col-12">
                                    <div class="input-group-meta form-group mb-30">
                                        <label>您的称呼*</label>
                                        <input type="text" placeholder="您的称呼" name="name" required="required" data-error="请填写您的称呼.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="input-group-meta form-group mb-30">
                                        <label>您的邮箱*</label>
                                        <input type="email" placeholder="10001@qq.com" name="email" required="required" data-error="请填写您的邮箱.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="input-group-meta form-group mb-30">
                                        <textarea placeholder="简单阐述您的建议与反馈*" name="message" required="required" data-error="请填写您的建议."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn-eight ripple-btn" id="messagebtn">提 交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.form-style-one -->
                </div>

                <div class="col-lg-6 d-flex order-lg-first">
                    <div class="map-area-one mt-10 me-lg-4 md-mt-50">
                        <div class="mapouter">
                            <div class="gmap_canvas">
                                <div class="gmap_iframe" id="map"></div>
                                <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=i4FpotScPPqC0avdsQrmtlQo"></script>
                                <br />
                                <script type="text/javascript">
                                    var map = new BMap.Map("map");
                                    var point = new BMap.Point(<?php echo $maparr['lng']; ?>, <?php echo $maparr['lat']; ?>);
                                    map.centerAndZoom(point, 16);
                                    map.addControl(new BMap.NavigationControl());
                                    map.addControl(new BMap.ScaleControl());
                                    map.addControl(new BMap.OverviewMapControl());
                                    var marker = new BMap.Marker(point);
                                    map.addOverlay(marker);
                                    marker.setAnimation(BMAP_ANIMATION_BOUNCE);
                                    //var infoWindow = new BMap.InfoWindow(sContent);
                                    //marker.openInfoWindow(infoWindow);
                                    marker.addEventListener("click", function() {
                                        this.openInfoWindow(infoWindow);
                                        document.getElementById('imgDemo').onload = function() {
                                            infoWindow.redraw();
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <!-- /.map-area-one -->
                </div>
            </div>
        </div>
    </div>
    <div class="fancy-short-banner-five mt-50 lg-mt-30">
        <div class="container">
            <div class="bg-wrapper shadow">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center text-lg-start aos-init aos-animate" data-aos="fade-right">
                        <h3 class="pe-xxl-5 md-pb-20">没有找到你想要的产品？向我们提交需求。</h3>
                    </div>
                    <div class="col-lg-6 text-center text-lg-end aos-init aos-animate" data-aos="fade-left">
                        <a href="#message" class="msg-btn tran3s">提交需求</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/user/js/sweetalert2.3.3.8.pro.min.js"></script>
<?php if (get_set('captcha_type') == 1) : ?>
    <script src="https://turing.captcha.qcloud.com/TCaptcha.js"></script>
<?php elseif (get_set('captcha_type') == 2) : ?>
    <script src="//static.geetest.com/v4/gt4.js"></script>
<?php endif; ?>
<script>
    $("#messagebtn").click(function() {
        <?php if (get_set('captcha') == 'on') : ?>
            <?php if (get_set('captcha_type') == 1) : ?>
                var captcha = new TencentCaptcha('<?php echo get_set("tcloud_captcha_Appid"); ?>', function(res) {
                    if (res.ret === 0) {
                        send(res);
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
                        send(res);
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
                        send([result[0]]);
                    } else {
                        swal('验证码输入错误！', '', 'error');
                    }
                });
                $("#captcha_img").click(function() {
                    $(this).attr("src", "/user/captcha_img");
                });
            <?php endif; ?>
        <?php else : ?>
            send();
        <?php endif; ?>
    });

    function send(res = []) {
        document.getElementById("messagebtn").disabled = true;
        var pam = {};
        <?php if (get_set('captcha') == 'on') : ?>
            <?php if (get_set('captcha_type') == 1) : ?>
                var pam = {
                    ket: res.ticket,
                    rand: res.randstr
                };
            <?php elseif (get_set('captcha_type') == 2) : ?>
                var pam = {
                    lot_number: res.lot_number,
                    captcha_output: res.captcha_output,
                    pass_token: res.pass_token,
                    gen_time: res.gen_time
                }
            <?php elseif (get_set('captcha_type') == 0) : ?>
                var pam = {
                    captcha_code: res[0]
                }
            <?php endif; ?>
        <?php endif; ?>
        $.post('message',
            $("#form").serialize() + '&' + params(pam),
            function(res) {
                if (res.code == 200) {
                    swal({
                        text: res.msg,
                        title: "提交成功！",
                        type: "success",
                        confirmButtonText: "确 定"
                    });
                    $("#messagebtn").removeAttr("disabled");
                } else {
                    swal({
                        text: res.msg,
                        title: "提交失败！",
                        type: "error",
                        confirmButtonText: "我知道了"
                    });
                    $("#messagebtn").removeAttr("disabled");
                }
            });
    }

    function params(obj) {
        var query = '';
        $.each(obj,
            function(key, value) {
                query += encodeURIComponent(key) + '=' + encodeURIComponent(value) + '&';
            });
        return query.slice(0,
            -1);
    }
</script>