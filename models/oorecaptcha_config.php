<?php
    class ooRecaptcha_Config extends Core_Configuration_Model
    {
        public $record_code = 'oorecaptcha_config';

        public static function create()
        {
            $config = new self();

            return $config->load();
        }

        protected function build_form()
        {
            $this->add_field('public_key', 'Public Key', 'full', db_varchar)->tab('Recaptcha')->comment('Specify the public key .', 'above')->validation()->fn('trim')->required('Please specify the public key.');
            $this->add_field('private_key', 'Private Key', 'full', db_varchar)->tab('Recaptcha')->comment('Specify the private key for communicating with the recaptcha server.', 'above')->validation()->fn('trim')->required('Please specify the private key.');

            $this->add_field('mailhide_pubkey', 'Mailhide Public Key', 'full', db_varchar)->tab('Mailhide')->comment('Specify the mailhide public key.', 'above')->validation()->fn('trim');
            $this->add_field('mailhide_privkey', 'Mailhide Private Key', 'full', db_varchar)->tab('Mailhide')->comment('Specify the mailhide private key.', 'above')->validation()->fn('trim');
        }

        protected function init_config_data()
        {
        }
    }
