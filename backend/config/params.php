<?php
return [
    'adminEmail' => 'admin@example.com',
    'menuItems' => [
        [
            'label' => 'Users',
            'icon' => 'fas fa-user',
            'items' => [
                [
                    'label' => 'Users',
                    'url' => ['/user'],
                    'icon' => 'fas fa-user',
                ],
                [
                    'label' => 'Assignment',
                    'url' => ['/rbac/assignment'],
                    'icon' => 'fas fa-link',
                ],
                [
                    'label' => 'Role',
                    'url' => ['/rbac/role'],
                    'icon' => 'fas fa-link',
                ],
                [
                    'label' => 'Route',
                    'url' => ['/rbac/route'],
                    'icon' => 'fas fa-link',
                ],
                [
                    'label' => 'Permission',
                    'url' => ['/rbac/permission'],
                    'icon' => 'fas fa-link',
                ],
            ]
        ],
    ],
];
