<?php
return [
    'adminEmail' => 'admin@example.com',
    'menuList'=> [
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
