# CloudFlare-Turnstile-PHP
CloudFlare Turnstile PHP Library

## Usage

```
composer require arjitc/cloudflare-turnstile-php
```


### Frontend

Replace `YOUR_SITE_KEY` with a `SITE_KEY` you get from the CloudFlare Turnstile Menu (https://dash.cloudflare.com/?to=/:account/turnstile)

```
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

<form action="account.php" method="post">
First Name: <input type="text" name="fname"><br>
Last Name: <input type="text" name="lname"><br>
<div class="cf-turnstile" data-sitekey="YOUR_SITE_KEY"></div>
<input type="submit">
</form>
```

### Backend

Replace `YOUR_SECRET_KEY` with a `SECRET_KEY` you get from the CloudFlare Turnstile Menu (https://dash.cloudflare.com/?to=/:account/turnstile)

```
<?php
require 'vendor/autoload.php';
$Turnstile = new Turnstile("YOUR_SECRET_KEY");
$resp      = $Turnstile->verify();

if($resp == true) {
    
// all good to proceed with other checks you may have..

} else {
    switch($resp) {
        case "missing-input-secret":
            //handle error
            break;
        case "invalid-input-secret":
            //handle error
            break;
        case "missing-input-response":
            //handle error
            break;
        case "invalid-widget-id":
            //handle error
            break;
        case "invalid-parsed-secret":
            //handle error
            break;
        case "bad-request":
            //handle error
            break;
        case "timeout-or-duplicate":
            //handle error
            break;
        case "internal-error":
            //handle error
            break;
        default:
            //handle other error
    }
}
 
?>
```
