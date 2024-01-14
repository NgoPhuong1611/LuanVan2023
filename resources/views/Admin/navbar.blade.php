<?php



$menu = [
    [
        'url' => url('dashboard'),
        'active' => 'dashboard',
        'name' => 'Dashboard',
        'icon' => '<i class="feather icon-home"></i>',
    ],

    [
        'url' => '',
        'active' => 'dashboard/admin',
        'name' => 'Tài khoản quản trị',
        'icon' => '<i class="fa fa-user"></i>',
                'sub_menu' => [
                    [
                        'url' => url('dashboard/admin'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => url('dashboard/admin/detail'),
                        'name' => 'Thêm mới ',
                    ],

                ]


    ],

    [
        'url' => '',
        'active' => 'dashboard/user',
        'name' => 'Tài khoản người dùng',
        'icon' => '<i class="fa fa-user"></i>',
        'sub_menu' => [
            [
                'url' => '',
                'name' => 'Người học',
                'active' => 'dashboard/user',
                'sub_menu' => [
                    [
                        'url' => url('dashboard/user/'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => url('dashboard/user/detail'),
                        'name' => 'Thêm mới',
                    ],
                ]
            ],
            [
                'url' => '',
                'name' => 'Người dạy',
                'active' => 'dashboard/user',
                'sub_menu' => [
                    [
                        'url' => url('dashboard/user/indexteacher/'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => url('dashboard/user/detailteacher/'),
                        'name' => 'Thêm mới ',
                    ],

                ]
            ],

        ]
    ],
    [
        'url' => '',
        'active' => 'dashboard/question',
        'name' => 'Quản lý Câu hỏi',
        'icon' => '<i class="fa fa-question-circle-o"></i>',
        'sub_menu' => [
            [
                'url' => '',
                'name' => 'Nhóm câu hỏi',
                'active' => 'dashboard/question-group',
                'sub_menu' => [
                    [
                        'url' => url('dashboard/question-group/'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => url('dashboard/question-group/detail'),
                        'name' => 'Thêm mới',
                    ],
                ]
            ],
            [
                'url' => '',
                'name' => 'Câu hỏi',
                'active' => 'dashboard/question',
                'sub_menu' => [
                    [
                        'url' => url('dashboard/question'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => url('dashboard/question/detail'),
                        'name' => 'Thêm mới câu hỏi',
                    ],

                ]
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Đề Thi',
        'active' => 'dashboard/exam',
        'icon' => '<i class="fa fa-file-text"></i>',
        'sub_menu' => [
            [
                'url' => '',
                'name' => 'Đề thi',
                'active' => 'dashboard/exam',
                'sub_menu' => [
                    [
                        'url' => url('dashboard/exam'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => url('dashboard/exam/detail'),
                        'name' => 'Thêm đề thi',
                    ],
                ]
            ],
            [
                'url' => '',
                'name' => 'Phần đề thi',
                'active' => 'dashboard/exam-part',
                'sub_menu' => [
                    [
                        'url' => url('dashboard/exam-part/'),
                        'name' => 'Danh sách',
                    ],
                    [
                        'url' => url('dashboard/exam-part/detail'),
                        'name' => 'Thêm mới',
                    ],
                ]
            ],
        ]
    ],
    // [
    //     'url' => '',
    //     'active' => 'dashboard/learn',
    //     'name' => 'Quản lý bài Luyện tập',
    //     'icon' => '<i class="fa fa-leanpub"></i>',
    //     'sub_menu' => [
    //         [
    //             'url' => '',
    //             'name' => 'Bài ngữ pháp',
    //             'active' => 'dashboard/learn',
    //             'sub_menu' => [
    //                 [
    //                     'url' => url('dashboard/learn'),
    //                     'name' => 'Danh sách',
    //                 ],
    //                 [
    //                     'url' => url('dashboard/learn/detail'),
    //                     'name' => 'Thêm mới',
    //                 ],
    //             ]
    //         ],
    //         [
    //             'url' => '',
    //             'name' => 'Bài từ vựng',
    //             'active' => 'dashboard/learn',
    //             'sub_menu' => [
    //                 [
    //                     'url' => url('dashboard/learn/'),
    //                     'name' => 'Danh sách',
    //                 ],
    //                 [
    //                     'url' => url('dashboard/learn/detail'),
    //                     'name' => 'Thêm mới',
    //                 ],
    //             ]
    //         ],
    //     ]
    // ],

    [
        'url' => '',
        'name' => 'Quản lý Giao dịch',
        'active' => 'dashboard/trasaction',
        'icon' => '<i class="fa fa-exchange"></i>',
        'sub_menu' => [
            [
                'url' => url('dashboard/trasaction/'),
                'name' => 'Danh sách',
            ],
            [
                'url' => url('dashboard/'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Nhiệm vụ',
        'active' => 'dashboard/mission',
        'icon' => '<i class="fa fa-tasks"></i>',
        'sub_menu' => [
            [
                'url' => url('dashboard/mission/'),
                'name' => 'Danh sách',
            ],
            [
                'url' => url('dashboard/'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Diễn Đàn',
        'active' => 'dashboard/forum',
        'icon' => '<i class="fa fa-comments"></i>',
        'sub_menu' => [
            [
                'url' => url('dashboard/forum/'),
                'name' => 'Danh sách',
            ],
            [
                'url' => url('dashboard/forum/detail'),
                'name' => 'Thông báo mới!',
            ],
        ]
    ],
    // [
    //     'url' => '',
    //     'name' => 'Quản lý QUảng Cáo',
    //     'active' => 'dashboard/banner',
    //     'icon' => '<i class="fa fa-bars"></i>',
    //     'sub_menu' => [
    //         [
    //             'url' => url('dashboard/banner/'),
    //             'name' => 'Danh sách',
    //         ],
    //         [
    //             'url' => url('dashboard/'),
    //             'name' => 'Thêm mới',
    //         ],
    //     ]
    // ],
    [
        'url' => '',
        'name' => 'Quản lý Danh mục',
        'active' => 'dashboard/category',
        'icon' => '<i class="fa fa-file-text"></i>',
        'sub_menu' => [
            [
                'url' => url('dashboard/category'),
                'name' => 'Danh sách',
            ],
            [
                'url' => url('dashboard/category/detail'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
    [
        'url' => '',
        'name' => 'Quản lý Bài viết',
        'active' => 'dashboard/posts',
        'icon' => '<i class="fa fa-file-text"></i>',
        'sub_menu' => [

            [
                'url' => url('dashboard/posts'),
                'name' => 'Danh sách',
            ],
            [
                'url' => url('dashboard/posts/detail'),
                'name' => 'Thêm mới',
            ],
        ]
    ],
];
?>

<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <!-- <div class="pcoded-navigatio-lavel">Bảng điều khiển</div> -->
        <ul class="pcoded-item pcoded-left-item">
            <?php foreach ($menu as $row) : ?>
                <?php $classActive = Request::is($row['active'] . '*') ? ' pcoded-trigger' : ''; ?>
                <li class="<?= !empty($row['url']) ? '' : 'pcoded-hasmenu' ?> <?= $classActive ?>">
                    <a href="<?= !empty($row['url']) ? $row['url'] : 'javascript:void(0)' ?>">
                        <span class="pcoded-micon"><?= $row['icon'] ?></span>
                        <span class="pcoded-mtext"><?= $row['name'] ?></span>
                    </a>
                    <?php if (!empty($row['sub_menu'])) : ?>
                        <ul class="pcoded-submenu">
                            <?php foreach ($row['sub_menu'] as $sub) : ?>
                                <?php if (!empty($sub['sub_menu'])) : ?>
                                    <?php $subClassActive = Request::is($sub['active'] . '*') ? ' pcoded-trigger' : ''; ?>
                                    <li class="pcoded-hasmenu <?= $subClassActive ?>">
                                        <a href="javascript:void(0)">
                                            <span class="pcoded-mtext"><?= $sub['name'] ?></span>
                                        </a>
                                        <ul class="pcoded-submenu">
                                            <?php foreach ($sub['sub_menu'] as $val) : ?>
                                                <li class="{{ Request::is(str_replace(url('/'), '', $val['url'])) ? 'active' : '' }}">                                                    <a href="<?= $val['url'] ?>">
                                                        <span class="pcoded-mtext"><?= $val['name'] ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    </li>
                                <?php else : ?>
                                    <li class="{{ Request::is(str_replace(url('/'), '', $sub['url'])) ? 'active' : '' }}">                                        <a href="<?= $sub['url'] ?>">
                                            <span class="pcoded-mtext"><?= $sub['name'] ?></span>
                                        </a>
                                    </li>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</nav>
