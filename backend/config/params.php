<?php
return [
    'adminEmail' => 'admin@example.com',
    'menuList'=> [
        [
            'label' => 'Dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'url' => ['/site/index'],
        ],
        [
            'label' => 'Users',
            'icon' => 'fas fa-users',
            'items' => [
                [
                    'label' => 'Users',
                    'url' => ['/user'],
                    'icon' => 'far fa-circle',
                ],
                [
                    'label' => 'Role',
                    'url' => ['/rbac/role'],
                    'icon' => 'far fa-circle',
                ],
                [
                    'label' => 'Route',
                    'url' => ['/rbac/route'],
                    'icon' => 'far fa-circle',
                ],
                [
                    'label' => 'Permission',
                    'url' => ['/rbac/permission'],
                    'icon' => 'far fa-circle',
                ],
                [
                    'label' => 'Rule',
                    'url' => ['/rbac/rule'],
                    'icon' => 'far fa-circle',
                ],
            ]
        ],
        [
            'label'=>'Translate',
            'icon' => 'fas fa-language',
            'url' => ['/translate'],
        ],
        [
            'label' => 'Menu Yii2',
            'options' => ['class' => 'nav-header'],
            'visible' => YII_ENV_DEV,
        ],
        [
            'label' => 'Gii',
            'url' => ['/gii'],
            'icon' => 'fas fa-gavel',
            'visible' => YII_ENV_DEV,
            'pjax' => true
        ],
        [
            'label' => 'Debug',
            'url' => ['/debug'],
            'visible' => YII_ENV_DEV,
            'icon' => 'fas fa-bug'
        ],
    ],
];
