<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

abstract class AbstractController extends AbstractActionController{
    
    protected $em;
    protected $entity;
    protected $controller;
    protected $route;
    protected $service;
    protected $form;
    protected $messangeSucess = 'Cadastro Realiazado Com Sucesso!';
    protected $messangeErro   = 'Não Foi Possivel Realizar o Cadastro!';




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
                        'success' => $this->flashMessenger()->getSuccessMessages(),
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
                return $this->redirect()->toRoute($this->route, array(
                    'controller' => $this->controller,
                    'action'     => 'inserir'
                ));
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
}
