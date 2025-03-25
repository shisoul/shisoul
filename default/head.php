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
	<title><?php echo $web_title; ?></title>
	<link rel="icon" type="image/png" sizes="56x56" href="<?php echo $web_favicon; ?>">
	<link href="/user/css/pace.css" rel="stylesheet" type="text/css">
	<script src="/user/js/pace.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/Sinco/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/assets/Sinco/css/responsive.css" media="all">
	<script src="/assets/Sinco/vendor/jquery.min.js"></script>
	<!--[if lt IE 9]>
			<script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
			<script src="/assets/Sinco/vendor/html5shiv.js"></script>
			<script src="/assets/Sinco/vendor/respond.js"></script>
		<![endif]-->
	<style>
		<?php echo $web_head_css; ?>
	</style>
</head>
<body>
	<div class="main-page-wrapper">
		<header class="theme-main-menu sticky-menu theme-menu-one shadow-sm">
			<div class="inner-content">
				<div class="d-flex align-items-center justify-content-between">
					<div class="logo order-lg-0"><a href="/" class="d-block"><img src="<?php echo get_set('template2_logo'); ?>" alt="<?php echo $web_name; ?>" title="<?php echo $web_title; ?>"></a></div>
					<div class="right-widget d-flex align-items-center ms-auto ms-lg-0 order-lg-3">
						<button class="menu-search-btn tran3s" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="bi bi-search"></i></button>
						<?php if (isset($_SESSION['UID'])) : ?>
							<a href="/user/" class="req-demo-btn-reg tran3s d-none d-lg-block">控制台</a>
						<?php else : ?>
							<a href="/user/login" class="req-demo-btn-reg tran3s d-none d-lg-block">登录/注册</a>
						<?php endif; ?>
					</div>
					<nav class="navbar navbar-expand-lg order-lg-2">
						<button class="navbar-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<span></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarNav">
							<ul class="navbar-nav">
								<li class="d-block d-lg-none">
									<div class="logo"><a href="/"><img src="<?php echo get_set('template2_logo'); ?>" alt="<?php echo $web_name; ?>" title="<?php echo $web_title; ?>"></a></div>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/" role="button">首页</a>
								</li>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="/type/" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">API <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown-menu">
										<!--li><a class="dropdown-item" id="menu" href="/type/all"><span>所有产品</span></a></li-->
										<?php
										foreach ($typedata as $key => $value) {
											echo '<li><a class="dropdown-item" id="menu" href="/type/' . $value['id'] . '"><span>' . $value['name'] . '</span></a></li>';
										} ?>
									</ul>
								</li>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="/blog/" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">动态 <i class="fa fa-angle-down"></i></a>
									<ul class="dropdown-menu">
										<!--li><a class="dropdown-item" id="menu" href="/blog/"><span>全部文章</span></a></li-->
										<?php
										foreach ($post_typedata as $key => $value) {
											echo '<li><a class="dropdown-item" id="menu" href="/blog/' . $value['path'] . '"><span>' . $value['name'] . '</span></a></li>';
										} ?>
									</ul>
								</li>
								<?php if (get_set('admin_allvip_on') == 'on') : ?>
									<li class="nav-item">
										<a class="nav-link" href="/vip/" role="button"><i class="fab fa-vimeo-v text-danger"></i> <?php echo get_set('allvip_name'); ?></a>
									</li>
								<?php endif; ?>
								<li class="nav-item">
									<a class="nav-link" href="/help/" role="button">帮助</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/doc/" role="button">文档</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="/about/" role="button">关于</a>
								</li>
								<?php if (in_array(get_set('web_rtdd_on'), ['on_no_border', 'on']) && strpos(get_set('web_rtdd_show'),'head') !== false) : ?>
									<li class="nav-item">
										<a class="nav-link" href="/rtdd/" role="button"><i class="fas fa-fw fa-chart-line fa-sm"></i> 实时请求数据大屏</a>
									</li>
								<?php endif; ?>
								<?php echo get_set('web_index_menu_li'); ?>
								<!--
						            <li class="nav-item dropdown">
							        	<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">English <i class="fa fa-angle-down"></i></a>
							        	<ul class="dropdown-menu">
							                <li><a href="/" class="dropdown-item active"><span>简体中文</span></a></li>
							                <li><a href="/?lang=zh" class="dropdown-item"><span>中文繁体</span></a></li>
							                <li><a href="/?lang=English" class="dropdown-item"><span>English</span></a></li>
						                </ul>
						            </li> -->
							</ul>
							<div class="mobile-content d-block d-lg-none mt-35">
								<div class="d-flex flex-column align-items-center justify-content-center mt-10">
									<?php if (isset($_SESSION['UID'])) : ?>
										<a href="/user/" class="req-demo-btn-reg tran3s">控制台</a>
									<?php else : ?>
										<a href="/user/login" class="req-demo-btn-reg tran3s mb-3">登录/注册</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</nav>
				</div>
			</div>
		</header>
		<div class="offcanvas offcanvas-top justify-content-center site-search shadow-lg border-0" tabindex="-1" id="offcanvasTop">
			<div class="container col-lg-5">
				<form action="/type/">
					<input class="search-input-s" type="text" name='so' placeholder="搜索关键字..." required="required" oninvalid="setCustomValidity('请输入要搜索的关键词');" oninput="setCustomValidity('');">
					<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>