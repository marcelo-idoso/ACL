<?php


namespace Application\Service;

use Base\Service\AbstractService;


class ControllerService extends AbstractService{
    
    public function __construct(\Doctrine\ORM\EntityManager $em) {
         $this->entity = '\Application\Entity\Controller';
         parent::__construct($em);
    }
    
    public function save(array $data = array()) {
        $data['idmodule'] = $this->em->getRepository('Application\Entity\Module')
                ->find($data['idmodule']);
        
        print_r($data);
        
        return parent::save($data);
    }
}
