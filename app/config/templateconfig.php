<?php

return [
    'template' => [
        'header'                => TEMPLATE_PATH . 'header.php',
        'containter_start'      => TEMPLATE_PATH . 'containterstart.php',
        'main_menu'             => TEMPLATE_PATH . 'mainmenu.php',
        'content_start'         => TEMPLATE_PATH . 'contentstart.php',
        ':view'                 => ':action_view',
        'content_end'           => TEMPLATE_PATH . 'contentend.php',
        'containter_end'        => TEMPLATE_PATH . 'containterend.php',
        'footer'                => TEMPLATE_PATH . 'footer.php'
    ],
    'header_resources' => [
        'css' => [

            'bootstrap'                =>['href' => CSS . 'bootstrap.min.css','id' =>'bootstrap-style' ],
            'bootstrap-responsive'     =>['href' => CSS . 'bootstrap-responsive.min.css','id' =>'' ],
            'style'                    =>['href' => CSS . 'style.css','id' =>'base-style' ],
            'base-style'               =>['href' => CSS . 'style-responsive.css','id' =>'base-style-responsive' ],
            'fonts'                    =>['href' => 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext','id' =>'' ]

              ],
        'img' => [

            'favicon'                  => IMG . 'favicon.ico'
        ],
        'js' => [
        ]
    ],
    'footer_resources' => [
        'jquery-1.9.1'              => JS . 'jquery-1.9.1.min.js',
        'jquery-migrate'            => JS . 'jquery-migrate-1.0.0.min.js',
        'jquery-ui-1.10.0'          => JS . 'jquery-ui-1.10.0.custom.min.js',
        'jquery.ui.touch-punch'     => JS . 'jquery.ui.touch-punch.js',
        'modernizr'                 => JS . 'modernizr.js',

        'bootstrap'                 => JS . 'bootstrap.min.js',
       // 'jquery.cookie'             => JS . 'jquery.cookie.js',
        'fullcalendar.min'          => JS . 'fullcalendar.min.js',
         'dataTables'               => JS.  'jquery.dataTables.min.js',
        'excanvas'                  => JS .  'excanvas.js',

        'jquery.flot'               => JS . 'jquery.flot.js',
        'jquery.flot.pie'           => JS . 'jquery.flot.pie.js',
        'jquery.flot.stack'         => JS . 'jquery.flot.stack.js',
        'jquery.flot.resize.min'    => JS . 'jquery.flot.resize.min.js',
        'jquery.chosen.min'         => JS . 'jquery.chosen.min.js',

        'jquery.uniform.min'        => JS . 'jquery.uniform.min.js',

        'jquery.cleditor.min'       => JS . 'jquery.cleditor.min.js',

        //'jquery.noty'               => JS .'jquery.noty.js',

        'jquery.elfinder.min'       => JS . 'jquery.elfinder.min.js',

        'jquery.raty.min'           => JS . 'jquery.raty.min.js',

        'jquery.iphone.toggle'      => JS . 'jquery.iphone.toggle.js',

        'jquery.uploadify-3.1'      => JS . 'jquery.uploadify-3.1.min.js',

        //'jquery.gritter'            => JS .'jquery.gritter.min.js',

        'jquery.imagesloaded'       => JS .'jquery.imagesloaded.js',

        'jquery.masonry'            => JS .'jquery.masonry.min.js',

        'jquery.knob.modified'      => JS .'jquery.knob.modified.js',

        'jquery.sparkline'          => JS .'jquery.sparkline.min.js',

        'counter'                   => JS .'counter.js',

        //'retina'                    => JS .'retina.js',

        'main'                      => JS .'main.js',

        'custom'                    => JS .'custom.js'
    ]
];





