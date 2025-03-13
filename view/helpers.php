<?php

function renderView($view, $data = [], $title = "My App")
{
    extract($data);
    ob_start();
    require $view;
    $content = ob_get_clean();

    // Kiểm tra nếu user đã đăng nhập
    $layout = "view/layouts/master_user.php"; // Mặc định là layout user
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
        $layout = "view/layouts/master_admin.php"; // Nếu là admin thì load layout admin
    }

    require $layout;
}
