ls-module-oorecaptcha
=====================

### To use regular recaptcha:

1. Get an API key pair from [Recaptcha](http://www.google.com/recaptcha) for your sites domain.
2. Go to: oorecaptcha/settings/ in your backend and set the public and private key that you were given.
3. In your form insert: ```<?php echo ooRecaptcha_Module::create_recaptcha(); ?>``` to create a captcha.
4. Set your form to use a custom ajax handler.
5. Within that handler, have the following code, replacing "NORMAL EVENT HANDLER" in the response check with the regular action that should be executed on form submission.
```
    $recaptcha_challenge_field = post('recaptcha_challenge_field');
    $recaptcha_response_field = post('recaptcha_response_field');
    $user_ip = Phpr::$request->getUserIp();

    $recaptcha_response = ooRecaptcha_Module::verify_recaptcha($user_ip, $recaptcha_challenge_field, $recaptcha_response_field);

    if (!$recaptcha_response->is_valid)
    {
        throw new Phpr_ApplicationException("The reCAPTCHA wasn't entered correctly. Go back and try it again." . "(reCAPTCHA said: " . $recaptcha_response->error . ")");
    }
    else
    {
        $controller->exec_action_handler('NORMAL EVENT HANDLER');
    }
```

Some notes:

* On a failure, you should refresh the recaptcha using ```Recaptcha.reload``` using [LemonStands onFailure event](http://lemonstand.com/docs/lemonstand_front_end_javascript_framework/). Each recaptcha can only be attempted once, any attempts beyond that fail outright.


### To use mailhide
1. Setup your configuration under the settings page with [mailhide API keys](http://www.google.com/recaptcha/mailhide/).
2. Just use ```<?php echo ooRecaptcha_Module::mailhide('email@example.com'); ?>```
