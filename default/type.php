<div class="theme-inner-banner">
	<div class="mohu"></div>
	<?php if (!isset($_GET['so'])) : ?>
		<div class="container">
			<h2 class="intro-title text-center"><?php echo $typetitle; ?></h2>
			<p class="text-center lg-mt-30"><?php echo $typethe; ?></p>
			<ul class="page-breadcrumb style-none d-flex justify-content-center float-start">
				<li><a href="/">首页</a></li>
				<li><a href="javascript:;">产品</a></li>
				<li class="current-page"><?php echo $typetitle; ?></li>
			</ul>
		</div>
	<?php else : ?>
		<div class="container">
			<h2 class="intro-title text-center">搜 索</h2>
			<div class="search-content mb-4 lg-mt-50">
				<div class="search-input seach-input__home-parent clearfix">
					<form action="/type/">
						<input class="search-input__tool" name='so' type="search" placeholder="文字识别" value="<?php echo $_GET['so']; ?>" autocomplete="off" maxlength="10">
						<i class="bi bi-search"></i>
					</form>
				</div>
			</div>
			<div class="bottom-widget d-sm-flex align-items-center justify-content-center mb-2">
				<ul class="tags style-none pt-10 so-top">
					<li class="m-0">热门产品：</li>
					<?php
					$apitop = $db->getAll("select api_id,api_id,api_name,user_id,SUM(day_num) AS day_num,SUM(total_num) AS total_num,SUM(free_used) AS free_used,SUM(used) AS used,SUM(day_used) AS day_used from api_request group by api_id ORDER BY total_num DESC");
					$x = 0;
					$apilist_id = get_api_list_id();
					foreach ($apitop as $i => $value) {
						$id = $value['api_id'];
						if ($apilist_id[$id]['show']) {
							echo '<li><a href="/doc/' . $id . '">' . $apilist_id[$id]['name'] . '</a></li>';
							$x++;
						}
						if ($x == 6) {
							break;
						}
					}
					?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
	<img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
</div>
<div class="blog-section-three pt-30 lg-mt-0 pb-50 lg-pb-50" style="background: linear-gradient( #fff,#f5f6fa,#fff);">
	<div class="container">
		<ul class="style-none text-center isotop-menu-wrapper g-control-nav-one">
			<?php echo $typelist; ?>

		</ul>
		<div class="row gx-xxl-5">
			<?php
			if (count($apilist) < 1) {
				echo '<h4 class="m-auto text-center mt-3">未找到相关接口！</h4>';
			}
			$page = !isset($_GET['page']) ? 1 : $_GET['page'];
			$api_sum = count($apilist);
			$page_sum = ceil($api_sum / 12);
			$apilist = array_splice($apilist, ($page - 1) * 12);
			$x = 0;
			foreach ($apilist as $i => $value) {
				if ($value['show'] == 1) {
					//$state = $value['state'] ? '<span class="badge badge-success d-none d-lg-block">接口状态：正常</span>' : '<span class="badge badge-secondary d-none d-lg-block">接口状态：维护中</span>';
					//$appname = $value['auth_type'] == 1 ? '<span class="badge badge-primary mr-2">实名</span>'.$value['name'] : $value['name']; 
					$appico = $value['icon'] ? $value['icon'] : '<svg t="1652871867871" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="48442" width="48" height="48"><path d="M382.301659 491.669854l82.419512 214.790244h-34.965854l-19.980488-54.946342h-92.409756l-19.980488 54.946342h-32.468292l82.419512-214.790244h34.965854z m17.482926 129.87317l-34.965853-97.404878-37.463415 97.404878h72.429268zM574.613854 491.669854c49.95122 0 77.42439 22.478049 77.42439 64.936585 0 44.956098-24.97561 64.936585-77.42439 64.936585h-54.946342v82.419513h-32.468292v-214.790244h87.414634z m-54.946342 102.4h52.448781c14.985366 0 27.473171-2.497561 34.965853-9.990244 7.492683-4.995122 9.990244-14.985366 9.990244-29.970732 0-12.487805-4.995122-22.478049-12.487805-27.473171-7.492683-4.995122-19.980488-9.990244-34.965853-9.990244h-52.448781v77.424391zM714.477268 491.669854v214.790244h-32.468292v-214.790244h32.468292z" p-id="48443" fill="#48b0f7"></path><path d="M751.940683 876.294244h-499.512195c-134.868293 0-244.760976-109.892683-244.760976-244.760976 0-99.902439 62.439024-192.312195 152.35122-227.278048 27.473171-149.853659 162.341463-262.243902 317.190244-262.243903 129.873171 0 252.253659 82.419512 297.209756 202.302439 124.878049 22.478049 219.785366 134.868293 219.785366 267.239024 0 134.868293-102.4 249.756098-242.263415 264.741464 2.497561 0 0 0 0 0z m-274.731707-696.819512c-142.360976 0-262.243902 104.897561-282.224391 244.760975 0 7.492683-4.995122 12.487805-12.487805 14.985366-79.921951 27.473171-137.365854 107.395122-137.365853 194.809756 0 112.390244 92.409756 204.8 204.8 204.8h499.512195c117.385366-14.985366 207.297561-114.887805 207.297561-229.775609 0-117.385366-84.917073-217.287805-197.307317-232.273171-7.492683 0-12.487805-4.995122-14.985366-12.487805-37.463415-109.892683-147.356098-184.819512-267.239024-184.819512z" p-id="48444" fill="#48b0f7"></path></svg>';
					//$type = $api_point_type[$value['type']];
					switch ($value['type']) {
						case 0:
							$vip_html = '<span class="badge badge-danger me-1 p-1">免费</span>';
							break;
						default:
							if ($value['allvip_on']) {
								$vip_html = '<span class="badge badge-danger me-1 p-1">' . get_set('allvip_name') . '免费</span>';
								break;
							} else {
								$vip_html = '<span class="badge badge-warning me-1 p-1">付费</span>';
							}
							break;
					}
					$point = '';
					$pay_unit = $value['pay_unit'] ?: '次';
					if ($value['balance']) {
						$point = $value['balance_sum'] . '<span class="tag-cor text-xs"> 元/' . $pay_unit . '</span>';
					} else if ($value['point_on']) {
						$point = get_set('point_price') * $value['consume'] . '</span><span class="tag-cor text-xs">元/' . $pay_unit . '</span>';
					} else if ($value['vip_on']) {
						$point = round($value['vip_m_num'] / 31, 2) . '</span><span class="tag-cor text-xs">元/天</span>';
					} else if ($value['point_number_on']) {
						$shop = explode("\n", $value['point_number_list']);
						$shop_arr = explode('-', $shop[0]);
						$dsum = round($shop_arr[1] / $shop_arr[0], 3);
						$point = $dsum . '</span><span class="tag-cor text-xs">元/次</span>';
					}


					$point = $point ? '<span class="float-end"><span class="tag-m">' . $point . '</span>' : '';
					$daynum = $value['daynum'] ? '每日限制请求' . $value['daynum'] . '次' : '无限制';
					$point_free = ($value['type'] > 0) ? '' : '<span class="tag-m text-xs float-start">' . $daynum . '</span>';
					$point_free_text = $point_free ? $point_free : $daynum;
					$appthe = $value['the'];
					$free = $value['free_num'];
					$free = $free ? '注册即送' . $free . '次' : $point_free_text;
					$auth = ($value['auth_type'] == 1) ? '<span class="badge bg-primary-subtle text-primary me-1 p-1">实名</span>' : '';

					$x++;
					echo '<div class="col-lg-3 col-sm-6 d-flex" data-aos="fade-up">
							<article class="blog-meta-one color-two tran3s mt-45 post-img">
								<div class="w-100 d-block ripple-btn px-4" style="text-align: center;padding: 10px 0;background-color: #fff;">
								' . $appico . '
								<h6 class="text-truncate mb-2 text-start apptitle">' . $auth . $vip_html . $value['name'] . '</h6>
                            <p class="text-no-orf text-start mb-2">' . $appthe . '</p>
                            </div>
								<div class="tag-body px-4">
									<div class="mp-product-grid-card__price">
									<span class="tag-m text-xs float-start">' . $free . '</span>
									' . $point . '
									</div>
									<div class="mp-product-grid-card__more"><a href="/doc/' . $value['id'] . '" class="mp-product-grid-card__more--link">查看详情<i class="mp-icon mp-icon--arrow"><svg viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg"><path d="M8.48 6.247c.007-.011.016-.021.02-.032a.542.542 0 0 0-.109-.632l-4.028-3.81a.547.547 0 1 0-.753.795l3.615 3.42-3.6 3.47a.547.547 0 0 0 .758.787l3.99-3.847c.008-.007.01-.018.02-.025.005-.006.01-.01.018-.016.033-.033.048-.073.07-.11z" fill="currentColor" fillrule="nonzero"></path></svg></i></a></div>
								</div>
							</article>
						</div>';
				}
				if ($x == 12) {
					break;
				}
			}

			?>

		</div>
		<div class="page-pagination-one pt-60 shadow pb-50">
			<ul class="d-flex align-items-center justify-content-center style-none">
				<?php
				$sotext = !isset($_GET['so']) ? $_GET['id'] . '?' : '?so=' . $_GET['so'] . '&';
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
<script>
	$("[data-filter=\"typemenu\"]").click(function() {
		window.location = '/type/' + $(this).attr('id');
	});
	$(".post-img").click(function() {
		window.location = $(this).find('div').find('div').find('a').attr('href');
	});
</script>