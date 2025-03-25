<?php
$user_key = $userarr['apikey'] ? $userarr['apikey'] : '你的接口密钥，登录控制台后在密钥管理页面申请';
$user_sk = md5($user_key . ($userarr['phone'] ? $userarr['phone'] : $userarr['email']));
$api_arr = $body[$_GET['id']];
$api_url = $api_arr['url'];
$vip_html = '';
$balancetext = '免费';
$pay_unit = $api_arr['pay_unit'] ?: '次';
switch ($api_arr['type']) {
    case 0:
        $vip_html = '<span class="badge badge-danger me-2">免费</span>';
        break;
    default:
        if ($api_arr['point_on']) {
            $balancetext = get_set('point_price') * $api_arr['consume'] . '元/' . $pay_unit;
            $vip_html .= '<span class="badge badge-warning me-2">按量计费</span>';
        }
        if ($api_arr['allvip_on']) {
            $balancetext = get_set('allvip_name') . '免费';
            $vip_html .= '<span class="badge badge-danger me-2">' . get_set('allvip_name') . '免费</span>';
        }
        if ($api_arr['vip_on']) {
            $balancetext = round(($api_arr['vip_m_num'] / 31), 2) . '元/天';
            $vip_html .= '<span class="badge badge-danger me-2">包年包月</span>';
        }
        if ($api_arr['balance']) {
            $balancetext = $api_arr['balance_sum'] . '元/' . $pay_unit;
            if (!$api_arr['point_on']) {
                $vip_html .= '<span class="badge badge-warning me-2">按量计费</span>';
            }
        }
        if ($api_arr['point_number_on']) {
            $shop = explode("\n", $api_arr['point_number_list']);
            $shop_arr = explode('-', $shop[0]);
            $dsum = round($shop_arr[1] / $shop_arr[0], 3);
            $balancetext = $dsum . '元/次';
            $vip_html .= '<span class="badge badge-danger me-2">次数包</span>';
        }
        break;
}

$workarr = $userarr['id'] ? $db->getRow("SELECT * FROM `work` WHERE `api_id` = {$_GET['id']} and `user_id` = {$userarr['id']} and `work_type` = '申请接口试用'") : false;
$query_data = $db->getRow("SELECT sum(day_num + total_num) as total_req FROM api_request WHERE api_id = " . $_GET['id']);
$query_sum = $query_data['total_req'];
if ($query_sum >= 10000) {
    $query_sum = round($query_sum / 10000, 2) . ' 万次';
} else if ($query_sum >= 100000000) {
    $query_sum = round($query_sum / 100000000, 2) . ' 亿次';
} else if (!$query_sum) {
    $query_sum = '未统计';
} else {
    $query_sum .= ' 次';
}
$is_user_text = '正常';
$is_user_white = true;
$user_white_list = trim($api_arr['user_white_list']);
if (!empty($user_white_list)) {
    if (!in_array($userarr['id'], explode(',', $user_white_list))) {
        $is_user_white = false;
    }
}

if ($api_arr['auth_type'] && !$userarr['auth']) $is_user_text = '需实名认证';
if (!$is_user_white) $is_user_text = '需申请权限';

?>
<div class="theme-inner-banner">
    <div class="mohu doc"></div>
    <div class="container">
        <h2 class="intro-title text-center">文档中心</h2>
        <p class="text-center">
            为您提供清晰、准确、易于理解的API文档，帮助开发人员快速上手、理解和使用产品。
        </p>
        <ul class="page-breadcrumb style-none d-flex justify-content-center float-start">
            <li><a href="/">首页</a></li>
            <li><a href=".">产品</a></li>
            <li class="current-page">文档中心</li>
        </ul>
    </div>
    <img src="/assets/Sinco/images/shape/shape_38.svg" alt="" class="shapes shape-one">
    <img src="/assets/Sinco/images/shape/shape_39.svg" alt="" class="shapes shape-two">
</div>

<div class="pr-details-one pt-30 lg-mt-0 pb-70 lg-pb-50" style="background: linear-gradient( #fff,#f5f6fa);">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 mb-lg-5" id="panel_list">
                <div class="card mb-4 border-0 px-2 py-1 rounded-2 bg-white shadow">
                    <div class="card-header py-3">
                        <h6 class="m-0 fw-bold text-primary">产品目录</h6>
                    </div>
                    <div class="card-body doc-overflow my-1" style="overflow-y: auto;">
                        <div class="panel-group">
                            <?php
                            $typedata = $db->getAll("SELECT * FROM `api_type`");
                            /*
                                        $typedata[] = [
                                            'id' => 0,
                                            'name' => '未分类'
                                        ];*/
                            foreach ($typedata as $key => $value) {
                                $lista = '';
                                $iftype = false;
                                foreach ($apilist as $arr => $api_data) {
                                    if ($api_data['api_type'] == $value['id']) {
                                        if ($api_data['show'] || $userarr['group'] == 1) {
                                            if ($api_data['id'] == $_GET['id']) {
                                                $linkcss = 'active';
                                                $iftype = true;
                                            } else {
                                                $linkcss = '';
                                            }
                                            $lista .= '<a href="/doc/' . $api_data['id'] . '" class="list-group-item list-group-item-action border-0 px-2 py-1 ' . $linkcss . '">' . $api_data['name'] . '</a>';
                                        }
                                    }
                                }
                                if ($iftype == true) {
                                    $acss = 'text-decoration-none';
                                    $aria = 'true';
                                    $iconcss = 'fas float-right fa-angle-down';
                                    $show = 'show';
                                } else {
                                    $acss = 'text-reset text-decoration-none';
                                    $aria = 'false';
                                    $iconcss = 'fas float-right fa-angle-right';
                                    $show = '';
                                }
                                echo '<div class="panel panel-default">
                                            <div class="panel-heading">
                                                    <a href="#" class="' . $acss . '" link="collapse" rel="external nofollow" data-toggle="collapse" data-target="#chanel_' . $key . '" aria-expanded="' . $aria . '"><h6 class="panel-title"><i class="' . $iconcss . '"></i> ' . $value['name'] . '</h6></a>
                                            </div>
                                            <div class="collapse ' . $show . ' in panel-collapse" id="chanel_' . $key . '">
                                                <div class="list-group mb-2">
                                                ' . ($lista ? $lista : '<p class="small text-center">该分类下无相关接口</p>') . '
                                                </div>
                                            </div>
                                        </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9" id="doc_body">
                <div class="wrapper ps-xxl-2 pe-xxl-2 ms-xxl-3 me-xxl-3">
                    <div class="row gx-xxl-5 mb-25 rounded-2 shadow p-4 bg-white">
                        <div class="col-lg-4 bg-light p-3 mb-3 mb-lg-0 border-tertiary text-center appicon justify-content-center align-items-center" style="border-radius: 3%;display: grid;">
                            <div class="div-for-svg">
                                <?php echo $api_arr['icon'] ? $api_arr['icon'] : '<svg t="1652871867871" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="48442" width="48" height="48"><path d="M382.301659 491.669854l82.419512 214.790244h-34.965854l-19.980488-54.946342h-92.409756l-19.980488 54.946342h-32.468292l82.419512-214.790244h34.965854z m17.482926 129.87317l-34.965853-97.404878-37.463415 97.404878h72.429268zM574.613854 491.669854c49.95122 0 77.42439 22.478049 77.42439 64.936585 0 44.956098-24.97561 64.936585-77.42439 64.936585h-54.946342v82.419513h-32.468292v-214.790244h87.414634z m-54.946342 102.4h52.448781c14.985366 0 27.473171-2.497561 34.965853-9.990244 7.492683-4.995122 9.990244-14.985366 9.990244-29.970732 0-12.487805-4.995122-22.478049-12.487805-27.473171-7.492683-4.995122-19.980488-9.990244-34.965853-9.990244h-52.448781v77.424391zM714.477268 491.669854v214.790244h-32.468292v-214.790244h32.468292z" p-id="48443" fill="#48b0f7"></path><path d="M751.940683 876.294244h-499.512195c-134.868293 0-244.760976-109.892683-244.760976-244.760976 0-99.902439 62.439024-192.312195 152.35122-227.278048 27.473171-149.853659 162.341463-262.243902 317.190244-262.243903 129.873171 0 252.253659 82.419512 297.209756 202.302439 124.878049 22.478049 219.785366 134.868293 219.785366 267.239024 0 134.868293-102.4 249.756098-242.263415 264.741464 2.497561 0 0 0 0 0z m-274.731707-696.819512c-142.360976 0-262.243902 104.897561-282.224391 244.760975 0 7.492683-4.995122 12.487805-12.487805 14.985366-79.921951 27.473171-137.365854 107.395122-137.365853 194.809756 0 112.390244 92.409756 204.8 204.8 204.8h499.512195c117.385366-14.985366 207.297561-114.887805 207.297561-229.775609 0-117.385366-84.917073-217.287805-197.307317-232.273171-7.492683 0-12.487805-4.995122-14.985366-12.487805-37.463415-109.892683-147.356098-184.819512-267.239024-184.819512z" p-id="48444" fill="#48b0f7"></path></svg>'; ?>
                            </div>
                            <?php if ($api_arr['show_num']) : ?><div class="api-pp">调用次数：<?php echo $query_sum; ?></div><?php endif; ?>
                        </div>
                        <div class="col-lg-8">
                            <div class="project-info ps-xl-3">
                                <div class="title-style-five d-flex align-items-center">
                                    <h2 class="main-title text-truncate float-start me-3"><?php echo $api_arr['name']; ?></h2>
                                    <?php echo $api_arr['state'] == 1 ? '<span class="badge badge-success me-2">正常</span>' : '<span class="badge badge-secondary me-2">维护中</span>'; ?>
                                    <?php echo $api_arr['auth_type'] == 1 ? '<span class="badge badge-primary me-2">需实名认证</span>' : ''; ?>
                                    <?php echo $vip_html; ?>
                                </div>
                                <div class="text-wrapper pt-3 md-pt-20">
                                    <p>
                                        <?php echo $api_arr['the']; ?>
                                    </p>
                                </div>
                                <div class="row gx-xxl-5">
                                    <div class="col-sm-4 mb-0">
                                        <div class="pt-title">
                                            更新日期
                                        </div>
                                        <div class="pt-text">
                                            <?php echo date('Y-m-d', $api_arr['time']); ?>
                                        </div>
                                    </div>
                                    <?php if ($api_arr['type'] && $api_arr['free_num'] > 0) : ?>
                                        <div class="col-sm-4 mb-0">
                                            <div class="pt-title">
                                                免费额度
                                            </div>
                                            <div class="pt-text">
                                                <?php echo $api_arr['free_num']; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-sm-4 mb-0">
                                        <div class="pt-title">
                                            调用权限
                                        </div>
                                        <div class="pt-text">
                                            <?php echo $is_user_text; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-0">
                                        <div class="pt-title">
                                            每日限制
                                        </div>
                                        <div class="pt-text">
                                            <?php echo $api_arr['daynum'] ? $api_arr['daynum'] . '次' : '无限制'; ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-0">
                                        <div class="pt-title">
                                            请求频率限制
                                        </div>
                                        <div class="pt-text">
                                            <?php
                                            if ($api_arr['qps_num'] or get_set('api_allownum')) {
                                                $qpstext = $api_arr['qps_time'] . '秒' . $api_arr['qps_num'] . '次';
                                                if ($userarr['id'] && $userarr['group'] == 2 && ($userarr['vip_end_time'] - time() > 0 or $userarr['vip_type'] == 3)) {
                                                    $qpstext = get_set('api_allowtime_vip') . '秒' . get_set('api_allownum_vip') . '次';
                                                }
                                                echo $qpstext;
                                            } else {
                                                echo '无限制';
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <?php if ($api_arr['type']) : ?>
                                        <div class="col-sm-4 mb-0">
                                            <div class="pt-title">
                                                参考价格
                                            </div>
                                            <div class="pt-text">
                                                <?php echo $balancetext; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <ul class="d-flex social-icon style-none mt-20">
                                    <?php if ($api_arr['type'] && $api_arr['state']) : ?>
                                        <li class="me-3"><button type="button" class="btn btn-sm btn-outline-warning" id="shop"><i class="fas fa-shopping-cart fa-sm fa-fw"></i> 立即购买</button></li>
                                    <?php endif; ?>
                                    <?php if ($api_arr['free_on'] or !$api_arr['type']) : ?>
                                        <li class="me-3"><button type="button" class="btn btn-sm btn-outline-success" onclick="new bootstrap.Tab('#btn-debug').show()"><?php echo ($api_arr['type']) ? '免费测试' : '免费接入' ?></button></li>
                                    <?php endif; ?>
                                    <?php if ($api_arr['beta_on'] and $api_arr['type'] and $api_arr['state'] and !$workarr) : ?>
                                        <li><button type="button" class="btn btn-sm btn-danger" id="btn-beta">申请试用</button></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-xxl-5 mb-100 rounded-2 shadow p-4 pt-3 bg-white">
                        <ul class="nav nav-tabs apitab">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#paydoc" type="button" role="tab" aria-controls="paydoc" aria-selected="true" href="#paydoc">计费说明</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#doc" type="button" role="tab" aria-controls="doc" aria-selected="true" href="#doc">API文档</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#errcode" type="button" role="tab" aria-controls="errcode" aria-selected="false" href="#errcode">错误码参照</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#demo" type="button" role="tab" aria-controls="demo" aria-selected="false" href="#demo">示例代码</a>
                            </li>
                            <?php if ($api_arr['debug']) : ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#debug" type="button" role="tab" aria-controls="debug" aria-selected="false" href="#debug" id='btn-debug'><i class="fas fa-location-arrow fa-sm fa-fw"></i> 在线调试</a>
                                </li>
                            <?php endif; ?>
                            <?php if (get_set('comment_set') == 'on') : ?>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" data-bs-target="#comments" type="button" role="tab" aria-controls="comments" aria-selected="false" href="#comments"><i class="fas fa-pen fa-sm fa-fw"></i> 发表评论</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                        <div class="tab-content p-3">
                            <div class="tab-pane show fade active apibox" id="paydoc">
                                <?php if ($api_arr['type']) : ?>
                                    <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2">计费控制优先级（按已开通的类型进行）：</h2>
                                    <p class="small"><?php echo get_set('allvip_name'); ?>->单独包月->次数包->点数计费->账户余额->免费额度</p>
                                <?php endif; ?>
                                <?php if ($api_arr['balance']) : ?>
                                    <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2">账户余额：</h2>
                                    <p class="small">支持账户余额抵扣，每次扣除金额：<span class="fw-normal lightblue"><?php echo $api_arr['balance_sum']; ?> 元<span class="tag-cor text-xs">/<?php echo $pay_unit; ?></span></span></p>
                                <?php endif; ?>
                                <?php if ($api_arr['point_on']) : ?>
                                    <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2">按量计费：</h2>
                                    <p class="small">支持点数余额抵扣，每次扣除点数：<span class="fw-normal lightblue"><?php echo $api_arr['consume']; ?> 点<span class="tag-cor text-xs">/<?php echo $pay_unit; ?></span></span> <?php echo '<span class="badge badge-secondary me-2">约 ' . get_set('point_price') * $api_arr['consume'] . ' 元'; ?><span class="tag-cor text-xs">/<?php echo $pay_unit; ?></span></span></p>
                                <?php endif; ?>
                                <?php if ($api_arr['allvip_on']) : ?>
                                    <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2"><i class="fab fa-vimeo-v text-danger"></i> <?php echo get_set('allvip_name'); ?>：</h2>
                                    <p class="small"><?php echo get_set('allvip_name'); ?>有效期内，可免费使用本产品。</p>
                                <?php endif; ?>
                                <?php if ($api_arr['vip_on']) : ?>
                                    <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2">包年包月：</h2>
                                    <table class="table table-bordered table-responsive table-sm">
                                        <tbody>
                                            <tr class="table-light firstRow">
                                                <th>包月价格</th>
                                                <th>包季价格</th>
                                                <th>包年价格</th>
                                            </tr>
                                            <tr>
                                                <td>¥ <?php echo $api_arr['vip_m_num'] . ' <span class="badge badge-secondary me-2">约 ' . round(($api_arr['vip_m_num'] / 31), 2) . ' 元/天</span>'; ?></td>
                                                <td>¥ <?php echo $api_arr['vip_j_num'] . ' <span class="badge badge-secondary me-2">约 ' . round(($api_arr['vip_j_num'] / 90), 2) . ' 元/天</span>'; ?></td>
                                                <td>¥ <?php echo $api_arr['vip_y_num'] . ' <span class="badge badge-secondary me-2">约 ' . round(($api_arr['vip_y_num'] / 365), 2) . ' 元/天</span>'; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                                <?php if ($api_arr['point_number_on']) : ?>
                                    <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2">次数包：</h2>
                                    <table class="table table-bordered table-responsive table-sm">
                                        <tbody>
                                            <tr class="table-light firstRow">
                                                <th>额度</th>
                                                <th>价格</th>
                                                <th>有效期</th>
                                            </tr>
                                            <?php
                                            $shop = explode("\n", $api_arr['point_number_list']);
                                            foreach ($shop as $i => $value) {
                                                $shop_arr = explode('-', $value);
                                                $dsum = round($shop_arr[1] / $shop_arr[0], 3);
                                                echo '<tr>
                                                <td>' . $shop_arr[0] . ' (次)</td>
                                                <td>¥ ' . $shop_arr[1] . ' <span class="badge badge-secondary me-2">低至' . $dsum . '/次</span></td>
                                                <td>' . day_to_str($shop_arr[2]) . '</td>
                                            </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                                <?php if ($api_arr['free_on'] && $api_arr['type']) : ?>
                                    <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2">免费额度：</h2>
                                    <table class="table table-bordered table-responsive table-sm">
                                        <tbody>
                                            <tr class="table-light firstRow">
                                                <th>总免费额度</th>
                                                <th>每月免费额度</th>
                                                <th>每日免费额度</th>
                                            </tr>
                                            <tr>
                                                <td><?php echo $api_arr['free_num']; ?> (次)</td>
                                                <td><?php echo $api_arr['free_m_num']; ?> (次) <span class="badge badge-danger me-2">包含在总免费额度</span></td>
                                                <td><?php echo $api_arr['free_d_num']; ?> (次) <span class="badge badge-danger me-2">包含在总免费额度</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                                <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2">请求限制：</h2>
                                <table class="table table-bordered table-responsive table-sm">
                                    <tbody>
                                        <tr class="table-light firstRow">
                                            <th>免费/测试用户请求频率限制</th>
                                            <th>请求频率总限制</th>
                                            <?php if ($api_arr['allvip_on']) : ?><th><?php echo get_set('allvip_name'); ?>请求频率限制</th><?php endif; ?>
                                            <th>每日请求次数总限制</th>
                                        </tr>
                                        <tr>
                                            <td><?php echo $api_arr['type'] == 1 ? $api_arr['free_qps_time'] . '秒' . $api_arr['free_qps_num'] . '次' : get_set('api_allowtime') . '秒' . get_set('api_allownum') . '次'; ?> <span class="badge badge-warning me-2">每个免费用户的QPS总限制</span></td>
                                            <td><?php echo $api_arr['qps_time']; ?>秒<?php echo $api_arr['qps_num']; ?>次 <span class="badge badge-warning me-2">每个用户QPS总限制</span></td>
                                            <?php if ($api_arr['allvip_on']) : ?>
                                                <td><?php echo get_set('api_allowtime_vip'); ?>秒<?php echo get_set('api_allownum_vip'); ?>次 <span class="badge badge-warning me-2">每个<?php echo get_set('allvip_name'); ?>用户的QPS总限制</span></td>
                                            <?php endif; ?>
                                            <td><?php echo $api_arr['daynum'] > 0 ? $api_arr['daynum'] . ' (次)' : '不限'; ?> <span class="badge badge-warning me-2">每个用户每日请求总次数</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2">其他准入要求：</h2>
                                <?php if ($api_arr['auth_type']) : ?>
                                    <li class="small mb-2"><span class="badge badge-primary me-2">账户需要实名认证</span><span class="fw-normal lightblue"><a target="_blank" href="/user/auth" style="    text-decoration: revert;">前往认证</a></span></li>
                                <?php endif; ?>
                                <?php if ($api_arr['point_qps_on']) : ?>
                                    <li class="small mb-2"><span class="badge badge-success me-2">账户余额/点数</span>计费的用户，不限制每日请求次数和QPS
                                    </li>
                                <?php endif; ?>
                                <?php if ($api_arr['point_number_qps_on']) : ?>
                                    <li class="small mb-2"><span class="badge badge-info me-2">次数包</span>计费的用户，不限制每日请求次数和QPS
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty(trim($api_arr['user_white_list']))) : ?>
                                    <li class="small">开发者需要联系人工客服申请该接口使用权限，并说明你的应用场景，审核通过后即时开通接口正常使用。</li>
                                    <hr>
                                    申请接口使用权限：<a class="alert-link" target="_blank" href="/user/work">点击申请</a></p>
                                <?php endif; ?>
                                <?php if (empty(trim($api_arr['user_white_list'])) && !$api_arr['point_number_qps_on'] && !$api_arr['point_qps_on'] && !$api_arr['auth_type']) : ?>
                                    <p class="small">无</p>
                                <?php endif; ?>
                            </div>
                            <div class="tab-pane fade apibox" id="doc">
                                <p class="small">
                                    接口地址：<span class="fw-normal lightblue"><a href="<?php echo $api_url; ?>" target="_blank"><?php echo $api_url; ?></a></span>
                                </p>
                                <p class="small">
                                    返回格式：<span class="fw-normal"><?php echo $api_arr['res_type']; ?></span>
                                </p>
                                <p class="small">
                                    请求方式：<span class="fw-normal"><span class="badge badge-primary me-2">HTTP</span><?php echo ($api_arr['method'] == 'REQUEST') ? '<span class="badge badge-warning me-1">GET</span><span class="badge badge-danger">POST/JSON</span>' : '<span class="badge badge-danger">' . $api_arr['method'] . '</span>'; ?></span></span>
                                </p>
                                <p class="small">
                                    请求示例：<span class="fw-normal"><?php echo $api_arr['req_demo']; ?></span>
                                </p>
                                <?php echo $api_arr['doc_html']; ?>
                                <h2 class="fs-6 fw-bold my-3 border-start border-4 border-info ps-2">返回示例：</h2>
                                <div class="p-3 well-demo pre-scrollable-demo" id="resjson-demo">
                                    <?php echo !json_decode($api_arr['res_demo']) ? $api_arr['res_demo'] : ''; ?>
                                </div>
                            </div>
                            <div class="tab-pane fade fade apibox" id="errcode">
                                <?php echo $api_arr['doc_err']; ?>
                            </div>
                            <div class="tab-pane fade fade" id="demo">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#php">PHP</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#js">JavaScript</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#epl">易语言</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#java">JAVA</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#go">GO</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#Python">Python</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#Nodejs">Nodejs</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#c1">C</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#c2">C++</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#c3">C#</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#vb">VB</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show fade active" id="php">
                                        <pre class="pre-scrollable"><code id="phpcode" class="language-php line-numbers" style="white-space: pre-wrap">
&lt;?php
/**
 * API请求DEMO
 * 
 * 本demo支持GET与POST请求，同时支持签名验证与无需签名。
 */

//你申请的key密钥
$API_KEY = &#x27;<?php echo $user_key; ?>&#x27;;

//API接口地址
$API_URL = &#x27;<?php echo $api_url; ?>&#x27;;

$get_post_data = array(
    //接口参数，一行一个，可按照接口文档-请求参数 的参数填写，或者直接复制开发工具下面的测试代码。
    &#x27;key&#x27; =&gt; $API_KEY,
	&#x27;参数名&#x27; =&gt; &#x27;参数值&#x27;,
);

//签名校验的 SK：(在用户控制台<?php echo get_set('web_url'); ?>/user/key的秘钥安全设置-&gt;签名校验 开启后才会生效，没开启签名校验留空即可。)
$sk = &#x27;<?php echo $user_sk; ?>&#x27;;

/*发起请求API接口:
第1个参数：API接口地址URL，跟上面的同名变量相对应，无需更改。
第2个参数：API接口参数数组，跟上面的同名变量相对应，无需更改。
第3个参数：请求协议（GET或POST），一般默认GET，部分接口需要POST请求，根据实际情况修改为POST即可。
第4个参数：是否验证签名，true验证签名，否则false不验证签名，根据用户控制台 <?php echo get_set('web_url'); ?>/user/key 的 秘钥安全设置-&gt;签名校验 开启后才会生效，如没开启，填写false即可。
第5个参数：如果第4个参数开启验证签名，此处必须填写 SK ，跟上面的同名变量相对应，无需更改。
 */
$resdata = api::send($API_URL, $get_post_data, &#x27;GET&#x27;, true, $sk);  //发起请求，注意这里要选择接口支持的协议，默认GET，可选POST

//打印请求结果
print($resdata);
///////////////你的业务代码可写在这里处理API返回的数据

/**
 * API请求类
 */
class api
{
    public static function send($API_URL, $get_post_data, $type, $ifsign, $sk)
    {
        $get_post_data = http_build_query($get_post_data);
        if ($ifsign) {
            $sign = md5($get_post_data . $sk);
            $res = self::send_curl($API_URL, $type, $get_post_data, $sign);
        } else {
            $res = self::send_curl($API_URL, $type, $get_post_data, null);
        }
        return $res;
    }
    //封装好的CURL请求函数,支持POST|GET
    public static function send_curl($API_URL, $type, $get_post_data, $sign)
    {
        $ch = curl_init();
        if ($type == &#x27;POST&#x27;) {
            curl_setopt($ch, CURLOPT_URL, $API_URL);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $get_post_data);
        } elseif ($type == &#x27;GET&#x27;) {
            curl_setopt($ch, CURLOPT_URL, $API_URL . &#x27;?&#x27; . $get_post_data);
        }
        if ($sign) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [&#x27;sign:&#x27; . $sign]);
        }
        curl_setopt($ch, CURLOPT_REFERER, $API_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $resdata = curl_exec($ch);
        curl_close($ch);
        return $resdata;
    }
}




</code></pre>
                                    </div>
                                    <div class="tab-pane fade fade" id="js">
                                        <pre class="pre-scrollable"><code id="jscode" class="language-js line-numbers" style="white-space: pre-wrap">
//jQuery-Ajax
$.ajax({
	url: &#x27;<?php echo $api_url; ?>&#x27;,
	data: {
	//接口参数，一行一个，可按照接口文档-请求参数 的参数填写，或者直接复制开发工具下面的测试代码。
		key: &#x27;<?php echo $user_key; ?>&#x27;,
		参数名: &#x27;参数值&#x27;,

	},
	type: &#x27;GET&#x27;, //请求协议（GET或POST），一般默认GET，部分接口需要POST请求，根据实际情况修改为POST即可。
	dataType: &#x27;json&#x27;,
	success: function(data) {
		console.log(data); //请求成功，输出结果到控制台
	},
	timeout: 3000, //超时时间
	error: function(data) {
		console.log(&#x27;请求失败&#x27;); //失败处理
	}
});


</code></pre>
                                    </div>
                                    <div class="tab-pane fade fade" id="epl">
                                        <div id="ecode">
                                            <div class="frame_out ebackcolor9" onmouseover="this.style.border='1px dashed red';codetool1.style.borderBottom='1px dashed red'" onmouseout="this.style.border='1px dashed #CCCCCC';codetool1.style.borderBottom='1px dashed #CCCCCC'" style="border: 1px dashed rgb(204, 204, 204);">
                                                <div class="frame_up" id="codetool1" style="border-bottom: 1px dashed rgb(204, 204, 204);"><input type="button" onclick="copyecode(1,'代码复制成功，请直接在\u6613\u8bed\u8a00里粘贴即可');" value="　复制代码　" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" onclick="QhShow(1);" id="QhShow1" value="　纯文本模式　" class="btn btn-primary"></div>
                                                <div id="codetxt1_a" style="display: " class="frame_show ebackcolor9">
                                                    <table border="1" cellspacing="0" style="margin-bottom: 0px;table-layout:auto; border-width:0px;margin-top:4px; width:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td class="eHeadercolor Rowheight">子程序名</td>
                                                                <td class="eHeadercolor Rowheight">返回值类型</td>
                                                                <td class="eHeadercolor Rowheight">公开</td>
                                                                <td colspan="3" class="eHeadercolor Rowheight">备 注</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="eProcolor Rowheight">__启动窗口_创建完毕</td>
                                                                <td class="eTypecolor Rowheight">&nbsp;</td>
                                                                <td class="Rowheight eTickcolor" align="center">&nbsp;</td>
                                                                <td colspan="3" class="Remarkscolor Rowheight"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table> <span class="Remarkscolor">' 添加并使用《精易模块》<br></span><span class="funccolor">Send_API</span> <span class="conscolor">(</span><span class="conscolor">)</span><br>
                                                    <table border="1" cellspacing="0" style="margin-bottom: 0px;table-layout:auto; border-width:0px;margin-top:4px; width:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td class="eHeadercolor Rowheight">子程序名</td>
                                                                <td class="eHeadercolor Rowheight">返回值类型</td>
                                                                <td class="eHeadercolor Rowheight">公开</td>
                                                                <td colspan="3" class="eHeadercolor Rowheight">备 注</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="eProcolor Rowheight">Send_API</td>
                                                                <td class="eTypecolor Rowheight">&nbsp;</td>
                                                                <td class="Rowheight eTickcolor" align="center">&nbsp;</td>
                                                                <td colspan="3" class="Remarkscolor Rowheight"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table border="1" cellspacing="0" style="margin-bottom: 0px;table-layout:auto;border-width: 0px; margin-top: 4px;width:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td class="eVariableheadcolor Rowheight">变量名</td>
                                                                <td class="eVariableheadcolor Rowheight">类 型</td>
                                                                <td class="eVariableheadcolor Rowheight">静态</td>
                                                                <td class="eVariableheadcolor Rowheight">数组</td>
                                                                <td class="eVariableheadcolor Rowheight">备 注</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="Variablescolor Rowheight">REQU_Data</td>
                                                                <td class="eTypecolor Rowheight">文本型</td>
                                                                <td class="Rowheight eTickcolor" align="center">&nbsp;</td>
                                                                <td class="eArraycolor Rowheight"></td>
                                                                <td colspan="3" class="Remarkscolor Rowheight">提交字符串</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="Variablescolor Rowheight">return</td>
                                                                <td class="eTypecolor Rowheight">文本型</td>
                                                                <td class="Rowheight eTickcolor" align="center">&nbsp;</td>
                                                                <td class="eArraycolor Rowheight"></td>
                                                                <td colspan="3" class="Remarkscolor Rowheight">返回字符串</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="Variablescolor Rowheight">API_URL</td>
                                                                <td class="eTypecolor Rowheight">文本型</td>
                                                                <td class="Rowheight eTickcolor" align="center">&nbsp;</td>
                                                                <td class="eArraycolor Rowheight"></td>
                                                                <td colspan="3" class="Remarkscolor Rowheight">接口地址</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="Variablescolor Rowheight">API_KEY</td>
                                                                <td class="eTypecolor Rowheight">文本型</td>
                                                                <td class="Rowheight eTickcolor" align="center">&nbsp;</td>
                                                                <td class="eArraycolor Rowheight"></td>
                                                                <td colspan="3" class="Remarkscolor Rowheight">接口密钥</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>API_URL ＝ <span class="eTxtcolor">“<?php echo $api_url; ?>”</span><br>API_KEY ＝ <span class="eTxtcolor">“<?php echo $user_key; ?>”</span><br>REQU_Data ＝ "请求参数，根据接口文档的请求参数来拼接字符串（例a=a&b=b&c=c）"<br>return ＝ <span class="funccolor">编码_Utf8到Ansi</span> <span class="conscolor">(</span><span class="funccolor">网页_访问</span> <span class="conscolor">(</span>API_URL + <span class="eTxtcolor">“?key=”</span> + API_KEY + REQU_Data, , , , , <span class="eTxtcolor">“User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36”</span><span class="conscolor">)</span>)<br><span class="funccolor">输出调试文本</span> <span class="conscolor">(</span>return<span class="conscolor">)</span><br>
                                                </div>
                                                <div id="codetxt1_b" style="display: none"><textarea class="codeshow" id="ecode_1">.版本 2

.子程序 __启动窗口_创建完毕
'添加并使用《精易模块》
Send_API ()

.子程序 Send_API
.局部变量 REQU_Data, 文本型, , , 提交字符串
.局部变量 return, 文本型, , , 返回字符串
.局部变量 API_URL, 文本型, , , 接口地址
.局部变量 API_KEY, 文本型, , , 接口密钥

API_URL ＝ “<?php echo $api_url; ?>”
API_KEY ＝ “<?php echo $user_key; ?>”
REQU_Data ＝ "请求参数，根据接口文档的请求参数来拼接字符串（例a=a&b=b&c=c）"
return ＝ 编码_Utf8到Ansi (网页_访问 (API_URL + “key=” + API_KEY + REQU_Data, , , , , “User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36”))
输出调试文本 (return)

</textarea></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade fade" id="java">
                                        <pre class="pre-scrollable"><code class="language-java line-numbers" style="white-space: pre-wrap">
import java.io.BufferedReader; 
import java.io.InputStreamReader; 
import java.net.HttpURLConnection; 
import java.net.URL; 
 
public class Test { 
    public static void main(String[] args) { 
        try { 
            URL url = new URL(&quot;<?php echo $api_url; ?>?key=<?php echo $user_key; ?>&quot;); 
            HttpURLConnection connection = (HttpURLConnection)url.openConnection(); 
 
            // 设置请求方式
            connection.setRequestMethod(&quot;GET&quot;); 
            connection.connect(); 
 
            // 获取响应码
            int responseCode = connection.getResponseCode(); 
            if (responseCode == HttpURLConnection.HTTP_OK) { 
                BufferedReader reader = new BufferedReader(new InputStreamReader(connection.getInputStream())); 
                String line; 
                while ((line = reader.readLine()) != null) { 
                    // 读取到的内容给line变量 
                    System.out.println(line); 
                } 
                reader.close(); 
            } 
        } catch (Exception e) { 
            e.printStackTrace(); 
        } 
    } 
}

</code></pre>
                                    </div>
                                    <div class="tab-pane fade fade" id="go">
                                        <pre class="pre-scrollable"><code class="language-js line-numbers" style="white-space: pre-wrap">
package main
 
import (
    &quot;fmt&quot;
    &quot;io/ioutil&quot;
    &quot;net/http&quot;
)
 
func main() {
    // 发起一个GET请求
    resp, err := http.Get(&quot;<?php echo $api_url; ?>?key=<?php echo $user_key; ?>&quot;)
    if err != nil {
        fmt.Println(&quot;http get error&quot;, err)
        return
    }
 
    // 读取响应结果
    result, err := ioutil.ReadAll(resp.Body)
    if err != nil {
        fmt.Println(&quot;http read error&quot;, err)
        return
    }
 
    // 关闭响应结果
    defer resp.Body.Close()
 
    fmt.Println(string(result))
}

</code></pre>
                                    </div>
                                    <div class="tab-pane fade fade" id="Python">
                                        <pre class="pre-scrollable"><code class="language-python line-numbers" style="white-space: pre-wrap">
&#x60;&#x60;&#x60;
# 导入requests库
import requests
 
# 设置url
url = &#x27;<?php echo $api_url; ?>?key=<?php echo $user_key; ?>&#x27;
 
# 发送post请求
response = requests.post(url, data={&#x27;key1&#x27;: &#x27;value1&#x27;, &#x27;key2&#x27;: &#x27;value2&#x27;})
 
# 获取响应内容
result = response.json()
 
# 打印结果
print(result)
&#x60;&#x60;&#x60;
</code></pre>
                                    </div>
                                    <div class="tab-pane fade fade" id="Nodejs">
                                        <pre class="pre-scrollable"><code class="language-js line-numbers" style="white-space: pre-wrap">
// 以下是使用Node.js进行GET和POST请求API接口的示例代码：

const https = require(&#x27;https&#x27;);
const querystring = require(&#x27;querystring&#x27;);

// 定义请求选项
const options = {
  hostname: &#x27;<?php echo $web_host; ?>&#x27;,
  path: &#x27;<?php echo str_replace('.php', '', $api_arr['path']); ?>&#x27;,
  method: &#x27;GET&#x27;
};

// 发送GET请求
https.get(options, res =&gt; {
  console.log(&#x60;statusCode: ${res.statusCode}&#x60;);

  res.on(&#x27;data&#x27;, d =&gt; {
    process.stdout.write(d);
  });
}).on(&#x27;error&#x27;, error =&gt; {
  console.error(error);
});

// 发送POST请求
const postData = querystring.stringify({
  &#x27;key1&#x27;: &#x27;value1&#x27;,
  &#x27;key2&#x27;: &#x27;value2&#x27;
});

const postOptions = {
  hostname: &#x27;<?php echo $web_host; ?>&#x27;,
  path: &#x27;<?php echo str_replace('.php', '', $api_arr['path']); ?>&#x27;,
  method: &#x27;POST&#x27;,
  headers: {
    &#x27;Content-Type&#x27;: &#x27;application/x-www-form-urlencoded&#x27;,
    &#x27;Content-Length&#x27;: Buffer.byteLength(postData)
  }
};

const postReq = https.request(postOptions, res =&gt; {
  console.log(&#x60;statusCode: ${res.statusCode}&#x60;);

  res.on(&#x27;data&#x27;, d =&gt; {
    process.stdout.write(d);
  });
});

postReq.on(&#x27;error&#x27;, error =&gt; {
  console.error(error);
});

postReq.write(postData);
postReq.end();
/*
这个示例代码使用Node.js内置的&#x60;https&#x60;模块进行HTTP请求。

首先定义了一个GET请求的选项，然后使用&#x60;https.get()&#x60;方法发送了GET请求。在响应流上注册回调函数，以便在收到响应数据时将其输出到控制台。在出现错误时，也注册了错误处理程序。

类似地，我们也定义了一个POST请求选项，并使用&#x60;https.request()&#x60;方法发送它。需要在请求头中包含适当的&#x60;Content-Type&#x60;和&#x60;Content-Length&#x60;以确保服务器可以正确解析请求体。请求体由&#x60;write()&#x60;方法写入，并在请求结束时通过调用&#x60;end()&#x60;方法通知请求对象已经完成。

注意，此示例默认使用&#x60;querystring&#x60;模块将数据作为x-www-form-urlencoded格式进行编码。如果需要使用其他格式（如JSON），则需要相应地更改请求头和请求体的编码方式。

另外，为了确保HTTPS请求的安全性，您也可以添加其他选项，例如验证服务器证书、设置代理等。
*/




</code></pre>
                                    </div>
                                    <div class="tab-pane fade fade" id="c1">
                                        <pre class="pre-scrollable"><code class="language-c line-numbers" style="white-space: pre-wrap">
以下是使用C语言进行GET和POST请求API接口的示例代码：

``` c
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <curl/curl.h> // 需要安装curl库

// API地址
const char* url = "<?php echo $api_url; ?>";

// GET请求
void getRequest(CURL* curl) {
    CURLcode res;

    // 设置URL
    curl_easy_setopt(curl, CURLOPT_URL, url);

    // 执行请求
    res = curl_easy_perform(curl);

    if(res != CURLE_OK) {
        fprintf(stderr, "curl_easy_perform() failed: %s\n", curl_easy_strerror(res));
    }
}

// POST请求
void postRequest(CURL* curl) {
    CURLcode res;

    // 设置URL
    curl_easy_setopt(curl, CURLOPT_URL, url);

    // 设置POST数据
    const char* postData = "key=<?php echo $user_key; ?>&key1=value1";
    curl_easy_setopt(curl, CURLOPT_POSTFIELDS, postData);

    // 执行请求
    res = curl_easy_perform(curl);

    if(res != CURLE_OK) {
        fprintf(stderr, "curl_easy_perform() failed: %s\n", curl_easy_strerror(res));
    }
}

int main() {
    CURL* curl;
    CURLcode res;

    // 初始化curl
    curl = curl_easy_init();

    if(curl) {
        // 设置SSL验证
        curl_easy_setopt(curl, CURLOPT_SSL_VERIFYPEER, 1L);

        // GET请求
        getRequest(curl);

        // POST请求
        postRequest(curl);

        // 清理curl资源
        curl_easy_cleanup(curl);
    }

    return 0;
}
```

这个示例代码使用了libcurl库进行HTTP请求。

首先，需要设置API地址。然后，基于`CURL`结构体创建curl句柄，并使用`curl_easy_setopt()`函数设置选项。这里设置了SSL验证，以确保请求的安全性。

在GET请求中，只需将URL设置为选项，然后调用`curl_easy_perform()`函数执行请求即可。

在POST请求中，还需要将POST数据作为字符串传递给`CURLOPT_POSTFIELDS`选项。

需要注意的是，为了避免内存泄漏，应该在使用完curl句柄之后调用`curl_easy_cleanup()`函数进行清理。

除了上述示例代码外，libcurl库还提供了更多高级选项，例如处理HTTP头、上传文件等。可以参考文档进行更详细的了解。


</code></pre>
                                    </div>
                                    <div class="tab-pane fade fade" id="c2">
                                        <pre class="pre-scrollable"><code class="language-cpp line-numbers" style="white-space: pre-wrap">
以下是一个使用C++请求API接口的示例代码：

```cpp
#include <iostream>
#include <curl/curl.h>

int main() {
    CURL *curl;
    CURLcode res;
    std::string url = "<?php echo $api_url; ?>?key=<?php echo $user_key; ?>";
    std::string response;

    curl = curl_easy_init();
    if (curl) {
        curl_easy_setopt(curl, CURLOPT_URL, url.c_str());
        curl_easy_setopt(curl, CURLOPT_FOLLOWLOCATION, 1L);
        curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, [](char *ptr, size_t size, size_t nmemb, void *userdata) -> size_t {
            std::string *response = reinterpret_cast<std::string *>(userdata);
            response->append(ptr, size * nmemb);
            return size * nmemb;
        });
        curl_easy_setopt(curl, CURLOPT_WRITEDATA, &response);

        res = curl_easy_perform(curl);
        if (res == CURLE_OK) {
            std::cout << "Response: " << response << std::endl;
        } else {
            std::cerr << "Error: " << curl_easy_strerror(res) << std::endl;
        }
        curl_easy_cleanup(curl);
    }

    return 0;
}
```

解释：

1. 引入需要的头文件：`<iostream>`用于输出结果，`<curl/curl.h>`用于使用libcurl库。

2. 定义需要请求的API接口的URL和存储响应数据的字符串变量。

3. 初始化一个CURL对象。

4. 设置CURL对象的参数：请求的URL（`CURLOPT_URL`）、是否跟随重定向（`CURLOPT_FOLLOWLOCATION`）、响应数据的写入函数（`CURLOPT_WRITEFUNCTION`）和响应数据的写入位置（`CURLOPT_WRITEDATA`）。

5. 发送HTTP请求并获取响应数据，判断返回状态码是否OK。

6. 清理CURL对象。

运行该程序会发送GET请求到指定的API接口URL，并在程序终止前将响应数据输出到终端。注意，在使用该示例代码之前需要安装libcurl库。


</code></pre>
                                    </div>
                                    <div class="tab-pane fade fade" id="c3">
                                        <pre class="pre-scrollable"><code class="language-cpp line-numbers" style="white-space: pre-wrap">
以下是一个使用C#请求API接口的示例代码：

```csharp
using System;
using System.Net.Http;
using System.Threading.Tasks;

class Program {
    static async Task Main(string[] args) {
        HttpClient client = new HttpClient();
        string url = "<?php echo $api_url; ?>?key=<?php echo $user_key; ?>";
        HttpResponseMessage response = await client.GetAsync(url);
        if (response.IsSuccessStatusCode) {
            string responseBody = await response.Content.ReadAsStringAsync();
            Console.WriteLine("Response: " + responseBody);
        } else {
            Console.WriteLine("Error: " + response.StatusCode);
        }
    }
}
```

解释：

1. 引用需要的命名空间：`System.Net.Http`用于使用HttpClient类，`System.Threading.Tasks`用于异步执行请求操作。

2. 创建一个HttpClient对象。

3. 定义需要请求的API接口的URL。

4. 发送GET请求到指定的API接口URL，并获取响应结果。

5. 判断响应状态是否成功，如果成功则读取响应数据（使用ReadAsStringAsync方法），否则输出错误信息（使用StatusCode属性）。

运行该程序会发送GET请求到指定的API接口URL，并在程序终止前将响应数据输出到终端。注意，在使用该示例代码之前需要安装.NET Framework或.NET Core SDK。


</code></pre>
                                    </div>
                                    <div class="tab-pane fade fade" id="vb">
                                        <pre class="pre-scrollable"><code class="language-vbnet line-numbers" style="white-space: pre-wrap">
以下是VB请求API接口的示例代码：

```
' 1. 引入Microsoft XML v6.0库
' 2. 创建一个XMLHTTP对象
Dim xhr As XMLHTTP
Set xhr = New XMLHTTP

' 3. 设置请求的URL、方法，以及是否异步等
xhr.Open "GET", "<?php echo $api_url; ?>?key=<?php echo $user_key; ?>", False

' 4. 发送请求
xhr.send

' 5. 获取响应结果
Dim responseText As String
responseText = xhr.responseText

' 6. 输出响应结果
Debug.Print responseText

' 7. 释放资源
Set xhr = Nothing
```

在这个示例中，我们创建了一个XMLHTTP对象，用于请求API接口。我们先调用`open`方法来设置请求的URL、方法，以及是否异步。然后，我们发送请求，并使用`responseText`属性来获取响应结果。最后，我们将响应结果打印到控制台，完成操作后释放资源，以防止内存泄漏。请注意，以上示例代码为同步请求，如果想使用异步请求，需要设置第三个参数为`True`，并在请求结束时处理`OnReadyStateChange`事件。
</code></pre>
                                    </div>
                                </div>
                            </div>
                            <?php if ($api_arr['debug']) : ?>
                                <div class="tab-pane fade fade" id="debug">
                                    <div class="form-inline mb-3" style="width:100%;" id="apibody">
                                        <span id="api-type">
                                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="api-type-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:72px;">
                                                <font style="vertical-align: initial;">
                                                    <font style="vertical-align: initial;" id="type-text"><?php echo $api_arr['method'] == 'REQUEST' ? 'GET' : $api_arr['method']; ?> </font>
                                                </font>
                                            </button>
                                            <div id="method" class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                <?php if ($api_arr['method'] == 'REQUEST') : ?>
                                                    <a class="dropdown-item" id="GET" href="javascript:void(0);">GET</a>
                                                    <a class="dropdown-item" id="POST" href="javascript:void(0);">POST</a>
                                                <?php else : ?>
                                                    <a class="dropdown-item" id="<?php echo $api_arr['method'] ?>" href="javascript:void(0);"><?php echo $api_arr['method'] ?></a>
                                                <?php endif; ?>
                                            </div>
                                        </span>
                                        <span class="mx-3" id="api-url">
                                            <input id="api-url-text" class="form-control form-control-sm my-2" type="text" style="width:500px;height:33px;" value="<?php echo $api_url; ?>" disabled>
                                        </span>
                                        <span class="api-actions">
                                            <button class="btn btn-sm btn-success" type="button" id="api-get"><i class="fas fa-location-arrow"></i> 发起请求</button>
                                            <div class="form-check form-check-inline ms-3 <?php if ($api_arr['method'] == 'POST') echo 'd-inline-flex'; ?>" style="display: none;" id="json_send_div">
                                                <input type="checkbox" class="form-check-input" id="json_send">
                                                <label class="form-check-label ms-2" for="json_send">JSON提交</label>
                                            </div>
                                        </span>
                                    </div>
                                    <div id="status"></div>
                                    <div id="reqkey">
                                        <label for="name" class="font-weight-bold text-primary">填写参数：</label><button type="button" class="btn btn-primary btn-sm mx-2 mb-2" id="add_key">增加参数</button>
                                        <table class="table table-condensed table-bordered table-hover table-sm">
                                            <thead>
                                                <tr>
                                                    <th>参数名</th>
                                                    <th>填写参数值</th>
                                                </tr>
                                            </thead>
                                            <tbody id="api-reqkey">
                                                <tr>
                                                    <td><input class="form-control form-control-sm" placeholder="参数名" value="key" type="text" id="key_name"></td>
                                                    <td><input class="form-control form-control-sm" placeholder="请求密钥key" value="<?php echo $user_key; ?>" type="text" id="key_value"></td>
                                                </tr>
                                                <?php
                                                if (json_decode($api_arr['req'])) {
                                                    foreach (json_decode($api_arr['req']) as $k => $v) {
                                                        echo '<tr>
                                                        <td><input class="form-control form-control-sm" placeholder="参数名" value="' . $k . '" type="text" id="key_name"></td>
                                                        <td><input class="form-control form-control-sm" placeholder="' . $v . '" value="" type="text" id="key_value"></td>
                                                    </tr>';
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="resbody" style="display:none">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#res">请求结果</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#req-h">请求头</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#res-h">响应头</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#req-url">完整URL</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane show fade active" id="res">
                                                <pre class="p-3 well bg-gray-100 pre-scrollable" id="resjson">
                                                </pre>
                                            </div>
                                            <div class="tab-pane fade fade" id="req-h">
                                                <div class="p-3 well bg-gray-100 pre-scrollable" id="req-header">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade fade" id="res-h">
                                                <div class="p-3 well bg-gray-100 pre-scrollable" id="res-header">
                                                </div>
                                            </div>
                                            <div class="tab-pane fade fade" id="req-url">
                                                <div class="p-3 well bg-gray-100 pre-scrollable" id="req-url-str">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if (get_set('comment_set') == 'on') : ?>
                                <div class="tab-pane fade fade" id="comments">
                                    <div class="card mb-3" id="comments">
                                        <div class="card-header font-weight-bold py-2 d-flex justify-content-between flex-row align-items-center">
                                            <div class="float-left d-flex align-items-center">
                                                评论<span class="badge bg-danger-subtle small rounded-2 p-1 text-danger ms-2"><?php echo count($api_comment); ?></span>
                                            </div>
                                            <?php if (isset($_SESSION['UID'])) : ?>
                                                <div class="float-right d-flex align-items-center">
                                                    <img class="me-2 img-profile rounded-circle user-img" src="<?php echo $user_img; ?>">
                                                    <span class="me-2 fw-normal"><?php echo $userarr['name']; ?></span><?php echo $user_icon; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="card-body pt-3">
                                            <?php if (!isset($_SESSION['UID'])) : ?>
                                                <div class="align-items-center justify-content-between text-center mt-3 mb-5">
                                                    <img class="me-2 img-profile rounded-circle user-img" src="/user/img/undraw_profile.svg">未登录<p class="mt-3">
                                                        请 <a href="/user/login?url=/doc/<?php echo $_GET['id']; ?>#comments">登录</a> 后发表评论
                                                    </p>
                                                </div>
                                            <?php else : ?>
                                                <div class="comt-box mb-4">
                                                    <form id="comment_form">
                                                        <textarea placeholder="发表你的评论..." class="input-block-level comt-area" name="content" id="content" cols="100%"></textarea>
                                                        <div class="comt-ctrl">
                                                            <div class="d-flex justify-content-between flex-row">
                                                                <div class="form-check float-left d-flex align-items-center ms-2">
                                                                    <?php if (get_set('comment_email') == 'on') : ?>
                                                                        <input type="checkbox" class="form-check-input mt-0" id="comment_form_email">
                                                                        <label class="form-check-label small ms-2" for="reply-email">有人回复时邮件通知我</label>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="text" class="d-none" name="parent" value="0">
                                                                <button class="btn btn-primary float-end d-flex align-items-center px-3 py-1 border-0 rounded-0" type="button" id="comment_post" post_type="comment_form">提交评论</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
                                            <div class="commentlist my-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="sub-title">仅需三步即可快速接入</h3>
            <div class="row gx-xxl-5">
                <div class="col-lg-4 col-sm-6">
                    <div class="block-style-sixteen d-flex mt-30 md-mt-20">
                        <div class="numb tran3s">
                            1
                        </div>
                        <div class="text">
                            <h6>在线调试</h6>
                            <p>
                                填写业务相关参数免费在线调试
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="block-style-sixteen d-flex mt-30 md-mt-20">
                        <div class="numb tran3s">
                            2
                        </div>
                        <div class="text">
                            <h6>生成代码</h6>
                            <p>
                                生成符合你的开发语言代码，复制即可
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="block-style-sixteen d-flex mt-30 md-mt-20">
                        <div class="numb tran3s">
                            3
                        </div>
                        <div class="text">
                            <h6>业务上线</h6>
                            <p>
                                调整你后端部分逻辑代码即可上线使用
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($_SESSION['UID'])) : ?>
    <link href="/user/css/pay.css" rel="stylesheet" type="text/css">
    <div class="modal fade" id="shop-pay" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">服务开通与购买</h6>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="pay-list">
                        <?php if ($api_arr['vip_on']) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $api_arr['vip_on'] ? 'active' : ''; ?>" data-bs-toggle="tab" data-bs-target="#vip" type="button" role="tab" aria-controls="vip" aria-selected="true" href="#vip">包年包月</a>
                            </li>
                        <?php endif; ?>
                        <?php if ($api_arr['point_number_on']) : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo ($api_arr['point_number_on'] && !$api_arr['vip_on']) ? 'active' : ''; ?>" data-bs-toggle="tab" data-bs-target="#point_number" type="button" role="tab" aria-controls="point_number" aria-selected="false" href="#point_number">次数包</a>
                            </li>
                        <?php endif; ?>
                        <?php if ($api_arr['allvip_on']  && get_set('admin_allvip_on') == 'on') : ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo (!$api_arr['vip_on'] && !$api_arr['point_number_on']) ? 'active' : ''; ?>" data-bs-toggle="tab" data-bs-target="#allvip" type="button" role="tab" aria-controls="allvip" aria-selected="false" href="#allvip"><i class="fab fa-vimeo-v me-1"></i><?php echo get_set('allvip_name'); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($api_arr['point_on'] && get_set('admin_point_on') == 'on') : ?>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#pointpay" type="button" role="tab" aria-controls="pointpay" aria-selected="false" href="#pointpay">点数充值</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <div class="tab-content p-3">
                        <?php if ($api_arr['vip_on']) : ?>
                            <div class="tab-pane fade <?php echo $api_arr['vip_on'] ? 'show active' : ''; ?>" id="vip">
                                <p class="mb-3">
                                    <span class="title">产品名称：<?php echo $api_arr['name'] ?></span>
                                    <span class="d-flex">选择包月服务开通时长：</span>
                                </p>
                                <div class="goods_box_xz">
                                    <div id="month" class="goods_box_leng goods_box_leng_xz shadow border-warning" type="vip_y_num">
                                        <div>一年 <span class="badge badge-warning">限时特惠</span></div>
                                        <div style="margin-top: 13px;"><span>￥</span><?php echo round($api_arr['vip_y_num']) ?></div>
                                        <div>年付优惠</div><img id="svipxz" src="/user/img/xz.png">
                                    </div>
                                    <div id="month" class="goods_box_leng" type="vip_j_num">
                                        <div>一季度 <span class="badge badge-danger">折扣</span></div>
                                        <div style="margin-top: 13px;"><span>￥</span><?php echo round($api_arr['vip_j_num']) ?></div>
                                        <div>限时折扣</div><img id="yearxz" style="display: none;" src="/user/img/xz.png">
                                    </div>
                                    <div id="month" class="goods_box_leng" type="vip_m_num">
                                        <div>一个月 <span class="badge badge-danger">热门</span></div>
                                        <div style="margin-top: 13px;"><span>￥</span><?php echo round($api_arr['vip_m_num']) ?></div>
                                        <div>经济实惠</div><img id="monthxz" style="display: none;" src="/user/img/xz.png">
                                    </div>
                                </div>
                                <small class="title mb-0 mt-4">注：本页面开通的是当前产品单独的包年包月服务，不是全部产品。</small>
                            </div>
                        <?php endif; ?>
                        <?php if ($api_arr['point_number_on']) : ?>
                            <div class="tab-pane fade <?php echo ($api_arr['point_number_on'] && !$api_arr['vip_on']) ? 'show active' : ''; ?>" id="point_number">
                                <p class="mb-3">
                                    <span class="title">产品名称：<?php echo $api_arr['name'] ?></span>
                                    <span class="d-flex">选择次数包规格：</span>
                                </p>
                                <div class="goods_box_xz">
                                    <?php
                                    $shop = explode("\n", $api_arr['point_number_list']);
                                    foreach ($shop as $i => $value) {
                                        $shop_arr = explode('-', $value);
                                        $dsum = round($shop_arr[1] / $shop_arr[0], 3);
                                        if ($i == 0) {
                                            echo '<div id="month" class="goods_box_leng goods_box_leng_xz shadow border-warning" type="' . $shop_arr[0] . '">
                                            <div>' . $shop_arr[0] . '次 <span class="badge badge-danger">' . day_to_str($shop_arr[2]) . '有效</span></div>
                                            <div style="margin-top: 13px;"><span>￥</span>' . $shop_arr[1] . '</div>
                                            <div>低至' . $dsum . '/次</div><img id="yearxz" src="/user/img/xz.png">
                                        </div>';
                                        } else {
                                            echo '<div id="month" class="goods_box_leng" type="' . $shop_arr[0] . '">
                                            <div>' . $shop_arr[0] . '次 <span class="badge badge-danger">' . day_to_str($shop_arr[2]) . '有效</span></div>
                                            <div style="margin-top: 13px;"><span>￥</span>' . $shop_arr[1] . '</div>
                                            <div>低至' . $dsum . '/次</div><img id="yearxz" style="display: none;" src="/user/img/xz.png">
                                        </div>';
                                        }
                                    }
                                    ?>
                                </div>
                                <small class="title mb-0 mt-4">注：次数包仅限当前产品抵扣，请在次数包有效期内使用，过期失效概不退款。</small>
                            </div>
                        <?php endif; ?>
                        <?php if ($api_arr['allvip_on'] && get_set('admin_allvip_on') == 'on') : ?>
                            <div class="tab-pane fade <?php echo (!$api_arr['vip_on'] && !$api_arr['point_number_on']) ? 'show active' : ''; ?>" id="allvip">
                                <p class="mb-3">
                                    <span class="vip-icon" title="<?php echo get_set('allvip_name'); ?>"><i class="fab fa-vimeo-v me-1"></i><?php echo get_set('allvip_name'); ?></span>
                                </p>
                                <p class="mb-3 title">
                                    选择<?php echo ($userarr['group'] == 2) ? '续费' : '开通' ?>时长：
                                </p>
                                <div class="goods_box_xz">
                                    <div id="month" class="goods_box_leng goods_box_leng_xz shadow border-warning" type="svip">
                                        <div>永久会员 <span class="badge badge-warning">限时特惠</span></div>
                                        <div style="margin-top: 13px;"><span>￥</span><?php echo round(get_set('vip_svip_price')) ?></div>
                                        <div>内测折扣价</div><img id="svipxz" src="/user/img/xz.png">
                                    </div>
                                    <div id="month" class="goods_box_leng" type="year">
                                        <div>一年（12个月）<span class="badge badge-danger">折扣</span></div>
                                        <div style="margin-top: 13px;"><span>￥</span><?php echo round(get_set('vip_year_price')) ?></div>
                                        <div>年付优惠</div><img id="yearxz" style="display: none;" src="/user/img/xz.png">
                                    </div>
                                    <div id="month" class="goods_box_leng" type="month">
                                        <div>一个月 <span class="badge badge-danger">热门</span></div>
                                        <div style="margin-top: 13px;"><span>￥</span><?php echo round(get_set('vip_month_price')) ?></div>
                                        <div>经济实惠</div><img id="monthxz" style="display: none;" src="/user/img/xz.png">
                                    </div>
                                </div>
                                <small class="title mb-0 mt-4">注：<?php echo get_set('allvip_name'); ?>一经购买，概不退款。<?php echo get_set('allvip_name'); ?>权益如未使用，逾期作废。<?php echo get_set('allvip_name'); ?>指标注<?php echo get_set('allvip_name'); ?>免费的产品，不支持<?php echo get_set('allvip_name'); ?>的产品无法免费。
                                    <?php if (get_set('vip_type_show') == 'on') : ?>
                                        <a class="link-danger" href="/type/vip" target="_blank">前往<?php echo get_set('allvip_name'); ?>专区</a>
                                    <?php endif; ?>
                                </small>
                            </div>
                        <?php endif; ?>
                        <?php if ($api_arr['point_on'] && get_set('admin_point_on') == 'on') : ?>
                            <div class="tab-pane fade" id="pointpay">
                                <p class="mb-3">
                                    <span class="text-gray-800">定价：<code><?php echo get_set('point_price'); ?> 元／点</code></span>
                                </p>

                                <p class="mb-3">
                                    输入充值金额：
                                </p>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text fw-bold">¥</span>
                                    </div>
                                    <input type="text" class="form-control" id="amount" value="<?php echo get_set('point_price_min') ?>" style="max-width:100px;" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">元</span>
                                    </div>
                                    <input type="text" class="form-control" id="point_price_text" value="<?php echo get_set('point_price_min') / get_set('point_price') ?>" style="max-width:100px;margin-left: -1px;" onkeyup="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}" onafterpaste="if(this.value.length==1){this.value=this.value.replace(/[^1-9]/g,'')}else{this.value=this.value.replace(/\D/g,'')}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">点</span>
                                    </div>
                                </div>
                                <div id="payinfo" class="invalid-feedback"></div>
                                <p class="my-3 mt-4">
                                    金额：<span class="h5 font-weight-bolder text-primary" id="amount-text"><i class="fas fa-yen-sign"></i> <?php echo get_set('point_price_min') ?></span>
                                </p>
                                <small class="title mb-0 mt-4">注：点数仅支持标注为按量计费的产品抵扣。</small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="modal-footer" style="display: inline;">
                    <span style="float:right;">
                        <input class="btn btn-success me-3" type="button" id="pay_get" paytype="" payint="" value="去付款">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
    <?php if (isset($_SESSION['UID'])) : ?>
        const myModalEl = document.getElementById('shop-pay')
        myModalEl.addEventListener('shown.bs.modal', event => {
            $("#pay-list > li:nth-child(1) > a").click();
            new bootstrap.Tab('#pay-list > li:nth-child(1) > a').show()
        })
        $('#shop-pay a').click(function() {
            //console.log($(this).attr('aria-controls'));
            $("#pay_get").attr('paytype', $(this).attr('aria-controls'));
            $("#" + $(this).attr('aria-controls')).find('div > #month:nth-child(1)').click();
            if ($(this).attr('aria-controls') == 'pointpay') {
                $("#pay_get").attr('payint', $('#amount').val());
            }
        });
        $("[id='month']").click(function() {
            $("#pay_get").attr('payint', $(this).attr('type'));
        });
    <?php endif; ?>
    $("#shop").click(function() {
        <?php if (!isset($_SESSION['UID'])) : ?>
            window.location.href = '/user/login?url=/doc/<?php echo $api_arr['id'] ?>';
        <?php else : ?>
            const myModal = new bootstrap.Modal('#shop-pay', {
                keyboard: false
            })
            myModal.show();
        <?php endif; ?>
    });
    $("#pay_get").click(function() {
        window.open('/user/pay?type=' + $(this).attr('paytype') + '&payint=' + $(this).attr('payint') + "&api_id=<?php echo $api_arr['id']; ?>");
    });
    $('#amount').bind('input propertychange', function() {
        if ($(this).val() < <?php echo get_set('point_price_min') ?>) {
            $("#payinfo").html('充值金额必须大于<?php echo get_set('point_price_min') ?>元');
            $("#payinfo").css({
                "display": "block"
            });

        } else {
            $("#point_price_text").val($(this).val() / <?php echo get_set('point_price') ?>);
            $("#amount-text").html('<i class="fas fa-yen-sign"></i> ' + $(this).val());
            $("#payinfo").css({
                "display": "none"
            });
            <?php if (get_set("cps_pay_on") == 'on') : ?>
                set_point_cps();
            <?php endif; ?>
            $("#pay_get").attr('payint', $(this).val());
        }
    });
    $('#point_price_text').bind('input propertychange', function() {
        if ($(this).val() * <?php echo get_set('point_price') ?> < <?php echo get_set('point_price_min') ?>) {
            $("#payinfo").html('充值金额必须大于<?php echo get_set('point_price_min') ?>元');
            $("#payinfo").css({
                "display": "block"
            });

        } else {
            $("#amount").val(parseFloat(($(this).val() * <?php echo get_set('point_price') ?>).toFixed(2)).toString());
            $("#amount-text").html('<i class="fas fa-yen-sign"></i> ' + $("#amount").val());
            $("#payinfo").css({
                "display": "none"
            });
            <?php if (get_set("cps_pay_on") == 'on') : ?>
                set_point_cps();
            <?php endif; ?>
            $("#pay_get").attr('payint', $('#amount').val());
        }

    });
    $(function() {
        if ($(window).width() < 768) {
            var div1 = $('#panel_list');
            var div2 = $('#doc_body');
            div1.before(div2);
            var doc_body = $('#doc_body > div > div:eq(1)');
            doc_body.removeClass('mb-100');
            doc_body.addClass('mb-25');
        }
        <?php if (get_set("cps_pay_on") == 'on') : ?>
            set_point_cps();
        <?php endif; ?>
    });

    function set_point_cps() {
        var json = <?php echo $cps_pay_int_json; ?>;
        var point = $("#point_price_text").val();
        var cps_arr = [];
        $.each(json, function(index, val) {
            //console.log(val);
            if (point >= val[0] && point <= val[1]) {
                cps_arr = val;
                return true;
            }
        });
        console.log(cps_arr);
        if (cps_arr.length > 0) {
            $("#payinfo").html('充值已满 ' + (cps_arr[0] * <?php echo get_set('point_price') ?>) + '元，赠送 ' + parseInt(point * cps_arr[2]) + ' 点');
            $("#payinfo").css({
                "display": "block"
            });
        }
    }
</script>
<style>
    .ms-25 {
        margin-left: 2.5rem !important;
    }

    .pl-25 {
        padding-left: 2.5rem !important;
    }

    .comt-ctrl {
        background-color: #fbfbfb;
        height: auto;
        margin-left: -4px;
        border-top: solid 1px #e8e8e8;
    }

    .comt-box {
        border: 1px solid #e8e8e8;
        border-radius: 2px;
        padding: 4px 0 0 4px;
        background-color: #fff;
        position: relative;
    }

    #content {
        width: 100%;
        resize: none;
        overflow-x: hidden;
        overflow-y: auto;
        border: none;
        line-height: 22px;
        outline: 0;
        color: #666;
        height: 68px;
    }

    #comments img {
        width: 32px;
        height: 32px;
    }

    .comment-reply img {
        width: 24px !important;
        height: 24px !important;
    }

    #resjson-demo::-webkit-scrollbar,
    .doc-overflow::-webkit-scrollbar,
    .pre-scrollable::-webkit-scrollbar {
        width: 3px;
        height: 3px;
    }

    @media screen and (max-width: 1000px) {

        #api-type-btn,
        #api-type,
        #api-url,
        #api-url-text,
        .api-actions,
        #api-get,
        #api-list {
            width: 100% !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
    }

    .form-inline {
        display: flex;
        flex-flow: row wrap;
        align-items: center;
    }

    .pre-scrollable {
        max-height: 500px;
        overflow-y: scroll;
    }

    .well {
        font-size: 14px;
        line-height: 1.2;
        background-color: #f8f9fc;
        border: 1px solid #eee;
        border-radius: 5px;
        -webkit-box-shadow-sm: inset 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow-sm: inset 0 1px 1px rgba(0, 0, 0, .05);
    }

    #resjson:hover {
        background-color: rgba(255, 255, 255, 0.5);
        border: 1px solid #ddd;
        -webkit-box-shadow-sm: inset 0 1px 1px rgba(0, 0, 0, .1);
        box-shadow-sm: inset 0 1px 1px rgba(0, 0, 0, .1);
    }

    img {
        display: inline-block;
    }

    <?php if (json_decode($api_arr['res_demo'])) : ?>.pre-scrollable-demo {
        max-height: 340px;
        overflow-y: scroll;
    }

    .well-demo {
        font-size: 14px;
        line-height: 1.2;
        background-color: #f8f9fc;
        border: 1px solid #eee;
        border-radius: 5px;
        -webkit-box-shadow-sm: inset 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow-sm: inset 0 1px 1px rgba(0, 0, 0, .05);
    }

    #resjson-demo:hover {
        background-color: rgba(255, 255, 255, 0.5);
        border: 1px solid #ddd;
        -webkit-box-shadow-sm: inset 0 1px 1px rgba(0, 0, 0, .1);
        box-shadow-sm: inset 0 1px 1px rgba(0, 0, 0, .1);
    }

    <?php endif; ?>
</style>
<link rel="stylesheet" href="/user/js/prism.css">
<link rel="stylesheet" href="/user/js/common.css">
<script src="/user/js/jquery.jsonview.min.js"></script>
<script src="/user/js/prism.js"></script>
<script src="/user/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/user/vendor/jquery-easing/jquery.easing.min.js"></script>
<?php if ($userarr["apikey_check_type"] == 2) : ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
    <script>
        let SK = "<?php echo $userarr['apikey_check_sk']; ?>"
    </script>
<?php endif; ?>
<?php if (get_set('captcha_type') == 1) : ?>
    <script src="https://turing.captcha.qcloud.com/TCaptcha.js"></script>
<?php elseif (get_set('captcha_type') == 2) : ?>
    <script src="//static.geetest.com/v4/gt4.js"></script>
<?php endif; ?>
<script src="/user/js/cookie.min.js"></script>
<script src="/user/js/api.admin.js"></script>
<script>
    <?php echo json_decode($api_arr['res_demo']) ? "$(\"#resjson-demo\").JSONView('{$api_arr['res_demo']}');" : ''; ?>
    $('[link="collapse"]').click(function() {
        var ifupt = $(this).attr('aria-expanded');
        $(this).find('i').attr('class', '');
        if (ifupt == 'false') {
            $(this).find('i').addClass('fas fa-angle-down');
        } else if (ifupt == 'true') {
            $(this).find('i').addClass('fas fa-angle-right');
        }

    });
    $(function() {
        bodyheight_doc();
    });
    $(window).resize(function() {
        bodyheight_doc();
    });
    $("#add_key").click(function() {
        $("#api-reqkey").append('<tr><td><input class="form-control form-control-sm" placeholder="参数名" value="" type="text" id="key_name"></td><td><input class="form-control form-control-sm" placeholder="参数值" value="" type="text" id="key_value"></td></tr>');
    });
    $("#GET").click(function() {
        $.get("/user/echocode?type=method&url=" + $("#api-url-text").val(), function(data) {
            if (data != "GET" && data != "REQUEST") {
                swal({
                    text: "当前接口不支持\"GET\"方法！",
                    title: "请求失败！",
                    type: "error",
                    confirmButtonText: "我知道了"
                });
            } else {
                $("#type-text").html("GET ");
                $("#json_send_div").removeClass('d-inline-flex');
                $('#json_send').prop('checked', false);
            }
        });
    });
    $("#POST").click(function() {
        $.get("/user/echocode?type=method&url=" + $("#api-url-text").val(), function(data) {
            if (data != "POST" && data != "REQUEST") {
                swal({
                    text: "当前接口不支持\"POST\"方法！",
                    title: "请求失败！",
                    type: "error",
                    confirmButtonText: "我知道了"
                });
            } else {
                $("#type-text").html("POST ");
                $("#json_send_div").addClass('d-inline-flex');
            }
        });

    });
    $("#api-get").click(function() {
        $("#api-get").attr('disabled', true);
        $("#api-get").html('请求中..');
        $("#req-header").html('Content-Type: application/x-www-form-urlencoded<br>User-Agent: ' + navigator.userAgent);
        $("#status").show();
        $("#resbody").show();

        if ($("#type-text").html() == "GET ") {
            var reqtype = "GET";
        }
        if ($("#type-text").html() == "POST ") {
            var reqtype = "POST";
        }

        Pace.track(function() {
            //加载进度
            var req = '';
            var reqjson = '';
            var value = [];
            var ajaxdata;
            var ajaxtype;
            $("[id='key_value']").each(function() {
                value.push($(this).val());
            });
            var i = 0;
            $("[id='key_name']").each(function() {
                console.log($(this).index(this));
                reqjson += '"' + $(this).val() + '":"' + encodeURIComponent(value[i]) + '",';
                req += $(this).val() + "=" + value[i] + "&";
                i++;
            });
            req = req.substr(0, req.length - 1);
            if ($('#json_send').prop('checked')) {
                ajaxdata = '{' + reqjson.substr(0, reqjson.length - 1) + '}';
                ajaxtype = 'application/json';
            } else {
                ajaxdata = req;
                ajaxtype = 'application/x-www-form-urlencoded';
            }
            $("#req-header").html('Content-Type: ' + ajaxtype + '<br>User-Agent: ' + navigator.userAgent);
            var allurl = $("#api-url-text").val() + "?" + req;
            // 记录请求开始时间
            var startTime = new Date().getTime();
            $.ajax({
                url: $("#api-url-text").val(),
                data: ajaxdata,
                type: reqtype,
                contentType: ajaxtype,
                timeout: 100000,
                <?php if ($userarr['apikey_check_type'] == 2) : ?>
                    headers: {
                        "sign": CryptoJS.MD5(req + SK).toString()
                    },
                <?php endif; ?>
                success: function(data, status, xhr) {
                    //console.log(xhr.getAllResponseHeaders());
                    //console.log(xhr.getResponseHeader("Content-Type"));
                    //console.log(xhr.status);
                    //console.log(xhr.statusText);
                    //console.log(xhr);
                    //console.log(status);
                    // 记录请求结束时间
                    var endTime = new Date().getTime();
                    // 计算耗时（毫秒）
                    var duration = endTime - startTime;
                    $("#status").attr('class', '');
                    $("#status").attr('class', 'alert alert-success mt-2 p-2 mb-4');
                    $("#status").html('请求成功：' + xhr.status + " " + status + '  耗时：' + duration + ' 毫秒');
                    var ContentType = xhr.getResponseHeader("Content-Type");
                    if (ContentType.indexOf("json") == -1) {
                        if (ContentType.indexOf("text") != -1) {
                            $("#resjson").text(data);
                        } else if (ContentType.indexOf("image") != -1) {
                            $("#resjson").html('<img src="' + allurl + '">');
                        } else if (ContentType.indexOf("video") != -1) {
                            $("#resjson").html('<video autoplay="autoplay" controls="controls" width="100%" src="' + allurl + '"></video>');
                        } else if (ContentType.indexOf("audio") != -1) {
                            $("#resjson").html('<audio autoplay="autoplay" controls="controls" src="' + allurl + '"></audio>');
                        } else {
                            $("#resjson").text('无法显示的数据类型：' + ContentType);
                        }

                    } else {
                        $("#resjson").JSONView(data);
                    }

                    $("#res-header").html(xhr.getAllResponseHeaders().replace(/\n/g, "<br>"));
                    $("#api-get").attr('disabled', false);
                    $("#api-get").html('<i class="fas fa-location-arrow"></i> 发起请求');
                },
                error: function(event, xhr, options) {
                    // 记录请求结束时间
                    var endTime = new Date().getTime();
                    // 计算耗时（毫秒）
                    var duration = endTime - startTime;
                    console.log(event.getAllResponseHeaders());
                    console.log(event.getResponseHeader("Content-Type"));
                    console.log(event.status);
                    console.log(event);
                    console.log(event.statusText);
                    $("#status").attr('class', '');
                    $("#status").attr('class', 'alert alert-danger mt-2 p-2 mb-4');
                    $("#status").html(event.status + " " + event.statusText + '  耗时：' + duration + ' 毫秒');
                    if (event.status == 0) {
                        swal({
                            text: "当前接口可能不支持调试，你可以直接在浏览器地址访问试试！",
                            title: "请求失败！",
                            type: "error",
                            confirmButtonText: "我知道了"
                        });
                        $("#resbody").hide();
                    }
                    var ContentType = event.getResponseHeader("Content-Type");
                    if (ContentType != null && ContentType.indexOf("json") != -1) {
                        $("#resjson").JSONView(event.responseJSON);
                    }

                    $("#res-header").html(event.getAllResponseHeaders().replace(/\n/g, "<br>"));
                    $("#api-get").attr('disabled', false);
                    $("#api-get").html('<i class="fas fa-location-arrow"></i> 发起请求');
                }
            });

            $("#req-url-str").html('<a target="_blank" href="' + allurl + '">' + allurl + '</a>');
        });
    });

    function eommcheck(comment_id, comment_type) {
        if (comment_type == 'reply') {
            var strVar = "";
            strVar += "<div class=\"comt-box mb-3 ms-25\" style=\"display: none;\" id=\"body_comment_form_reply_" + comment_id + "\">";
            strVar += "    <form id=\"comment_form_reply_" + comment_id + "\">";
            strVar += "        <textarea placeholder=\"回复内容...\" class=\"input-block-level comt-area\" name=\"content\" id=\"content\" cols=\"100%\"><\/textarea>";
            strVar += "    <div class=\"comt-ctrl\">";
            strVar += "        <div class=\"d-flex justify-content-between flex-row\">";
            strVar += "            <div class=\"form-check float-left d-flex align-items-center ms-2\">";
            <?php if (get_set('comment_email') == 'on') : ?>
                strVar += "                <input type=\"checkbox\" class=\"form-check-input mt-0\" id=\"comment_form_reply_" + comment_id + "_email\">";
                strVar += "                <label class=\"form-check-label small ms-2\" for=\"reply-email\">有人回复时邮件通知我<\/label>";
            <?php endif; ?>
            strVar += "            <\/div>";
            strVar += "            <input type=\"text\" class=\"d-none\" name=\"parent\" value=\"" + comment_id + "\">";
            strVar += "            <button class=\"btn btn-primary float-right d-flex align-items-center px-3 py-1 border-0 rounded-0\" type=\"button\" id=\"comment_post\" post_type=\"comment_form_reply_" + comment_id + "\">提交回复<\/button>";
            strVar += "        <\/div>";
            strVar += "    <\/div>";
            strVar += "    <\/form>";
            strVar += "<\/div>";
            if ($("#body_comment_form_reply_" + comment_id).length == 0) {
                $("#comment_" + comment_id).append(strVar);
            }

            $("#body_comment_form_reply_" + comment_id).slideToggle(100);
        }
        if (comment_type == 'likes') {
            var cookiename = 'comment_id_' + comment_id;
            if (cookie.get(cookiename) != 1) {
                $.post("/user/comment", {
                    type: 'likes',
                    id: comment_id
                }, function(data) {
                    if (data.code !== 200) {
                        swal("出错啦", data.msg, "error");
                    } else {
                        cookie.set("comment_id_" + comment_id, 1);
                        swal("点赞成功！", data.msg, "success");
                        get_comment_html();
                    }
                });
            } else {
                swal("你已赞！", '', "error");
            }
        }
        if (comment_type == 'del') {
            $.post("/user/comment", {
                type: 'del',
                id: comment_id
            }, function(data) {
                if (data.code !== 200) {
                    swal("出错啦", data.msg, "error");
                } else {
                    swal("删除成功！", data.msg, "success");
                    get_comment_html();
                }
            });
        }
        comment_post_chick();
    }

    function comment_post_chick() {
        $("[id='comment_post'").unbind('click');
        $("[id='comment_post'").click(function() {
            var type = $(this).attr("post_type");
            var api_id = <?php echo $api_arr['id']; ?>;
            if ($("#" + type + ">textarea").val().length < 10) {
                swal({
                    text: "请输入不少于10个字符的评论！",
                    title: "出错啦",
                    type: "error",
                    confirmButtonText: "确定"

                });
                throw SyntaxError();
            }
            <?php if (get_set('captcha') == 'on') : ?>
                <?php if (get_set('captcha_type') == 1) : ?>
                    var captcha = new TencentCaptcha('<?php echo get_set("tcloud_captcha_Appid"); ?>', function(res) {
                        if (res.ret === 0) {
                            comment_post(res, type);
                        }
                    });
                    captcha.show();
                <?php elseif (get_set('captcha_type') == 2) : ?>
                    initGeetest4({
                        captchaId: '<?php echo get_set("geetest_captcha_id"); ?>',
                        product: 'bind'
                    }, function(captchaObj) {
                        captchaObj.onReady(function() {
                            captchaObj.showCaptcha();
                        }).onSuccess(function() {
                            var res = captchaObj.getValidate();
                            //console.log(res);
                            comment_post(res, type);
                            captchaObj.reset()
                        }).onError(function() {
                            //err code
                        })
                    });
                <?php elseif (get_set('captcha_type') == 0) : ?>
                    swal({
                        title: '请填写下图验证码：',
                        html: '<img src="/user/captcha_img" class="w-100 my-3 rounded" id="captcha_img"><br><input id="swal-input1" placeholder="请填写验证码" class="swal2-input my-0" autofocus>',
                        preConfirm: function() {
                            return new Promise(function(resolve) {
                                resolve([
                                    $('#swal-input1').val(),
                                ]);
                            });
                        }
                    }).then(function(result) {
                        if (result[0].length == 6) {
                            comment_post([result[0]], type);
                        } else {
                            swal('验证码输入错误！', '', 'error');
                        }
                    });
                    $("#captcha_img").click(function() {
                        $(this).attr("src", "/user/captcha_img");
                    });
                <?php endif; ?>
            <?php else : ?>
                comment_post(null, type);
            <?php endif; ?>

            function comment_post(res = [], type) {
                //console.log(res);
                var codearr = {
                    <?php if (get_set('captcha') == 'on') : ?>
                        <?php if (get_set('captcha_type') == 1) : ?>
                            ket: res.ticket,
                            rand: res.randstr,
                        <?php elseif (get_set('captcha_type') == 2) : ?>
                            lot_number: res.lot_number,
                            captcha_output: res.captcha_output,
                            pass_token: res.pass_token,
                            gen_time: res.gen_time,
                        <?php elseif (get_set('captcha_type') == 0) : ?>
                            captcha: res[0],
                        <?php endif; ?>
                    <?php endif; ?>
                };
                $("#" + type + ">div>div>button").attr('disabled', true);
                $("#" + type + ">div>div>button").html("正在提交");
                var ifemail = $("#" + type + "_email").prop('checked') ? '1' : '0';
                var from = $("#" + type).serialize() + "&api_id=" + api_id + "&ifemail=" + ifemail + "&type=comment_post&" + $.param(codearr);
                $.post(
                    "/user/comment", from,
                    function(data) {
                        if (data.code !== 200) {
                            swal("评论失败！", data.msg, "error");
                            $("#" + type + ">div>div>button").removeAttr("disabled");
                            $("#" + type + ">div>div>button").html("提交评论");
                        } else {
                            swal("评论成功！", data.msg, "success");
                            $("#" + type + ">div>div>button").removeAttr("disabled");
                            $("#" + type + ">div>div>button").html("提交评论");
                            get_comment_html();
                        }
                    }
                );
            }
        });
    }

    function get_comment_html() {
        $.get("/user/comment.list?id=<?= $_GET['id'] ?>", function(data) {
            $(".commentlist").html(data);
        });
    }
    $(function() {
        get_comment_html();
        comment_post_chick();
    });

    function bodyheight_doc() {
        if (window.innerWidth >= 1200) {
            $(".doc-overflow").css("max-height", $(".wrapper").outerHeight() - 65 + "px");
            $("[for='reply-email'").each(function() {
                $(this).html('有人回复时邮件通知我');
            });
            $("[for='reply-img'").each(function() {
                $(this).css({
                    'display': 'block'
                });
            });
            $("[for='reply-time'").each(function() {
                $(this).css({
                    'display': 'block'
                });
            });
            $(".pl-25").each(function() {
                $(this).css('cssText', 'padding-left:2.5rem!important');
            });
            $(".ms-25").each(function() {
                $(this).css('cssText', 'margin-left:2.5rem!important');
            });
            $("#comments .admin-icon").css({
                'display': 'block'
            });
            $("#comments>div").removeClass('px-0');
        } else {
            $(".doc-overflow").css("max-height", "auto");
            $(".doc-overflow").css("height", "auto");
            $("[for='reply-email'").each(function() {
                $(this).html('邮件通知我');
            });
            $("[for='reply-img'").each(function() {
                $(this).css({
                    'display': 'none'
                });
            });
            $("[for='reply-time'").each(function() {
                $(this).css('cssText', 'display:none!important');
            });
            $(".pl-25").each(function() {
                $(this).css('cssText', 'padding-left:0px!important');
            });
            $(".ms-25").each(function() {
                $(this).css('cssText', 'margin-left:0px!important');
            });
            $("#comments .admin-icon").css({
                'display': 'none'
            });
            $("#comments>div").addClass('px-0');
        }
    }
    $("#btn-beta").click(function() {
        $.post('api.post', 'type=post_num&id=<?php echo $_GET['id']; ?>', function(res) {
            if (res.code == 200) {
                $("#btn-beta").attr('disabled', true);
                $("#btn-beta").text('已申请试用');
                //$(".api-pp").html('申请次数：' + res.data);
                swal("提示", res.msg, "success");
            } else {
                swal("提示", res.msg, "error");
            }
        });
    });
    $("#doc tbody").each(function(index, item) {
        var w = $("#doc").width();
        if ($(this).width() > w) {
            $(this).css('width', w);
            $(this).css('display', 'block');
            $(this).css('overflow-y', 'auto');
        }

        if (index == 3) {
            return true;
        }
    });
</script>
<script src="/user/js/sweetalert2.3.3.8.pro.min.js"></script>
<script src="/user/js/common.js"></script>