<?php

namespace Dsprog;

class PageAdmin extends Page
{
    public function __construct($opts = [], $tpl_dir = "admin")
    {
        parent::__construct($opts, $tpl_dir);
    }
}