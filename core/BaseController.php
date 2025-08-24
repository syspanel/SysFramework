<?php

/************************************************************************/
/* SysFramework - PHP Framework                                         */
/* ============================                                         */
/*                                                                      */
/* PHP Framework                                                        */
/* (c) 2025 by Marco Costa marcocosta@gmx.com                           */
/*                                                                      */
/* https://sysframework.com                                             */
/*                                                                      */
/* This project is licensed under the MIT License.                      */
/*                                                                      */
/* For more informations: marcocosta@gmx.com                            */
/************************************************************************/

namespace Core;

/**
 * Classe base concreta para todos os controladores.
 */
class BaseController
{
    /**
     * Retorna uma resposta JSON.
     *
     * @param mixed $data Dados a serem retornados em JSON.
     * @param int $status Código de status HTTP (default 200).
     */
    protected function jsonResponse($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    /**
     * Retorna uma resposta JSON de erro.
     *
     * @param string $message Mensagem de erro.
     * @param int $status Código de status HTTP (default 400).
     */
    protected function jsonError($message, $status = 400)
    {
        $this->jsonResponse(['status' => 'error', 'message' => $message], $status);
    }
}
