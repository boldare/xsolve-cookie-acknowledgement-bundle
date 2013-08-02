# About

This bundle provides information about an cookies usage, which is forced by European Union by so-called [EU cookie law](http://www.ico.org.uk/for_organisations/privacy_and_electronic_communications/the_guide/cookies).

This bundle provides flexible way of dealing with informing your visitors about cookies. It includes:

* fast & easy integration and short learning curve
* automatic cookie bar injection on the bottom of the page
* ability to manually inject cookie bar (for example for iframes)
* ability to change text and "close button" name
* locale aware
* ability to provide own cookie bar template

This bundle requires Multibyte String extension.

![Example usage](Resources/doc/xsolve-cookie-acknowledgement-bundle-example.png)

# Installation

1) Add to composer.json

    {
        "require": {
            "xsolve-pl/xsolve-cookie-acknowledgement-bundle": "dev-master"
        },
        "repositories": [
            { 
                "type": "vcs",
                "url": "git@github.com:xsolve-pl/xsolve-cookie-acknowledgement-bundle.git"
            }
        ]
    }

2) Install dependencies

    composer install

3) Run the bundle in app/AppKernel.php

    public function registerBundles()
    {
        return array(
            // ...
            new Xsolve\CookieAcknowledgementBundle\XsolveCookieAcknowledgementBundle(),
        );
    }

# Usage

## For all static pages

By default the cookie bar will be visible on every page after turning on bundle.

## For iframes

Disable response injection in app/config/config.yml

    xsolve_cookie_acknowledgement:
        response_injection: false

Include cookie bar in appropriate location

    {% include 'XsolveCookieAcknowledgementBundle::cookie_acknowledgement_bar.html.twig' %}

## Configuration options

Configuration can be adjusted in app/config/config.yml

    xsolve_cookie_acknowledgement:
        response_injection: true # default true
        cookie_expiry_time: 30 # expiry period in days (turning off cookie bar), by default 10 years
        template: custom_cookie_bar.html.twig # twig template name, default: XsolveCookieAcknowledgementBundle::cookie_acknowledgement_bar.html.twig

## Altering cookie bar texts

Place tranlations file in your app directory:

    app/Resources/translations/XsolveCookieAcknowledgementBundle.en.yml

And change texts

    cookie.message: My message
    cookie.message.accept: Accept button text

Of course you can set up those texts in as many locales as you want.

## Altering cookie bar apperance

By default cookie bar comes with some default styles. If you wish to change those, use CSS. For example you may want pink background with placement on top of the page:

    #cookie-law-info-bar {
        background: pink !important;
        top: 50px !important;
        bottom: auto !important;
    }

Please note that every style needs ```!important``` to override provided inline styles.

## Altering whole cookie bar template

You use your own template by setting it in the configuration (app/config/config.yml):

    xsolve_cookie_acknowledgement:
        template: ::custom_cookie_bar.html.twig

In above case template is located in app/Resources/custom_cookie_bar.html.twig

Also base template can be reused be Twig extension (two blocks are used: xsolve_cookie_message and xsolve_cookie_message_js), see example below:

    {% extends "XsolveCookieAcknowledgementBundle::cookie_acknowledgement_bar.html.twig" %}

    {% block xsolve_cookie_message %}
        {{ parent() }}
        <div>This is something custom</div>
    {% endblock %}

    {% block xsolve_cookie_message_js %}
        {{ parent() }}
        <script type="text/javascript">
            document.getElementById('cookie-law-close-button').onclick = function () {
                alert('Got ya!');
            }
        </script>
    {% endblock %}

# Automated testing

There are fe simple test to make sure that everything works fine. To run tests include this bundle
into some Symfony2 project (Symfony Standard Edition is enough). Then put testsuite in app/phpunit.xml

    <testsuite name="XSolve Cookie Acknowledgement Bundle Suite">
        <directory>../vendor/xsolve-pl/xsolve-cookie-acknowledgement-bundle/Xsolve/CookieAcknowledgementBundle/Tests/</directory>
    </testsuite>

And run

    phpunit -c app/
