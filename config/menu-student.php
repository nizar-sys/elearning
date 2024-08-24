<?php

$menuItems = [
    [
        'items' => [
            [
                'title' => 'Dashboard',
                'icon' => 'ri-home-smile-line',
                'route' => 'student.dashboard',
                'active' => 'student.dashboard',
                'submenu' => []
            ]
        ]
    ],
    [
        'items' => [
            [
                'title' => 'My Elearnings',
                'icon' => 'ri-book-2-line',
                'route' => 'student.elearnings.index',
                'active' => 'student.elearnings.*',
                'submenu' => []
            ],
            [
                'title' => 'Articles',
                'icon' => 'ri-article-line',
                'route' => 'student.articles.index',
                'active' => 'student.articles.*',
                'submenu' => []
            ],
            [
                'title' => 'Videos',
                'icon' => 'ri-movie-line',
                'route' => 'student.videos.index',
                'active' => 'student.videos.*',
                'submenu' => []
            ]
        ]
    ],
    [
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
