1) Installing
----------------------------------

### Use Composer (*recommended*)

Add to composer.json :

    {
        "require": {
            "xsolve-pl/xsolve-cookie-bundle": "dev-master"
        },
        "repositories": [
            {
                "type": "package",
                "package": {
                    "name": "xsolve-pl/xsolve-cookie-bundle",
                    "version": "dev-master",
                    "source": {
                        "url": "git@github.com:xsolve-pl/xsolve-cookie-bundle.git",
                        "type": "git",
                        "reference": "master"
                    },
                    "target-dir" : "Xsolve/CookieBundle"
                }
            }
        ]
    }

use:

    composer isntall 

or

    composer update xsolve-pl/xsolve-cookie-bundle

Additionally add to app/AppKernel.php:

    new Xsolve\CookieBundle\XsolveCookieBundle();

2) Using
----------------------------------

### For all static pages

You can add to app/config/config.yml file new bundle configuration:

    xsolve_cookie:
        response_injection: true
    
Cookies message should be presented on all pages. 

### For iframes

You can add to your twig template include line. 

    {% include 'XsolveCookieBundle::cookie_bar.html.twig' %}

Cookies message should be presented only on selected pages.

