<?php
    class ooRecaptcha_Settings extends Backend_SettingsController
    {
        protected $access_for_groups = array(Users_Groups::admin);
        public $implement = 'Db_FormBehavior';

        public $form_edit_title = 'Recaptcha Settings';
        public $form_model_class = 'ooRecaptcha_Config';
        public $form_redirect = null;

        public function __construct() {
            parent::__construct();
            $this->app_tab = 'settings';
            $this->form_redirect = url('system/settings/');
        }

        public function index() {
            try {
                $this->app_page_title = 'Recaptcha module';

                $config = new ooRecaptcha_Config();
                $this->viewData['form_model'] = $config->load();
            }
            catch(exception $ex) {
                $this->handlePageError($ex);
            }
        }

        protected function index_onSave() {
            try {
                $config = new ooRecaptcha_Config();
                $config = $config->load();

                $config->save(post($this->form_model_class, array()), $this->formGetEditSessionKey());
                Phpr::$session->flash['success'] = 'Recaptcha module configuration has been saved.';
                Phpr::$response->redirect($this->form_redirect);
            }
            catch(Exception $ex) {
                Phpr::$response->ajaxReportException($ex, true, true);
            }
        }
    }
