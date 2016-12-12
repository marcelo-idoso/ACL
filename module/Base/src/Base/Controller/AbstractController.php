<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Base\Controller\AbstractActionControllerLos;
use Zend\Stdlib\ResponseInterface as Response;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

abstract class AbstractController extends AbstractActionControllerLos{
    
    public function __construct() {
        $this->controller;
        $this->em;
        $this->$entity;
        $this->route;
        $this->service;
        $this->form;
        $this->messangeSucess = 'Salvo Com Sucesso!';
        $this->messangeErro   = 'Não Foi Possivel Salvar !';

    }
    



    /**
     * Se não for passado uma Instancia do para o Em Sera instaciao o Padrao
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEm() {
        
        if ($this->em == NULL) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        
        return $this->em;
    }
    
    
    
    /**
     * Lisart Registros
     * @return ViewModel
     */
    public function indexAction() {
        // Recupera todos os registros no banco de Dados
        $list = $this->getEm()->getRepository($this->entity)->findAll();
      
        $page       = $this->params()->fromRoute('page');
        $paginator  = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
                  ->setDefaultItemCountPerPage(10);
        
        // Verifica Se Exisite Alguma Messagem Para Ser Retornar a View
        if ($this->flashMessenger()->hasSuccessMessages()){
            return new ViewModel(
                    array(
                        'success'   => $this->flashMessenger()->getSuccessMessages(),
                        'data'      => $paginator,
                        'page'      => $page,
                    )
            );
        }
        return new ViewModel(
                array(
                    'data' => $paginator,
                    'page' => $page,
                )
        );
    }
    
    /**
     * Adicionar Registros
     * @return ViewModel
     */
    public function inserirAction() {
        // Verificar se e uma string se For cria a Instancia o Objeto se ja for um Objeto se o Objeto na Variavel $for
        /* @var $form \Zend\Form\Form */
        if (is_string($this->form)){
            $form = new $this->form;
        }else{
            $form = $this->form;
        }
        
        $request = $this->getRequest();
        // Verifica Se exisite um Post
        if ($request->isPost()){
            // Recebe os Dados passados peloe Post e Seta no $form
            $form->setData($request->getPost());
            
            if ( $form->isValid()) {
             
                $service = $this->getServiceLocator()->get($this->service); 
               
                if($service->save($request->getPost()->toArray())){
                    $this->flashMessenger()->addSuccessMessage($this->messangeSucess);
                }else{
                    $this->flashMessenger()->addErrorMessage($this->messangeErro);
                }
                
                return $this->redirect()->toRoute($this->getActionRouter('inserir') , [] , TRUE);
            }
        }
        
        if ($this->flashMessenger()->hasSuccessMessages()) {
            return new ViewModel(
                    array(
                        'form'      => $form ,
                        'success'   => $this->flashMessenger()->getSuccessMessages()
                    )
            );
        }
        if ($this->flashMessenger()->hasErrorMessages()) {
            return new ViewModel(
                    array(
                      'form'      => $form ,
                      'success'   => $this->flashMessenger()->getErrorMessages()  
            ));
        }
        
        $this->flashMessenger()->clearMessages();
        return new ViewModel(
                array(
                    'form'      => $form
                ));
    }
    
    public function editarAction() {
         // Verificar se e uma string se For cria a Instancia o Objeto se ja for um Objeto se o Objeto na Variavel $for
        /* @var $form \Zend\Form\Form */
        if (is_string($this->form)){
            $form = new $this->form;
        }else{
            $form = $this->form;
        }
        
        $request = $this->getRequest();
        /*Verificar se foi passado algum parametro pela url controller/action/param  se não seta zero*/
        $param = $this->params()->fromRoute('id' , 0);
        
        if ($param > 0 ) {
            // Buscar a Entity no Banco de Dados
            $repository = $this->getEm()->getRepository($this->entity)->find($param);
            //Seta os Dados no Formulario
            $form->bind($repository);
            
           
        }
        if ($repository) {
            if($request->isPost()) {
                $form->setData($request->getPost());
                
                if($form->isValid()){
                    $service = $this->getServiceLocator()->get($this->service);
                    $data = $request->getPost()->toArray();
                    $data['id'] = (int)$param;
                    
                    if ($service->save($data)){
                         $this->flashMessenger()->addSuccessMessage($this->messangeSucess);
                    }else{
                        $this->flashMessenger()->addErrorMessage(''.$this->messangeErro);
                    }
                    return $this->redirect()->toRoute($this->getActionRouter('editar') , ['id' => $param] , TRUE);
                }
            }
        }else{
            $this->flashMessenger()->addInfoMessage('Registro não Foi Encontrado');
            return $this->redirect()->toRoute($this->getActionRouter('index') , [] , TRUE);
        }
        if( $this->flashMessenger()->hasSuccessMessages()){
            return new ViewModel(
                    array(
                        'form'      => $form,
                        'success'   => $this->flashMessenger()->getSuccessMessages(),
                        'id'        => $param
                    ));
        }
        if( $this->flashMessenger()->hasErrorMessages()){
            return new ViewModel(
                    array(
                        'form'      => $form,
                        'error'     => $this->flashMessenger()->getErrorMessages(),
                        'id'        => $param
                    ));
        }
        if( $this->flashMessenger()->hasInfoMessages()){
            return new ViewModel(
                    array(
                        'form'      => $form,
                        'error'     => $this->flashMessenger()->getInfoMessages(),
                        'id'        => $param
                    ));
        }
        
        $this->flashMessenger()->clearMessages();
        return new ViewModel(
                array(
                    'form' => $form,
                    'id'   => $param
                ));
    }
    
    public function excluirAction() {
        $service = $this->getServiceLocator()->get($this->service);
        
        $id = $this->params()->fromRoute('id' , 0);

        if($service->remove(array('id' => $id))){
             $this->flashMessenger()->addSuccessMessage('Deletado com Sucesso!');
        }else {
             $this->flashMessenger()->addErrorMessage('Não foi Possivel Remover');
        }
       
        return $this->redirect()->toRoute($this->route , array('controller' => $this->controller) ,false);
    }
}
