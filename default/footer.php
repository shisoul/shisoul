<?php if (!in_array(path, ['/user/login', '/user/register', '/user/forgot-password','/rtdd/'], true)) : ?>
    <div class="fancy-short-banner-three position-relative mt-0">
        <div class="container">
            <div class="bg-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-8 m-auto" data-aos="fade-up">
                        <div class="title-style-one text-center white-vr mb-30" data-aos="fade-up">
                            <h2 class="main-title">数据驱动未来</h2>
                        </div>
                        <?php if (isset($_SESSION['UID'])) : ?>
                            <a href="/user/" class="btn-six ripple-btn">前往控制台 <i class="fas fa-chevron-right"></i></a>
                        <?php else : ?>
                            <a href="/user/register" class="btn-six ripple-btn">立即注册 <i class="fas fa-chevron-right"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="footer-style-four theme-basic-footer">
    <div class="container">
        <div class="inner-wrapper">
            <div class="row">
                <div class="col-lg-3 footer-intro mb-40">
                    <div class="logo">
                        <a href="/"><img src="<?php echo get_set('template2_logo'); ?>" alt="<?php echo get_set('web_name'); ?>" title="<?php echo get_set('web_title'); ?>"></a>
                    </div>
                    <p>
                        <?php echo get_set('web_footer_slogan'); ?>
                    </p>
                </div>
                <div class="col-6 col-lg-2 col-sm-4 mb-30 ms-auto">
                    <h5 class="footer-title">开发者</h5>
                    <ul class="footer-nav-link style-none">
                        <li><a href="/doc/" target="_blank">接入文档</a></li>
                        <li><a href="/help/" target="_blank">常见问题</a></li>
                        <li><a href="/user/usercenter" target="_blank">个人中心</a></li>
                        <li><a href="/user/" target="_blank">数据报表</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 col-sm-4 mb-30">
                    <h5 class="footer-title">关于我们</h5>
                    <ul class="footer-nav-link style-none">
                        <li><a href="/about/">关于我们</a></li>
                        <li><a href="/blog/all">最新动态</a></li>
                        <li><a href="/about/#message">反馈建议</a></li>
                        <li><a href="/about/#message">联系我们</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2 col-sm-4 mb-30">
                    <h5 class="footer-title">法律法规</h5>
                    <ul class="footer-nav-link style-none">
                        <li><a href="/agreement/legal" target="_blank">服务条款</a></li>
                        <li><a href="/agreement/privacy" target="_blank">隐私政策</a></li>
                        <li><a href="/agreement/disclaimers" target="_blank">免责声明</a></li>
                        <li><a href="/agreement/copyright" target="_blank">侵权投诉</a></li>
                    </ul>
                </div>
                <div class="col-6 col-xl-2 col-lg-3 col-sm-4">
                    <h5 class="footer-title">快速入口</h5>
                    <ul class="footer-nav-link style-none">
                        <li><a href="/">网站首页</a></li>
                        <li><a href="/type/all">产品分类</a></li>
                        <li><a href="/user/" target="_blank">数据报表</a></li>
                        <li><a href="/user/key" target="_blank">密钥管理</a></li>
                    </ul>
                </div>
            </div>
            <div class="links mt-30">
                <span>友情链接：</span>
                <?php echo get_set('web_index_footer_links'); ?>
            </div>
            <div class="bottom-footer">
                <div class="d-lg-flex justify-content-between align-items-center">
                    <ul class="order-lg-1 pb-15 d-flex justify-content-center footer-nav style-none">
                        <?php if ($web_index_footer_icp = get_set('web_index_footer_icp')) : ?><li><a href="https://beian.miit.gov.cn" target="_blank" class="align-items-center d-flex"><img src="/assets/Sinco/images/icp.png"><?php echo $web_index_footer_icp; ?></a></li><?php endif; ?>
                        <?php if ($web_index_footer_beian = get_set('web_index_footer_beian')) : ?><li><a href="https://www.beian.gov.cn" target="_blank" class="align-items-center d-flex"><img src="/assets/Sinco/images/beian.png"><?php echo $web_index_footer_beian; ?></a></li><?php endif; ?>
                        <?php if (get_set('api_Copyright') == 'on') : ?><li><a href="https://www.apiecho.com" target="_blank">API管理系统企业版</a></li><?php endif; ?>
                        <li><a href="/sitemap.xml" target="_blank">sitemap</a></li>
                        <?php if (in_array(get_set('web_rtdd_on'), ['on_no_border', 'on']) && strpos(get_set('web_rtdd_show'),'footer') !== false) : ?>
                        <li><a href="/rtdd/" target="_blank"><i class="fas fa-fw fa-chart-line fa-sm"></i> 实时请求数据大屏</a></li>
                        <?php endif; ?>
                        <li><a href="/status" target="_blank"><span class="spinner-grow spinner-grow-sm text-success" role="status" aria-hidden="true"></span> 系统状态</a></li>
                    </ul>
                    <p class="copyright text-center order-lg-0 pb-15">
                        Copyright © <?php echo date('Y'); ?> <a href="/" target="_blank"><?php echo get_set('web_name'); ?></a> All Rights Reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="tb-contacts contacts-right_b">
    <?php if (get_set('web_index_weixin_on') == 'on') : ?>
        <div class="contact-item tb-rds" data-event="toggle_f_contact">
            <p class="ct-info"><span class="tbfa fab fa-weixin"></span>客服微信</p>
            <div class="contact-tooltip tb-rds">
                <p class="ct-info"><?php echo get_set('web_index_weixin'); ?></p>
                <p class="ct-desc">请打开手机微信，扫一扫联系我们</p><img src="<?php echo get_set('web_index_weixin_img'); ?>">
            </div>
        </div>
    <?php endif; ?>
    <?php if (get_set('web_index_qq_on') == 'on') : ?>
        <div class="contact-item tb-rds" data-event="toggle_f_contact"><a target="_blank" class="ct-info" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo get_set('web_index_qq'); ?>&site=qq&menu=yes"><span class="tbfa fab fa-qq"></span>客服QQ</a>
            <div class="contact-tooltip tb-rds"><a target="_blank" class="ct-info" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo get_set('web_index_qq'); ?>&site=qq&menu=yes"><?php echo get_set('web_index_qq'); ?></a>
                <p class="ct-desc">商务号，添加请说明来意</p>
            </div>
        </div>
    <?php endif; ?>
    <?php if (get_set('web_index_im_on') == 'on') : ?>
        <div class="contact-item tb-rds" data-event="toggle_f_contact"><a target="_blank" class="ct-info" href="<?php echo get_set('web_index_im'); ?>"><span class="tbfa fas fa-headset"></span>在线咨询</a>
            <div class="contact-tooltip tb-rds">
                <a target="_blank" class="ct-info" href="<?php echo get_set('web_index_im'); ?>">点击咨询</a>
                <p class="ct-desc">工作时间：8:00-24:00</p>
            </div>
        </div>
    <?php endif; ?>
    <div class="contact-item tb-rds scroll-top">
        <p class="ct-info"><span class="tbfa bi bi-chevron-double-up"></span>返回顶部</p>
    </div>
</div>
<script src="/assets/Sinco/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/Sinco/vendor/aos-next/dist/aos.js"></script>
<script src="/assets/Sinco/vendor/slick/slick.min.js"></script>
<script src="/assets/Sinco/vendor/jquery.counterup.min.js"></script>
<script src="/assets/Sinco/vendor/jquery.waypoints.min.js"></script>
<script src="/assets/Sinco/vendor/fancybox/dist/jquery.fancybox.min.js"></script>
<script src="/assets/Sinco/vendor/skills-master/jquery.skills.js"></script>
<script src="/assets/Sinco/js/theme.js"></script>
<?php echo $bottom_stats_code; ?>

</body>

</html>