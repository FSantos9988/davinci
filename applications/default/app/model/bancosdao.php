<?php
namespace app\model;

class BancosDAO extends \DAO
{
    protected function initDaoProperties() {
        $this->table = "bancos";
    }
    
    public function setKeywordAsFilter($keyword) {
        $this->filterClause = " WHERE LOWER(nome) LIKE LOWER (?)"
                . " OR LOWER(codigo_febraban) LIKE LOWER (?) "
                . " OR LOWER(site) LIKE LOWER(?) ";
        $this->setFilterCriteria($keyword, $keyword, $keyword);
    }
    
    public function setNameAsFilter($nome) {
        $this->filterClause = " WHERE LOWER(nome) LIKE LOWER(?) ";
        $this->setFilterCriteria($nome);
    }
}