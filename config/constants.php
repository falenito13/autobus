<?php
return [
    'deleted_status_id' => 2,
    'active_status_id' => 1,
    'inactive_status_id' => 0,
    'LANGS' => serialize(array('en' => 1, 'ka' => 2, 'ru' => 3)),
    'IMG_TYPES' => serialize(array('image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/svg+xml')),
    'IMG' => serialize(array('png', 'jpg', 'jpeg')),
    'DOC' => serialize(array('doc', 'docx', 'pdf','xls','xlsx')),
    //ROOMS
    'UPLOADS' =>[
        'contact' => [
            'LARGE_DIR' => '/uploads/contact/large/',
            'THUMBS_DIR' => '/uploads/contact/thumbs/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '600',
            'THUMBS_HEIGHT' => '350',
        ],
        //service
        'service' => [
            'LARGE_DIR' => '/uploads/service/large/',
            'THUMBS_DIR' => '/uploads/service/thumbs/',
            'SVG_DIR' => '/uploads/service/svg/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '600',
            'THUMBS_HEIGHT' => '600',
        ],
        'additional_service' => [
            'LARGE_DIR' => '/uploads/additional_service/large/',
            'THUMBS_DIR' => '/uploads/additional_service/thumbs/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '600',
            'THUMBS_HEIGHT' => '600',
        ],

        //whoweare

        'who_we_are' => [
            'LARGE_DIR' => '/uploads/who_we_are/large/',
            'THUMBS_DIR' => '/uploads/who_we_are/thumbs/',
            'SVG_DIR' => '/uploads/who_we_are/svg/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '600',
            'THUMBS_HEIGHT' => '600',
        ],
        //slider

        'slider' => [
            'LARGE_DIR' => '/uploads/slider/large/',
            'THUMBS_DIR' => '/uploads/slider/thumbs/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '600',
            'THUMBS_HEIGHT' => '600',
        ],
        //blog
        'blog' => [
            'LARGE_DIR' => '/uploads/blog/large/',
            'THUMBS_DIR' => '/uploads/blog/thumbs/',
            'LARGE_WIDTH' => '865',
            'LARGE_HEIGHT' => '550',
            'THUMBS_WIDTH' => '273',
            'THUMBS_HEIGHT' => '180',
        ],
        'tour' => [
            'LARGE_DIR' => '/uploads/tour/large/',
            'THUMBS_DIR' => '/uploads/tour/thumbs/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '600',
            'THUMBS_HEIGHT' => '400',
        ],
        //car
        'car' => [
            'LARGE_DIR' => '/uploads/car/large/',
            'THUMBS_DIR' => '/uploads/car/thumbs/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '238',
            'THUMBS_HEIGHT' => '90',
        ],
        //SPACE
        'space' => [
            'LARGE_DIR' => '/uploads/space/large/',
            'THUMBS_DIR' => '/uploads/space/thumbs/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '600',
            'THUMBS_HEIGHT' => '600',
        ],
        //ABOUT
        'about' => [
            'LARGE_DIR' => '/uploads/about/large/',
            'THUMBS_DIR' => '/uploads/about/thumbs/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '400',
            'THUMBS_HEIGHT' => '500',
            ],
        //SOMEOFUS
        'someofus' => [
            'LARGE_DIR' => '/uploads/someofus/large/',
            'THUMBS_DIR' => '/uploads/someofus/thumbs/',
            'LARGE_WIDTH' => '1200',
            'LARGE_HEIGHT' => '800',
            'THUMBS_WIDTH' => '400',
            'THUMBS_HEIGHT' => '500',
        ],

        ]
];
