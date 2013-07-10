1) Installing
----------------------------------

### Use Composer (*recommended*)

Add to composer.json :

    {
        "require": {
            "xsolve-pl/xsolve-cookie-acknowledgement-bundle": "dev-master"
        },
        "repositories": [
            {
                "type": "package",
                "package": {
                    "name": "xsolve-pl/xsolve-cookie-acknowledgement-bundle",
                    "version": "dev-master",
                    "source": {
                        "url": "git@github.com:xsolve-pl/xsolve-cookie-acknowledgement-bundle.git",
                        "type": "git",
                        "reference": "master"
                    },
                    "target-dir" : "Xsolve/CookieAcknowledgementBundle"
                }
            }
        ]
    }

use:

    composer isntall

or

    composer update xsolve-pl/xsolve-cookie-acknowledgement-bundle

Additionally add to app/AppKernel.php:

    public function registerBundles()
    {
        return array(
            // ...
            new Xsolve\CookieAcknowledgementBundle\XsolveCookieAcknowledgementBundle(),
        );
    }

2) Using
----------------------------------

### For all static pages

You can add to app/config/config.yml file new bundle configuration:

    xsolve_cookie_acknowledgement:
        response_injection: true

Cookies message should be presented on all pages.

### For iframes

You can add to your twig template include line.

    {% include 'XsolveCookieAcknowledgementBundle::cookie_acknowledgement_bar.html.twig' %}

Cookies message should be presented only on selected pages.

