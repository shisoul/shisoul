<?php
$apilist = get_api_list();
$ifstate = false;
?>
<div class="theme-inner-banner">
    <div class="mohu help"></div>
    <div class="container">
        <h2 class="intro-title text-center">系统状态</h2>
        <p class="text-center lg-mt-30">
            通过该页面实时监控各 API 接口、DEMO 以及基础数据服务状态。
        </p>
        <ul class="page-breadcrumb style-none d-flex justify-content-center float-start">
            <li><a href="/">首页</a></li>
            <li class="current-page">系统状态</li>
        </ul>
    </div>
    <img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
    <img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
</div>
<div class="container" style="min-height: 300px;">
    <div class="d-flex justify-content-end position-relative" style="line-height: 1;top: -28px;z-index: 2;">
        <span class="fw-normal text-dark d-none d-md-block" id="time"></span>
        <label class="text-success ms-3"><i class="fas fa-check-circle me-1 fa-sm"></i> 正常</label>
        <label class="text-danger ms-2"><i class="fas fa-times-circle me-1 fa-sm"></i> 维护中</label>
    </div>
    <div class="alert alert-success mb-3 bg-success" id="state">所有接口运行正常</div>
    <div class="dp-status__monitor-box">
        <table class="table table-borderless table-hover table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">接口名称</th>
                    <th scope="col">状态</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($apilist as $keye => $value) : ?>
                    <?php if (!$value['state']) $ifstate = true; ?>
                    <?php if ($value['show'] == 1) : ?>
                        <tr>
                            <th scope="row"><?php echo $value['id']; ?></th>
                            <td><a class="text-reset dashed-underline" target="_blank" href="/doc/<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
                            <!--<td style="min-width: 100px;" data-id="<?php echo $value['id']; ?>" data-td="state" class="text-muted"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 加载中</td>-->
                            <td style="min-width: 100px;"><?php echo $value['state'] ? '<label class="text-success ms-2"><i class="fas fa-check-circle me-1 fa-sm"></i> 正常</label>' : '<label class="text-danger ms-2"><i class="fas fa-times-circle me-1 fa-sm"></i> 维护中</label>'; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="mb-5 position-relative" id="bottom-body" style="height: 100px;"></div>
<style>
    .help::before {
        background-image: url(/assets/Sinco/images/banner4.jpg);
        filter: blur(3px);
        /*顶部背景图高斯模糊程度*/
        -webkit-filter: blur(3px);
        /*顶部背景图高斯模糊程度*/
    }

    .spinner-grow {
        -webkit-animation: 1.25s linear infinite spinner-grow;
        /*状态图标动态速度。越低越快*/
        animation: 1.25s linear infinite spinner-grow;
        /*状态图标动态速度。越低越快*/
    }

    .bg-success {
        background-color: #00C878 !important;
        border: 1px solid #00C878;
        border-radius: 4px;
        padding: 25px 40px;
        font-size: 22px;
        color: #fff;
    }

    .dp-status__monitor-box {
        border: 1px solid #E6E9EE;
        border-radius: 4px;
    }

    .dashed-underline {
        border-bottom: 1px dashed;
        /* 可选：自定义虚线颜色 */
        border-bottom-color: #6666;
    }
</style>
<script>
    <?php if ($ifstate) : ?>
        $("#state").hide();
    <?php endif; ?>
    displayDateTime();

    function displayDateTime() {
        let now = new Date();
        let year = now.getFullYear();
        let month = String(now.getMonth() + 1).padStart(2, '0');
        let day = String(now.getDate()).padStart(2, '0');
        let hours = String(now.getHours()).padStart(2, '0');
        let minutes = String(now.getMinutes()).padStart(2, '0');
        let seconds = String(now.getSeconds()).padStart(2, '0');
        let dateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        const datetimeElement = document.getElementById("time");
        datetimeElement.innerHTML = `实时监控时间：${dateTime}`;
        console.log(dateTime);
    }
    setInterval(displayDateTime, 1000);
</script>