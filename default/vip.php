<link href="/user/css/aq.css" rel="stylesheet" type="text/css">
<link href="/user/css/pay.css" rel="stylesheet" type="text/css">
<div class="theme-inner-banner">
	<div class="mohu vip"></div>
	<div class="container">
		<h2 class="intro-title text-center"><i class="fab fa-vimeo-v text-danger"></i> <?php echo get_set('allvip_name'); ?></h2>
		<p class="text-center lg-mt-30">
			<?php echo get_set('allvip_name'); ?>可免费使用<?php echo get_set('allvip_name'); ?>类接口、API私有化部署、高效QPS、专属数据块等免费使用特权及附属权益。
		</p>
		<ul class="page-breadcrumb style-none d-flex justify-content-center float-start">
			<li><a href="/">首页</a></li>
			<li><a href="javascript:;">产品</a></li>
			<li class="current-page"><i class="fab fa-vimeo-v text-danger"></i> <?php echo get_set('allvip_name'); ?></li>
		</ul>
	</div>
	<img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
	<img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
</div>
<div class="pricing-section-two position-relative mt-150 mb-50 lg-mt-80 lg-mb-50">
	<div class="container">
		<div class="row align-items-center mb-100">
			<div class="col-xl-7 col-lg-6 col-md-8 m-auto">
				<div class="title-style-one text-center mb-20" data-aos="fade-up">
					<div class="sc-title-five" style="color: #f96868;background-color:rgb(249 104 104 / 10%)"><i class="fab fa-vimeo-v text-danger"></i> <?php echo get_set('allvip_name'); ?>权益对比</div>
					<h2 class="main-title">开通<?php echo get_set('allvip_name'); ?>，数据无限使用</h2>
				</div>
			</div>
		</div>
		<div class="pricing-table-area-two">
			<div class="row">
				<div class="col-xxl-10 m-auto">
					<div class="row justify-content-center">
						<div class="wrap">
							<ul class="unstyled clearfix m-pack">
								<li class="c_bd trans shadow">
									<div class="s_th trans">
										<div class="s_a">
											<strong><span class="vip-icon" style="font-size: inherit;background-image: linear-gradient(180deg, #f96868 10%, #e74a3b 100%);color: #ffffff;"><i class="fab fa-vimeo-v me-1" style="font-size: 1.35rem;margin-top: -3.5px;"></i><?php echo get_set('allvip_name'); ?></span></strong>
										</div>
										<div class="s_c">
											<strong><?php echo round(get_set('vip_month_price')) ?>元/月</strong>
											<small>每天约5毛</small>
											<del>原价：999元/年</del>
											<span class="badge badge-warning" style="color: #fff;background-color: #ff6f00 !important;font-size: 9px;">
												年付<?php echo round(get_set('vip_year_price')) ?>元/年,优惠2个月</span>
										</div>
										<div class="s_d">
											<?php if (isset($_SESSION['UID'])) : ?>
												<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#vip-pay" class="bt-1 trans"><?php echo ($userarr['group'] == 2) ? '点击续费' : '立即开通' ?></a>
											<?php else : ?>
												<a href="/user/login?url=/user/vip" class="bt-1 trans">登陆后开通</a>
											<?php endif; ?>
										</div>
										<div class="sale-box"><span class="on_sale title_shop">特惠</span></div>
									</div>
									<?php echo get_set('vip_info_html'); ?>

								</li>
								<li class="c_bd trans shadow">
									<div class="s_th trans">
										<div class="s_a">
											<strong><span class="bg-gradient-success" style="background-color: #1cc88a;background-size: cover;display: inline;padding: .3em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;">标准用户</span></strong>
										</div>
										<div class="s_c">
											<strong>限时免费</strong>
											<small>每天0元</small>
											<del>原价：99元/年</del>
										</div>
										<div class="s_d">
											<a title="默认" href="javascript:void(0);" class="bt-1 trans">系统默认</a>
										</div>
									</div>
									<?php echo get_set('user_info_html'); ?>

								</li>
								<li class="c_bd trans shadow">
									<div class="s_th trans">
										<div class="s_a">
											<strong><span class="bg-gradient-warning" style="background-color: #f6c23e;background-size: cover;display: inline;padding: .3em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: .25em;">定制版用户</span></strong>
										</div>
										<div class="s_c">
											<strong>***元/年</strong>
											<strong style="font-size: 80%;">**元/月</strong>
											<small>按需定制</small>
											<del>原价：999元/年</del>
										</div>
										<div class="s_d">
											<a title="联系定制" target="_blank" href="<?php echo get_set('web_index_im'); ?>" class="bt-1 trans">联系定制</a>
										</div>
									</div>
									<?php echo get_set('svip_info_html'); ?>
								</li>
							</ul>
							<style>
								.text-gray-600 {
									color: #858796;
								}

								.badge-secondary {
									color: #fff;
									background-color: #858796;
								}

								.m-pack .s_a {
									margin-bottom: 15px;
								}

								.m-pack .s_th {
									height: 215px;
								}

								img {
									margin: auto;
								}
							</style>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xxl-5 col-xl-6 col-lg-7 m-auto">
					<p class="info mt-75 lg-mt-50" data-aos="fade-up">注：<?php echo get_set('allvip_name'); ?>一经购买，概不退款。<?php echo get_set('allvip_name'); ?>权益如未使用，逾期作废。<?php echo get_set('allvip_name'); ?>指标注<?php echo get_set('allvip_name'); ?>免费的产品，不支持<?php echo get_set('allvip_name'); ?>的产品无法免费。
						<?php if (get_set('vip_type_show') == 'on') : ?>
							<a class="badge badge-danger link-danger fs-6 px-3 py-2 mt-3" style="padding-top: .5rem!important;padding-bottom: .5rem!important;padding-right: 1rem!important;padding-left: 1rem!important;" href="/type/vip" target="_blank">前往<?php echo get_set('allvip_name'); ?>专区</a>
					</p>
				<?php endif; ?>
				</div>
			</div>
			<div class="fancy-short-banner-five mt-50">
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
	<img src="/assets/Sinco/images/shape/shape_34.svg" alt="" class="shapes shape-one">
</div>
<div class="modal fade" id="vip-pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
		<div class="modal-content border-0 shadow-lg">
			<div class="modal-header">
				<h6 class="modal-title" id="exampleModalLabel"><i class="fab fa-vimeo mr-2 text-danger" style="font-size: 1.3rem;margin-top: -5px;"></i> <?php echo ($userarr['group'] == 2) ? '续费' . get_set('allvip_name') : '开通' . get_set('allvip_name'); ?></h6>
				<button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<p class="mb-3">
					<span class="vip-icon" title="<?php echo get_set('allvip_name'); ?>"><i class="fab fa-vimeo-v me-1"></i><?php echo get_set('allvip_name'); ?></span>
				</p>

				<p class="mb-3">
					选择<?php echo ($userarr['group'] == 2) ? '续费' : '开通' ?>时长：
				</p>
				<div class="goods_box_xz">
					<div id="month" class="goods_box_leng goods_box_leng_xz shadow border-warning">
						<div>永久<?php echo get_set('allvip_name'); ?> <span class="badge badge-warning">限时特惠</span></div>
						<div style="margin-top: 13px;"><span>￥</span><?php echo round(get_set('vip_svip_price')) ?></div>
						<div>内测折扣价</div><img id="svipxz" src="/user/img/xz.png">
					</div>
					<div id="month" class="goods_box_leng">
						<div>一年（12个月）<span class="badge badge-danger">折扣</span></div>
						<div style="margin-top: 13px;"><span>￥</span><?php echo round(get_set('vip_year_price')) ?></div>
						<div>年付优惠</div><img id="yearxz" style="display: none;" src="/user/img/xz.png">
					</div>
					<div id="month" class="goods_box_leng">
						<div>一个月 <span class="badge badge-danger">热门</span></div>
						<div style="margin-top: 13px;"><span>￥</span><?php echo round(get_set('vip_month_price')) ?></div>
						<div>经济实惠</div><img id="monthxz" style="display: none;" src="/user/img/xz.png">
					</div>
				</div>
			</div>
			<div class="modal-footer" style="display: inline;">
				<span style="float:right;">
					<input class="btn btn-success me-3" type="button" id="get-pay" value="去付款">
					<button class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
				</span>
			</div>
		</div>
	</div>
</div>
<script src="/user/js/sweetalert2.3.3.8.pro.min.js"></script>
<script src="/user/js/api.admin.js"></script>