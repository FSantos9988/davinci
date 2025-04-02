<?php
namespace app\controller;

use app\model\BancosDAO;

class BancosCtrl extends \AppController
{
    static protected function action_save()
    {
        // 1) Read POST parameter's values
        $request = new \Request();
        $row = $request->getValuesAsMap('id','nome','codigo_febraban','site');

        // 2) Store values into the database
        $bancosDAO = new BancosDAO();
        $response = new \Response();
        
        try {
            $bancoID = $bancosDAO->store($row);
            $response->setSuccessMessage('SUCESSO', 
                    \General::getFilledMessage('Banco cadastrado com sucesso!', $banciID));
        } catch (\PDOException $ex) {
            $response->setFailedMessage('ERRO', 
                    \General::getFilledMessage('Erro ao cadastrar o banco %1 (Erro: %2)', 
                            $request->nome, 
                            $ex->getCode()));
        }

        // 3) Return JSON response
        return $response;
    }
    
    static protected function action_remove()
    {
        // 1) Get row ID from the POST parameter
        $request = new \Request();
        $rowID = $request->id;

        // 2) Remove the specified row from the database
        $bancosDAO = new BancosDAO();
        $response = new \Response();
        
        try {
            $result = $bancosDAO->remove($rowID);
            $response->setSuccessMessage('SUCESSO', 'Banco removido com sucesso!');
        } catch (\PDOException $ex) {
            $response->setFailedMessage('ERRO', 
                    \General::getFilledMessage('Erro ao remover o banco %1 (Erro: %2)', 
                            $rowID, 
                            $ex->getCode()));
        }

        // 3) Return JSON response
        return $response;       
    }
    
    static protected function action_data()
    {
        // 1) Read POST parameters
        $request = \Request();
        // --> Pagination
        $first = $request->first; 
        $rows = $request->rows;
        // --> Sort criteria
        $sortField = $request->sortfield; 
        $sortOrder = $request->sortorder;
        $sortCriteria = is_null($sortField) ? 'nome' : $sortField . (is_null($sortOrder) ? ' ASC' : $sortOrder == 1 ? ' ASC' : ' DESC');
        // --> Filter criteria
        $criteria = $request->search_criteria;
        $keyword = '%' . $criteria . '%';
        
        // 2) Request rows from the database
        $response = new \Response();
        $bancosDAO = new BancosDAO();
        $bancosDAO->setKeywordAsFilter($keyword);
        $bancosFound = array();
        
        try {
            $response->total = $bancosDAO->getCount();
            $bancosDAO->setSortCriteria($sortCriteria);
            $bancosDAO->setLimit($first, $rows)
        } catch (Exception $ex) {

        }
    }
}