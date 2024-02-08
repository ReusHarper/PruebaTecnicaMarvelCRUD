<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Upload extends BaseConfig
{
    public $maxFileSize    = 0;
    public $validFileTypes = ['jpg', 'jpeg', 'png', 'gif'];
    public $maxWidth       = 0;
    public $maxHeight      = 0;
    public $uploadPath     = WRITEPATH . 'uploads/';
}