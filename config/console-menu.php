<?php

$menuItems = [
    [
        'items' => [
            [
                'title' => 'Dashboard',
                'icon' => 'ri-home-smile-line',
                'route' => 'dashboard',
                'active' => 'dashboard',
                'submenu' => []
            ]
        ]
    ],
    [
        'header' => 'User Managements',
        'items' => [
            [
                'title' => 'Roles & Permissions',
                'icon' => 'ri-lock-2-line',
                'route' => '',
                'active' => ['permissions.*', 'roles.*'],
                'submenu' => [
                    [
                        'title' => 'Permission',
                        'route' => 'permissions.index',
                        'active' => 'permissions.*'
                    ],
                    [
                        'title' => 'Roles',
                        'route' => 'roles.index',
                        'active' => 'roles.*'
                    ]
                ]
            ],
            [
                'title' => 'Users',
                'icon' => 'ri-user-line',
                'route' => 'users.index',
                'active' => 'users.*',
                'submenu' => []
            ]
        ]
    ],
    [
        'header' => 'Master Data',
        'items' => [
            [
                'title' => 'Categories',
                'icon' => 'ri-list-check-2',
                'route' => 'categories.index',
                'active' => 'categories.*',
                'submenu' => []
            ],
            [
                'title' => 'Articles',
                'icon' => 'ri-article-line',
                'route' => 'articles.index',
                'active' => 'articles.*',
                'submenu' => []
            ],
            [
                'title' => 'Videos',
                'icon' => 'ri-video-line',
                'route' => 'videos.index',
                'active' => 'videos.*',
                'submenu' => []
            ],
            [
                'title' => 'Elearnings',
                'icon' => 'ri-book-2-line',
                'route' => '',
                'active' => ['benefits.*', 'materials.*', 'elearnings.*', 'reviews.*'],
                'submenu' => [
                    [
                        'title' => 'Benefits',
                        'route' => 'benefits.index',
                        'active' => 'benefits.*',
                    ],
                    [
                        'title' => 'Materials',
                        'route' => 'materials.index',
                        'active' => 'materials.*',
                    ],
                    [
                        'title' => 'List',
                        'route' => 'elearnings.index',
                        'active' => 'elearnings.*',
                    ],
                    [
                        'title' => 'Reviews',
                        'route' => 'reviews.index',
                        'active' => 'reviews.*',
                    ]
                ]
            ]
        ]
    ],
    [
        'header' => 'Settings',
        'items' => [
            [
                'title' => 'Profile',
                'icon' => 'ri-settings-4-line',
                'route' => 'profile.edit',
                'active' => 'profile.*',
                'submenu' => []
            ]
        ]
    ]
];

return $menuItems;
