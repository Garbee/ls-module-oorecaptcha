<?php
        class ooRecaptcha_Module extends Core_ModuleBase
        {
                protected function createModuleInfo()
                {
                        return new Core_ModuleInfo(
                                "Recaptcha",
                                "Adds the ability to extend forms with a recaptcha.",
                                "Jonathan Garbee" );
                }

                public static function create_recaptcha()
                {
                        require_once('vendor/recaptchalib.php');
                        $publickey = ooRecaptcha_Config::create()->public_key;
                        echo recaptcha_get_html($publickey);
                }

                public static function verify_recaptcha($user_ip, $recaptcha_challenge_field, $recaptcha_response_field)
                {
                        require_once('vendor/recaptchalib.php');
                        $privatekey = ooRecaptcha_Config::create()->private_key;
                        $resp = recaptcha_check_answer($privatekey,
                                $user_ip,
                                $recaptcha_challenge_field,
                                $recaptcha_response_field
                                );
                        return $resp;
                }

                public function listSettingsItems()
                {
                        return array(
                                array(
                                        'icon'=>'/modules/oorecaptcha/resources/images/logo.jpg',
                                        'title'=>'Recaptcha',
                                        'url'=>'/oorecaptcha/settings',
                                        'description'=>'Configure settings for Recaptcha. Such as the public and private key.',
                                        'sort_id'=>20,
                                        'section'=>'Miscellaneous'
                                        )
                        );
                }

        }

