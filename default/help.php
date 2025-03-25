<div class="theme-inner-banner">
    <div class="mohu help"></div>
    <div class="container">
        <h2 class="intro-title text-center">帮助中心</h2>
        <p class="text-center lg-mt-30">
            <?php echo $help_the; ?>
        </p>
        <ul class="page-breadcrumb style-none d-flex justify-content-center float-start">
            <li><a href="/">首页</a></li>
            <li><a href="javascript:;">帮助</a></li>
            <li class="current-page">帮助中心</li>
        </ul>
    </div>
    <img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
    <img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
</div>
<div class="faq-section-one mt-30 mb-50 lg-mt-10 lg-mb-50">
    <div class="container">
        <div class="row">
            <div class="col-xxl-10 col-xl-11 m-auto">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-8 order-lg-0">
                        <div class="service-sidebar md-mt-10">
                            <div class="service-category mb-40">
                                <ul class="style-none">
                                    <?php echo $type_list; ?>
                                </ul>
                            </div>
                            <div class="download-btn-group mb-50">
                                <a href="/type/all" class="d-flex tran3s mb-15">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    <span>产品中心</span>
                                </a>
                                <a href="/doc/" class="d-flex tran3s mb-15">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <span>接口文档</span>
                                </a>
                            </div>
                            <div class="sidebar-quote mb-50">
                                <ul class="style-none d-flex justify-content-center rating">
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                    <li><i class="bi bi-star-fill"></i></li>
                                </ul>
                                <p id="randtext"></p>
                                <div class="name">
                                    来自<span><a style="color: white;" href="https://api.tjit.net/user/doc?id=64" target="_blank">随机语录/随机一言API</a></span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-10 mt-4" data-aos="fade-left">
                        <h3 class="faq-title"><?php echo $helptible; ?></h3>
                        <div class="accordion accordion-style-one" id="accordionOne">
                            <?php foreach ($post_list as $value) : ?>
                                <div class="accordion-item">
                                    <div class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $value['id']; ?>" aria-expanded="false" aria-controls="collapseOne"><?php echo $value['post_title']; ?></button>
                                    </div>
                                    <div id="collapse<?php echo $value['id']; ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionOne">
                                        <div class="accordion-body">
                                            <p>
                                                <?php echo $value['post_content']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                    <div class="fancy-short-banner-five mt-30">
                        <div class="container">
                            <div class="bg-wrapper shadow">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 text-center text-lg-start aos-init aos-animate" data-aos="fade-right">
                                        <h3 class="pe-xxl-5 md-pb-20">没有找到你想要的产品？向我们提交需求。</h3>
                                    </div>
                                    <div class="col-lg-6 text-center text-lg-end aos-init aos-animate" data-aos="fade-left">
                                        <a target="_blank" href="/about/#message" class="msg-btn tran3s">提交需求</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $.get("https://api.tjit.net/api/randtext/get?key=1193755ae99702b0", function(res) {
        $("#randtext").html(res.data);
    });
</script>