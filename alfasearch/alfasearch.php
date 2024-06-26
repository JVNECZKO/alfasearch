<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class AlfaSearch extends Module
{
    public function __construct()
    {
        $this->name = 'alfasearch';
        $this->tab = 'search_filter';
        $this->version = '1.0.0';
        $this->author = 'Your Name';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Alfa Search');
        $this->description = $this->l('Extends the search functionality to include MPN and reference codes for product combinations.');
    }

    public function install()
    {
        return parent::install();
    }

    public function uninstall()
    {
        return parent::uninstall();
    }
}
