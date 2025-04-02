<?php
namespace app\controller;

use app\model\BancosDAO;

class BancosCtrl extends \AppController
{
    static protected function action_list()
    {
        $bancosDAO = new BancosDAO();
        $bancos = array();

        while ($row = $bancosDAO->getResult()) {
            $bancos[] = $row;
        }

        $response = new \Response();
        $response->rows = $bancos;
        $response->success = true;
        return $response;
    }

    static protected function action_register()
    {
        $request = new \Request();
        $row = $request->getValuesAsMap('id','nome','codigo_febraban','site');

        $bancosDAO = new BancosDAO();
        $result = $bancosDAO->store($row);

        $response = new \Response();
        if ($result) {
            $response->setSuccessMessage('SUCESSO', 'Banco cadastrado com sucesso!');
        } else {
            $response->setFailedMessage('ERRO', 'Erro ao cadastrar o banco!');
        }

        return $response;
    }

    static protected function action_delete()
    {
        $request = new \Request();
        $rowID = $request->id;

        $bancosDAO = new BancosDAO();
        $result = $bancosDAO->remove($rowID);

        $response = new \Response();
        if ($result) {
            $response->setSuccessMessage('SUCESSO', 'Banco removido com sucesso!');
        } else {
            $response->setFailedMessage('ERRO', 'Erro ao remover o banco!');
        }

        return $response;       
    }
}