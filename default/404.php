<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>页面不存在-<?php echo get_set('web_name'); ?></title>
    <link href="/user/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/user/css/fonts.css" rel="stylesheet">
    <link href="/user/css/api.admin.css" rel="stylesheet">
    <style>
        @media (max-width: 1200px) {
            .card {
                width: 100% !important;
            }
        }

        @media (max-height: 600px) {
            .container-fluid {
                display: block !important;
            }
        }

        .card-header {
            padding: 0.2rem 0.5rem !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid w-100 overflow-auto" style="height: calc(100vh - 51px);display: flex;align-items: center">
        <div class="text-center card shadow-sm mb-5" style="width: 55%;margin: 0 auto;">
            <div class="error mx-auto" data-text="404" style="width: 18rem;font-size: 10rem;">
                404
            </div>
            <p class="text-gray-800 mb-5" style="font-size:2rem;font-weight:300;">
                你要找的页面不存在喔...
            </p>
            <small class="form-text text-muted" style="padding: 0 20px;">您可以将以上错误信息发送给管理员进行排查修复。</small>
            <a href="/" class="btn btn-outline-primary my-5" style="margin: 0 auto;">返回首页</a>
        </div>
    </div>
    <footer class="py-3 bg-white shadow-sm" style="bottom: 0;position: absolute;width: 100%;">
        <div class="container my-auto">
            <div class="small copyright text-center my-auto">
                <span>Copyright &copy; <?php echo date("Y") ?> <span class="text-uppercase"><a href="<?php echo get_set('web_url'); ?>" target="_blank"><?php echo get_set('web_name'); ?></a></span> All Rights Reserved.</span>
            </div>
        </div>
    </footer>
</body>

</html>