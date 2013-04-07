<?php

App::uses('Component', 'Controller');
App::uses('File', 'Utility');

class CloggyModuleInstallerComponent extends Component {
    
    public $components = array('Session');
    
    private $__Controller;
    private $__requestedModule;    
    private $__base;
    
    /**
     * Initialize component
     * @param Controller $controller
     */
    public function initialize(Controller $controller) {
        parent::initialize($controller);
        $this->__Controller = $controller;  
        $this->__base = '/' . Configure::read('Cloggy.url_prefix');
    }
    
    /**
     * Run after controller beforeFilter method
     * @param Controller $controller
     */
    public function startup(Controller $controller) {
        
        parent::startup($controller);        
        
        if (isset($controller->request->params['name'])) {
            $this->__requestedModule = Inflector::camelize($controller->request->params['name']);
            $this->__needInstall();            
        }
                
    }        
    
    /**
     * Finish install, set .installed file on
     * module path
     * 
     * @param string $module
     * @return boolean
     */
    public function finishInstall($module) {
        
        $modulePath = CLOGGY_PATH_MODULE.$module.DS;
        $modulePathInstalled = $modulePath.'.installed';
        
        $file = new File($modulePathInstalled);
        return $file->create();
        
    }
    
    /**
     * Check if requested module need to install
     */
    private function __needInstall() {
        
        $modulePath = CLOGGY_PATH_MODULE.$this->__requestedModule.DS;         
        $modulePathInstalled = $modulePath.'.installed';
        $moduleInstallController = $modulePath.'Controller'.DS.$this->__requestedModule.'InstallController.php';
        $moduleInstallControllerUri = Inflector::underscore($this->__requestedModule).'_install';
        
        if (!file_exists($modulePathInstalled) 
                && file_exists($moduleInstallController)
                && $this->__Controller->request->params['controller'] != $moduleInstallControllerUri) {
            
            $this->Session->setFlash(
                __d('cloggy','This module need to install.'),
                'default',array('class' => 'alert'),'dashNotif');
        
            $this->__Controller->redirect($this->__base);
            
        }
        
    }
    
}