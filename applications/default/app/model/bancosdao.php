<?php
namespace app\model;

class BancosDAO extends \DAO
{
    protected function initDaoProperties() {
        $this->table = "bancos";
    }
}