<?php
if (!in_array(get_set('web_rtdd_on'), ['on_no_border', 'on'])) {
    httpStatus(404);
    exit;
}
$number = trim(get_set('web_rtdd_sum')) ?: 100;
$pagesum = round($number / 20);
?>
<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <link rel="dns-prefetch" href="<?php echo $web_url; ?>">
    <meta name="keywords" content="<?php echo $web_keywords; ?>">
    <meta name="description" content="<?php echo $web_description; ?>">
    <meta property="og:site_name" content="<?php echo $web_title; ?>">
    <meta property="og:url" content="<?php echo $web_url; ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $web_title; ?>">
    <meta name='og:image' content='<?php echo $web_favicon; ?>'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta name="theme-color" content="#1E78FF">
    <meta name="msapplication-navbutton-color" content="#1E78FF">
    <meta name="apple-mobile-web-app-status-bar-style" content="#1E78FF">
    <title><?php echo '实时请求数据大屏-' . $web_title; ?></title>
    <link rel="icon" type="image/png" sizes="56x56" href="<?php echo $web_favicon; ?>">
    <link href="/user/css/pace.css" rel="stylesheet" type="text/css">
    <script src="/user/js/pace.min.js"></script>
    <!--[if lt IE 9]>
			<script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
			<script src="/assets/Sinco/vendor/html5shiv.js"></script>
			<script src="/assets/Sinco/vendor/respond.js"></script>
		<![endif]-->
    <style>
        <?php echo $web_head_css; ?>
    </style>
    <script>
        if (window.innerWidth < 1400) {
            alert('当前页面暂不支持小屏幕设备访问，请用PC端浏览器最大化访问！');
            window.history.back();
        }
    </script>
</head>

<body>

    <link rel="stylesheet" type="text/css" href="css/monitor.css" />
    <span id="bugBtn" title="同步过程出现错误数据，请检查" onclick="hideBugBtn('')"></span>
    <span id="localtime" style=" font-size:14px; position: absolute; z-index: 10; right: 25px; top:15px; "></span>
    <button class="btn-outline-primary" id="refreshBtn" title="默认 10秒 自动刷新一次" style="padding:revert">刷新</button>
    <div style="height: 620px;">
        <header class="t_header">
            <span>实时请求数据大屏</span>
        </header>
        <div style="margin-top: 20px;">
            <div class="t_left_box">
                <img class="t_l_line" src="images/left_line.png" alt="">
                <div class="t_mbox">
                    <div>实时请求数</div>
                    <span id="real"></span>
                    <i></i>
                </div>
                <div class="t_mbox">
                    <div>今日请求数</div>
                    <span id="days"></span>
                    <i></i>
                </div>
                <div class="t_mbox">
                    <div>历史请求数</div>
                    <span id="cum"></span>
                    <i></i>
                </div>
                <div class="t_mbox">
                    <div>系统平均负载</div>
                    <span id="io"></span>
                </div>
                <img class="t_r_line" src="images/right_line.png" alt="">
            </div>
            <div class="t_top_box">
                <img class="t_l_line" src="images/left_line.png" alt="">
                <ul class="t_nav">
                    <li>
                        <span>当前在线</span>
                        <span id="online"></span>
                        <i></i>
                    </li>
                    <li>
                        <span>今日独立IP</span>
                        <span id="daysip"></span>
                        <i></i>
                    </li>
                    <li>
                        <span>今日请求成功数</span>
                        <span id="daysuccess"></span>
                    </li>
                </ul>
                <img class="t_r_line" src="images/right_line.png" alt="">
            </div>
            <div class="t_top2_box">
                <img class="t_l_line" src="images/left_line.png" alt="">
                <ul class="t_nav">
                    <li>
                        <span>今日请求失败数</span>
                        <span id="dayerror"></span>
                        <i></i>
                    </li>
                    <li>
                        <span>今日成功响应率</span>
                        <span id="daysuccessrate"></span>
                        <i></i>
                    </li>
                    <li>
                        <span>平均响应耗时(毫秒)</span>
                        <span id="averagetime"></span>
                    </li>
                </ul>
                <img class="t_r_line" src="images/right_line.png" alt="">
            </div>
            <div class="t_bottom_box">
                <img class="t_l_line" src="images/left_line.png" alt="">
                <div class="chart" id="taskSize" style="width: 100%; height:100%;" style="width: 600px;height:400px;"></div>
                <img class="t_r_line" src="images/right_line.png" alt="">
            </div>
        </div>
    </div>
    <div class="t_table_box" style="height: 680px;margin-bottom:100px;">
        <img class="t_l_line" src="images/left_line.png" alt="">
        <h4 style="top:30px;position: absolute;color: #0e94ea;left: 3%;">最近请求数据（默认 10秒 自动刷新一次）</h4>
        <input type="text" id="searchText" value="" placeholder="输入内容筛选" style="float: right;position: relative;margin-right: 5%;" />
        <table class="commonTable">
            <thead>
                <td title="序号" colspan="8">数据加载中...</td>
            </thead>
        </table>
        <span style="color:#0e94ea">当前第 <span id="page"></span> 页，共 <span id="pagesum"><?php echo $pagesum; ?></span> 页 <?php echo $number; ?> 条数据</span>
        <button type="button" class="btn-outline-primary" id="prevBtn" style="margin-left: 20px;">上一页</button>
        <button type="button" class="btn-outline-primary" id="nextBtn" style="margin-left: 10px;">下一页</button>
        <img class="t_r_line" src="images/right_line.png" alt="">
    </div>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/rtdd/js/echarts.min.js"></script>
    <script type="text/javascript" src="js/jquery.count.min.js"></script>
    <script type="text/javascript">
        var myChart = echarts.init(document.getElementById('taskSize'));
        var real_start = 0;
        var days_start = 0;
        var cum_start = 0;
        var tabledata;
        var page = 1;
        var pagesize = 20;
        $(function() {
            $('input').bind('input propertychange', function() {
                $('.commonTable tbody tr').hide()
                    .filter(":contains('" + ($(this).val()) + "')").show();
            });

            $("#refreshBtn").click(function() {
                initTable();
            });
            initTable();
            tick();
            sysdata();
            setInterval(initTable, 1000 * 10); //折线图和最近请求数据表格
            setInterval(tick, 1000); //日期时间每秒显示
            setInterval(sysdata, 2000); //请求数据定时执行
        });

        function sysdata() {
            $.getJSON('/ytu.api?type=rtdd&rtdd=real,days,io,online,daysip,cum,daysuccess,dayerror', function(res) {
            console.log(real_start,days_start,cum_start);
                if (real_start != res.data.real) {
                    $('#real').numberRockInt({
                        initNumber: real_start,
                        lastNumber: res.data.real, // 最终数字
                        duration: 200, // 动画持续时间（毫秒）
                        easing: 'swing' // 缓动效果
                    });
                }
                if (days_start != res.data.days) {
                    $('#days').numberRockInt({
                        initNumber: days_start,
                        lastNumber: res.data.days, // 最终数字
                        duration: 200, // 动画持续时间（毫秒）
                        easing: 'swing' // 缓动效果
                    });
                }
                if (cum_start != res.data.cum) {
                    $('#cum').numberRockInt({
                        initNumber: cum_start,
                        lastNumber: res.data.cum, // 最终数字
                        duration: 200, // 动画持续时间（毫秒）
                        easing: 'swing' // 缓动效果
                    });
                }
                real_start = res.data.real;
                days_start = res.data.days;
                cum_start = res.data.cum;

                $("#io").html(res.data.io + " %");
                $("#online").html(res.data.online);
                $("#daysip").html(res.data.daysip);
                $("#daysuccess").html(res.data.daysuccess);
                $("#dayerror").html(res.data.dayerror);
            });
        }

        function tick() {
            var today = new Date();
            document.getElementById("localtime").innerHTML = showLocale(today);
        }

        function initTable() {
            var names = [];
            var values = [];
            var option = {
                color: ['#0e94ea'],
                legend: {
                    x: 'center',
                    y: 20,
                    textStyle: {
                        color: '#0e94ea', //更改坐标轴文字颜色
                        fontSize: 14 //更改坐标轴文字大小
                    },
                },
                title: {
                    text: '今日请求数时段统计', // 设置主标题内容  
                    textStyle: {
                        color: '#0e94ea', //更改坐标轴文字颜色
                        fontSize: 14 //更改坐标轴文字大小
                    },
                    x: 20,
                    y: 10,
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'shadow'
                    }
                },
                xAxis: [{
                    data: names,
                    type: 'category',
                    splitLine: {
                        show: true,
                        lineStyle: {
                            color: '#0d6efd60', // 设置网格线颜色  
                            type: 'solid' // 设置网格线类型，可选值为 'solid', 'dashed', 'dotted'  
                        }
                    },
                    axisLabel: {
                        interval: 0,
                        show: true,
                        textStyle: {
                            color: '#0e94ea', //更改坐标轴文字颜色
                            fontSize: 14 //更改坐标轴文字大小
                        },
                    },
                    axisLine: { // X 轴线条样式
                        lineStyle: {
                            color: '#0d6efd60' // 修改底部横线的颜色为红色
                        }
                    }
                }],
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        show: true,
                        textStyle: {
                            color: '#0e94ea'
                        },
                    },
                    splitLine: {
                        show: true, // 显示网格线  
                        lineStyle: {
                            color: '#0d6efd60', // 设置网格线颜色  
                            type: 'solid' // 设置网格线类型  
                        }
                    }
                }],
                series: [{
                    name: '请求数(次)',
                    type: 'line',
                    smooth: true,
                    barWidth: '60%',
                    data: values
                }]
            };
            $.getJSON('/ytu.api?type=rtdd&rtdd=timestatistics,dayerror,daysuccess,daysuccessrate,averagetime,toplsit', function(res) {
                $("#daysuccessrate").html(res.data.daysuccessrate + " %");
                $("#averagetime").html(res.data.averagetime * 1000);
                $.each(res.data.timestatistics, function(name, value) {
                    names.push(name);
                    values.push(value);
                });
                option.xAxis[0].data.value = names;
                option.series[0].data.value = values;
                myChart.setOption(option);
                tabledata = res.data.toplsit
                taskSizeTj(tabledata, page, pagesize);
            });

        }

        function timestampToTime(timestamp) {
            // 创建一个 Date 对象，传入时间戳（秒）
            var date = new Date(timestamp * 1000);

            // 获取年、月、日、小时、分钟、秒
            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);
            var hours = ('0' + date.getHours()).slice(-2);
            var minutes = ('0' + date.getMinutes()).slice(-2);
            var seconds = ('0' + date.getSeconds()).slice(-2);

            // 拼接日期时间字符串，格式为 Y-m-d H:i:s
            var datetime = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;

            return datetime;
        }

        function taskSizeTj(data, page = 1, pagesize = 20) {
            $("#page").html(page);
            var HTML = "<thead>\n" +
                "        <td title=\"序号\">序号</td>\n" +
                "        <td title=\"时间\">时间</td>\n" +
                "        <td title=\"客户端IP\">客户端IP</td>\n" +
                "        <td title=\"请求接口\">请求接口</td>\n" +
                "        <td title=\"协议\">协议</td>\n" +
                "        <td title=\"来源城市\">来源城市</td>\n" +
                "        <td title=\"运营商\">运营商</td>\n" +
                "        <td title=\"状态码\">状态码</td>\n" +
                "        <td title=\"耗时\">耗时</td>\n" +
                "        </thead>\n" +
                "        <tbody>\n";
            data = displayPage(data, page, pagesize);
            $.each(data, function(index, ele) {
                var Methodcolor = ele.Method == 'GET' ? '00cc00' : 'ffc107';
                var http_status_codecolor = ele.http_status_code == 200 ? '00cc00' : 'ffc107';
                HTML += "<tr>\n" +
                    "            <td>" + ele.id + "</td>\n" +
                    "            <td>" + timestampToTime(ele.time) + "</td>\n" +
                    "            <td>" + ele.uip + "</td>\n" +
                    "            <td>" + ele.path + "</td>\n" +
                    "            <td><span style='color: #" + Methodcolor + "'>" + ele.Method + "</span></td>\n" +
                    "            <td>" + ele.from_name + "</td>\n" +
                    "            <td>" + ele.isp + "</td>\n" +
                    "            <td><span style='color: #" + http_status_codecolor + "'>" + ele.http_status_code + "</span></td>\n" +
                    "            <td><span style='color: #00cc00;'>" + ele.exec_time + "</span></td>\n";
            });
            HTML += "</tbody>";
            $('.commonTable').html(HTML);

            $('.commonTable tbody tr').hide().filter(":contains('" + ($("#searchText").val()) + "')").show();
        }
        $("#nextBtn").click(function() {
            if (page == <?php echo $pagesum; ?>) {
                alert('当前仅展示<?php echo $pagesum; ?>页(<?php echo $number; ?>条)数据');
            } else {
                page = page + 1;
                taskSizeTj(tabledata, page, pagesize);
                console.log(page);
            }
        });
        $("#prevBtn").click(function() {
            if (page == 1) {
                alert('已经是第一页了');
            } else {
                page = page - 1;
                taskSizeTj(tabledata, page, pagesize);
                console.log(page);
            }
        });
        // 显示指定页的数据
        function displayPage(data, page, pageSize) {
            var startIndex = (page - 1) * pageSize;
            var endIndex = Math.min(startIndex + pageSize, data.length);
            return data.slice(startIndex, endIndex);
        }

        function showLocale(objD) {
            var str, colorhead, colorfoot;
            var yy = objD.getYear();
            if (yy < 1900) yy = yy + 1900;
            var MM = objD.getMonth() + 1;
            if (MM < 10) MM = '0' + MM;
            var dd = objD.getDate();
            if (dd < 10) dd = '0' + dd;
            var hh = objD.getHours();
            if (hh < 10) hh = '0' + hh;
            var mm = objD.getMinutes();
            if (mm < 10) mm = '0' + mm;
            var ss = objD.getSeconds();
            if (ss < 10) ss = '0' + ss;
            var ww = objD.getDay();
            if (ww == 0) colorhead = "<font color=\"#ffffff\">";
            if (ww > 0 && ww < 6) colorhead = "<font color=\"#ffffff\">";
            if (ww == 6) colorhead = "<font color=\"#ffffff\">";
            if (ww == 0) ww = "星期日";
            if (ww == 1) ww = "星期一";
            if (ww == 2) ww = "星期二";
            if (ww == 3) ww = "星期三";
            if (ww == 4) ww = "星期四";
            if (ww == 5) ww = "星期五";
            if (ww == 6) ww = "星期六";
            colorfoot = "</font>"
            str = colorhead + yy + "-" + MM + "-" + dd + " " + hh + ":" + mm + ":" + ss + "  " + ww + colorfoot;
            return (str);
        }

        function hideBugBtn() {
            $("#bugBtn").hide();
        }
    </script>
    <?php echo $bottom_stats_code; ?>

</body>

</html>