<?php


namespace Base\Entity;

use Doctrine\ORM\EntityManager;

trait EntityManagerAwaredTrait {
    
    /**
     *
     * @var \Doctrine\ORM\EntityManager 
     */
    private $em;
    
    /**
     * 
     * @param EntityManager $em
     */
    public function setEntityManager(EntityManager $em){
        $this->em = $em ;
                
    } 
    /**
     * 
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager(){
        if (NULL === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
    
}
