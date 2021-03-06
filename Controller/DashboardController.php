<?php

class DashboardController extends CloggyAppController {
    
    public $uses = array('Cloggy.CloggyUser');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->deny('*');
    }

    public function index() {
        
        $this->CloggyModuleMenu->setGroup('shortcuts', array(
            'Add New User' => CloggyCommon::urlModule('cloggy_users', 'cloggy_users_home/add'),
            'Edit My Profile' => CloggyCommon::urlModule('cloggy_users', 'cloggy_users_home/edit/' . $this->Auth->user('id'))
        ));

        $this->set('title_for_layout', 'Cloggy - Administration Dashboard');
    }

}