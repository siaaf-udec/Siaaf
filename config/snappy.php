<?php

return array(


    'pdf' => array(
        'enabled' => true,
        //'binary'  => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        //'binary'  => '/usr/local/bin/wkhtmltopdf',
        'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        //'binary'  => base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64'),
        'binary' => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage.exe"',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
