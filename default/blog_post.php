<div class="theme-inner-banner">
	<div class="mohu post"></div>
	<div class="container">
		<h2 class="intro-title text-center">博 客 - 正文</h2>
		<p class="text-center lg-mt-30"></p>
		<ul class="page-breadcrumb style-none d-flex justify-content-center float-start">
			<li><a href="/">首页</a></li>
			<li><a href="/blog/all">博客</a></li>
			<li class="current-page"><?php echo $post_data['post_title']; ?></li>
		</ul>
	</div>
	<img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
	<img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
</div>
<div class="blog-details pt-30 lg-mt-0 pb-70 lg-pb-50">
	<div class="container">
		<div class="row">
			<div class="col-xxl-11 m-auto">
				<div class="row">
					<div class="col-lg-8 shadow">
						<?php if ($post_data) :
							$db->query("UPDATE `posts` SET `post_pv` = `post_pv`+1 WHERE `id` = " . $post_data['id']);
						?>
							<?php if ($post_data['post_status'] == 'publish' or $userarr['group'] == 1) : ?>
								<article class="blog-meta-three tran3s">
									<header class="excerpt article-header text-center mb-3 pb-3 px-3 pt-3">
										<h1 class="article-title"><a href="<?php echo $web_url; ?>/blog/<?php echo $_GET['type']; ?>/<?php echo $post_data['id']; ?>.html" class="tran3s text-truncate"><?php echo $post_data['post_title']; ?></a></h1>
										<p class="meta mb-1">
											<span class="author me-2">来源：<a href="<?php echo $web_url; ?>"><?php echo $web_name; ?></a></span>
											<span class="me-2">分类：<a href="<?php echo $web_url; ?>/blog/<?php echo $_GET['type']; ?>"><?php echo $post_type_name[$_GET['type']]; ?></a></span>
											<time class="me-2"><i class="fa fa-fw fa-clock"></i><?php echo $post_data['post_date']; ?></time>
											<span class="author me-2"><i class="fa fa-fw fa-user"></i><?php echo $post_data['post_author']; ?></span>
											<span class="pv"><i class="fa fa-fw fa-eye"></i>阅读(<?php echo $post_data['post_pv'] ? $post_data['post_pv'] : '0'; ?>)</span>
										</p>
									</header>
									<div class="post-data article-content pt-0">
										<?php
										$postdata = html_entity_decode(stripslashes($post_data['post_content']));
										preg_match('/\bsrc\b\s*=\s*[\'\"]?([^\'\"]*)[\'\"]?/i', $postdata, $mat);
										if (isset($mat[1])) {
											$img = preg_match('/((http[s]{0,1}):\/\/)/i', $mat[1], $m) ? $mat[1] : $web_url . $mat[1];
										} else {
											$img = $web_url . '/assets/Sinco/images/banner2.jpg';
										}
										echo $postdata; ?>
									</div>
									<div class="bottom-widget d-sm-flex align-items-center justify-content-center p-5">
										<ul class="d-flex share-icon align-items-center justify-content-center style-none">
											<li>分享：</li>
											<li><a href="javascript:;" id="share-weixin"><i class="fab fa-weixin"></i></a></li>
											<li><a href="javascript:;" id="share-qq"><i class="fab fa-qq"></i></a></li>
											<li><a href="javascript:;" id="share-weibo"><i class="fab fa-weibo"></i></a></li>
										</ul>
									</div>
								</article>
							<?php else : ?>
								<?php echo '<h2 class="text-center">你没有权限查看此内容！<h2>'; ?>
							<?php endif; ?>
						<?php else : ?>
							<?php echo '<h2 class="text-center">你访问的文章不存在！<h2>'; ?>
						<?php endif; ?>
					</div>
					<div class="col-lg-4 col-md-6">
						<div class="blog-sidebar ps-xl-5 ps-lg-3 me-xxl-5  md-mt-70">
							<div class="sidebar-category mb-50">
								<h5 class="sidebar-title">文章分类</h5>
								<ul class="style-none">
									<?php echo $typelist; ?>
								</ul>
							</div>
							<div class="sidebar-keyword mb-50">
								<h5 class="sidebar-title">产品分类</h5>
								<ul class="clearfix style-none">
									<?php echo $typelist_api_type; ?>
								</ul>
							</div>
							<div class="sidebar-quote">
								<ul class="style-none d-flex justify-content-center rating">
									<li><i class="bi bi-star-fill"></i></li>
									<li><i class="bi bi-star-fill"></i></li>
									<li><i class="bi bi-star-fill"></i></li>
									<li><i class="bi bi-star-fill"></i></li>
									<li><i class="bi bi-star-fill"></i></li>
								</ul>
								<p id="randtext"></p>
								<div class="name">来自<span><a style="color: white;" href="https://api.tjit.net/user/doc?id=64" target="_blank">随机语录/随机一言API</a></span></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="/user/js/sweetalert2.3.3.8.pro.min.js"></script>
<script type="text/javascript">
	$.get("https://api.tjit.net/api/randtext/get?key=1193755ae99702b0", function(res) {
		$("#randtext").html(res.data);
	});
	$("#share-weixin").click(function() {
		swal({
			text: '<img style="display:inline-block;" class="mb-3" src="/user/phpqrcode/qrcode?data=' + window.location.href + '" width="200" height="200"><p>使用微信扫描二维码，点击右上角 ··· 按钮<br>分享到微信好友或朋友圈</p>',
			title: "分享到微信",
			confirmButtonText: "我知道了"
		});
	});
	$("#share-qq").click(function() {
		swal({
			text: '<img style="display:inline-block;" class="mb-3" src="/user/phpqrcode/qrcode?data=' + window.location.href + '" width="200" height="200"><p>使用QQ扫描二维码，点击右上角 ··· 按钮<br>分享到QQ好友或QQ空间</p>',
			title: "分享到QQ",
			confirmButtonText: "我知道了"
		});
	});
	$("#share-weibo").click(function() {
		window.open('https://service.weibo.com/share/share.php?title=' + window.document.title + '&url=' + window.location.href + '&source=bookmark&pic=<?php echo $img; ?>');
	});
</script>
<script type="text/javascript" src="/user/js/ueditor/third-party/SyntaxHighlighter/shCore.js"></script>
<link rel="stylesheet" href="/user/js/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css">
<script>
	SyntaxHighlighter.all();
</script>