<div class="theme-inner-banner">
	<div class="mohu blog"></div>
	<div class="container">
		<h2 class="intro-title text-center">博 客<?php echo $posttible ? ' - ' . $posttible : ''; ?></h2>
		<p class="text-center lg-mt-30"><?php echo $typethe; ?></p>
		<ul class="page-breadcrumb style-none d-flex justify-content-center float-start">
			<li><a href="/">首页</a></li>
			<li><a href="/blog/all">博客</a></li>
			<li class="current-page"><?php echo $posttible; ?></li>
		</ul>
	</div>
	<img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
	<img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
</div>
<div class="blog-section-four pt-30 lg-mt-0 pb-70 lg-pb-50">
	<div class="container">
		<div class="row">
			<div class="col-xxl-11 m-auto">
				<div class="row">
					<div class="col-lg-8">
						<?php
						if (count($post_list) < 1) {
							echo '<h4 class="m-auto text-center mt-3">没有相关文章！</h4>';
						}
						$page = empty($_GET['page']) ? 1 : $_GET['page'];
						$api_sum = count($post_list);
						$page_sum = ceil($api_sum / 3);
						$post_list = array_splice($post_list, ($page - 1) * 3);
						$x = 0;
						foreach ($post_list as $i => $value) {
							if ($value['post_status'] == 'publish' or $userarr['group'] == 1) {
								$excerpt = $value['post_excerpt'];
								if (mb_strlen($excerpt, 'utf-8') > 100) {
									$excerpt = mb_substr($excerpt, 0, 100, 'utf-8') . ' ...';
								}
								$postdata = html_entity_decode(stripslashes($value['post_content']));
								preg_match('/\bsrc\b\s*=\s*[\'\"]?([^\'\"]*)[\'\"]?/i', $postdata, $mat);
								//var_dump($mat);
								if (isset($mat[1])) {
									$img = $mat[1];
								} else {
									$img = '/assets/Sinco/images/banner2.jpg';
								}

								$x++;
								echo '
                    <article class="blog-meta-one tran3s excerpt mb-50 shadow-sm">
										<figure class="post-img m0" style="height: 200px;"><a href="' . $web_url . '/blog/' . $post_type_name_arr[$value['post_type']] . '/' . $value['id'] . '.html" class="w-100 d-block"><img src="' . $img . '" alt="' . $value['post_title'] . '" class="w-100 tran3s"></a></figure>
										<div class="post-data">
											<header class="text-truncate">
												<a href="/blog/' . $post_type_name_arr[$value['post_type']] . '" class="cat">' . $value['post_type'] . '<i></i></a>
												<h4><a target="_blank" class="tran3s" href="' . $web_url . '/blog/' . $post_type_name_arr[$value['post_type']] . '/' . $value['id'] . '.html" title="' . $value['post_title'] . '">' . $value['post_title'] . '</a></h4>
											</header>
											<p class="meta mb-1">
												<time class="me-3"><i class="fa fa-fw fa-clock"></i>' . $value['post_date'] . '</time>
												<span class="author me-3"><i class="fa fa-fw fa-user"></i>' . $value['post_author'] . '</span>
												<span class="pv"><i class="fa fa-fw fa-eye"></i>阅读(' . ($value['post_pv'] ? $value['post_pv'] : '0') . ')</span>
												</p>
												<p class="note">' . $excerpt . '<a href="' . $web_url . '/blog/' . $post_type_name_arr[$value['post_type']] . '/' . $value['id'] . '.html" class="read-more">[阅读全文]</a>
										</div>
									</article>';
								if ($x == 3) {
									break;
								}
							}
						}
						?>
						<div class="page-pagination-one pt-60 shadow pb-50">
							<ul class="d-flex align-items-center justify-content-center style-none">
								<?php
								$sotext = !isset($_GET['type']) ? $_GET['type'] . '?' : $_GET['type'] . '?';
								if ($page == 1) {
									echo '<li class="disabled "><a class="" href="javascript:;">首页</a></li>
                                <li class="disabled "><a class="" href="javascript:;">上页</a></li>';
								} else if ($page > 1) {
									echo '<li class=""><a class="" href="./' . $sotext . 'page=1">首页</a></li>
                                <li class=""><a class="" href="./' . $sotext . 'page=' . ($page - 1) . '">上页</a></li>';
								}

								for ($i = 1; $i <= $page_sum; $i++) {
									if ($page - $i < 2 && $i - $page < 2) {
										if ($page == $i) {
											echo '<li class="active"><a href="./' . $sotext . 'page=' . $i . '" class="">' . $i . '</a></li>';
										} else {
											echo '<li class=""><a href="./' . $sotext . 'page=' . $i . '" class="">' . $i . '</a></li>';
										}
									}
								}
								if ($page_sum > 2 && $page < 2) {
									echo '<li class="disabled"><a href="javascript:;" style="min-width: 0;">…</a></li>';
								}
								if ($page < $page_sum) {
									echo '<li class=""><a href="./' . $sotext . 'page=' . ($page + 1) . '" class="">下页</a></li>
                                    <li class=""><a href="./' . $sotext . 'page=' . $page_sum . '" class="">尾页</a></li>';
								} else {
									echo '<li class="disabled"><a href="javascript:;" class="">下页</a></li>
                                    <li class="disabled"><a href="javascript:;" class="">尾页</a></li>';
								}
								?>
							</ul>
						</div>
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
<script type="text/javascript">
	$.get("https://api.tjit.net/api/randtext/get?key=1193755ae99702b0", function(res) {
		$("#randtext").html(res.data);
	});
</script>