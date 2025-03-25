<?php
$web_date = filemtime(root_path.'/inc/install');
?>
<div class="theme-inner-banner">
    <div class="mohu"></div>
    <div class="container">
        <h2 class="intro-title text-center">免责声明</h2>
        <p class="text-center lg-mt-30">
            <?php echo $typethe; ?>
        </p>
        <ul class="page-breadcrumb style-none d-flex justify-content-center float-start">
            <li><a href="/">首页</a></li>
            <li class="current-page">免责声明</li>
        </ul>
    </div>
    <img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
    <img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
</div>
<div class="blog-section-four pt-30 lg-mt-0 pb-70 lg-pb-50">
    <div class="container">
        <div class="title" style="font-size: 20px;padding-bottom:10px;text-align: center;">
            免责声明
        </div>
        <div class="line"></div>
        <div class="linestyle" style="text-align: right">
            更新及生效时间：<?php echo date("Y年m月d日", $web_date); ?>
        </div>
        <div class="linestyle">
            <b>&nbsp;&nbsp;&nbsp;&nbsp;本免责声明规定了<?php echo $web_name; ?>特定情形下不承担责任的内容，与用户权益息息相关，用户应仔细、逐项阅读。若用户不同意本免责声明的内容，应停止注册或停止使用<?php echo $web_name; ?>服务并注销<?php echo $web_name; ?>账户。用户完成注册程序并使用<?php echo $web_name; ?>的服务，视为用户已经完全知悉、理解本免责声明对其权利、义务、责任的特别约定，并同意接受该等约定，豁免<?php echo $web_name; ?>的相应责任。</b>
        </div>

        <div class="linestyle">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（1）<?php echo $web_name; ?>可能会对产品使用情况进行统计。同时，<?php echo $web_name; ?>可能会与公众分享这些统计信息，以展示<?php echo $web_name; ?>服务的整体使用趋势。这些统计信息不包含用户的任何身份识别信息。
        </div>

        <div class="linestyle">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（2）除本服务条款另有规定或<?php echo $web_name; ?>与您就某一具体产品服务另有约定外，在任何情况下，您同意<?php echo $web_name; ?>对本服务条款所承担的赔偿责任总额不超过向您收取的当次服务费用总额。
        </div>

        <div class="linestyle">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（3）<?php echo $web_name; ?>对于与本服务条款有关或由本服务条款引起的任何间接的、惩罚性的、特殊的、派生的损失（包括业务损失、收益损失、利润损失、使用数据、商誉或其他经济利益的损失），不论是如何产生的，也不论是由对本服务条款的违约（包括违反保证）还是由侵权造成的，仅在律法规所规定应由<?php echo $web_name; ?>承担的范围内承担责任。
        </div>

        <div class="linestyle">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（4）若由于第三方原因（包括但不限于第三方盗用账户、破坏计算机系统、应用软件的终端用户误操作等）而产生的纠纷或损失，均与<?php echo $web_name; ?>无关；在此情形下，<?php echo $web_name; ?>可以协助配合用户查明原因以妥善解决，但不视为任何保证、承诺、应允。
        </div>
        <div class="linestyle">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;（5）非因<?php echo $web_name; ?>的过错而引起的任何损失，<?php echo $web_name; ?>不承担责任。
        </div>
    </div>
</div>
<style>
    .line {
        width: 100%;
        margin-top: 5px;
        border-bottom: 2px solid #00c6ff;
    }

    .container {
        font-size: 14px;
    }

    .linestyle {
        width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .content-title {
        font-size: 18px;
        line-height: 40px;
        color: #00c6ff;
        margin-top: 20px;
        border-bottom: 1px solid #f2f2f2;
    }
</style>