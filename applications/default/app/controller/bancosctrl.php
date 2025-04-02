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
                    \General::getFilledMessage('Banco cadastrado com sucesso!', $bancoID));
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
        $request = new \Request();
        // --> Pagination
        $first = $request->first; 
        $rows = $request->rows;
        // --> Sort criteria
        $sortField = $request->sortfield; 
        $sortOrder = $request->sortorder;
        $sortCriteria = is_null($sortField) 
            ? 'nome' 
            : $sortField . (is_null($sortOrder) 
                ? ' ASC' 
                : ($sortOrder == 1 ? ' ASC' : ' DESC'));
        // --> Filter criteria
        $criteria = $request->search_criteria;
        $keyword = "%" . $criteria . "%";
        
        // 2) Request rows from the database
        $response = new \Response();
        $bancosDAO = new BancosDAO();
        $bancosDAO->setKeywordAsFilter($keyword);
        $bancosFound = array();
        
        try {
            $response->total = $bancosDAO->getCount();
            $bancosDAO->setSortCriteria($sortCriteria);
            $bancosDAO->setLimit($first, $rows);
            
            while($row = $bancosDAO->getResult()) {
                $bancosFound[] = $row;
            }
            
            $response->rows = $bancosFound;
            $response->success = TRUE;
        } catch (\PDOException $ex) {
            $response->setFailedMessage("Busca de Dados", "Erro ao resgatar os dados (erro " . $ex->getCode() . ").");
        }

        // 3) Return JSON response
        return $response;
    }
    
    static protected function action_suggestions() {
        // 1) Read POST parameters */
        $request = new \Request();
        
        // 2) Request the rows matching the criterium from the database
        $bancosDAO = new BancosDAO();
        $bancosDAO->setNameAsFilter("'%" . $request->criteria . "%'");
        $bancosDAO->setSortCriteria('nome');
        $bancosDAO->setLimit(0, 10);
        
        $response = new \Response();
        $previousSuggestion = '';
        $suggestions = array();
        
        try {
            while ($row = $bancosDAO->getResult()) {
                if ($row['nome'] !== $previousSuggestion) {
                    $suggestions[]['label'] = $row['nome'];
                    $previousSuggestion = $row['nome'];
                }
            }
            
            $response->setResponse($suggestions);
        } catch (\PDOException $ex) {
            $response->setFailedMessage("SUGESTÕES", "Erro ao pesquisar sujestões de bancos (Erro: " . $ex->getCode() . ").");
        }
        
        // 3) Return JSON response
        return $response;
    }
}