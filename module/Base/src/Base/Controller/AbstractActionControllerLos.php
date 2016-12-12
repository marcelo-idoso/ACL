<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * Description of AbstractActionControllerLos
 *
 * @author Marcelo
 */
abstract class AbstractActionControllerLos extends AbstractActionController {

    protected $controller;
    protected $em;
    protected $entity;
    protected $route;
    protected $service;
    protected $form;
    protected $messangeSucess = 'Cadastro Realiazado Com Sucesso!';
    protected $messangeErro   = 'Não Foi Possivel Realizar o Cadastro!';

    protected function getModuleName() {
        $module_array = explode('\\', get_class($this));

        return $module_array[0];
    }

    /**
     * 
     * Nome da rota raiz do controlador.
     * @return type
     */
    public function getRouteName() {
        return  strtolower($this->getModuleName());

    }

    /**
     * Retorna uma rota para a ação especificada ou a atual.
     * @param type $action
     */
    public function getActionRouter($action = null) {
        if (NULL == $action) {
            $action = $this->getEvent()->getRouteMatch()->getParam('action');
        }
        return  $this->controller . '/' . $action;
    }


}
