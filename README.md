ls-module-oorecaptcha
=====================

To use:

1. Go to: oorecaptcha/settings/ in your backend and set the public and private key.
2. Set your form to use a custom ajax handler.
3. Within that handler, have the following code, replacing "NORMAL EVENT HANDLER" in the response check with the regular action that should be executed on form submission.
```
    $recaptcha_challenge_field = $_POST["recaptcha_challenge_field"];
    $recaptcha_response_field = $_POST["recaptcha_response_field"];
    $user_ip = Phpr::$request->getUserIp();

    $recaptcha_response = ooRecaptcha_Module::verify_recaptcha($user_ip, $recaptcha_challenge_field, $recaptcha_response_field);

    if (!$recaptcha_response->is_valid)
    {
        throw new Phpr_ApplicationException("The reCAPTCHA wasn't entered correctly. Go back and try it again." . "(reCAPTCHA said: " . $resp->error . ")");
    }
    else
    {
        $controller->exec_action_handler('NORMAL EVENT HANDLER');
    }
```
