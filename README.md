# HuntKingdom_OneTeam
PIDEV PROJECT 3A19 Esprit 19-20

# Please read step by step instruction before use this  

Symfony Standard Edition
========================

**WARNING**: This distribution does not support Symfony 4. See the
[Installing & Setting up the Symfony Framework][15] page to find a replacement
that fits you best.

Welcome to the Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev env) - Adds code generation
    capabilities

  * [**WebServerBundle**][14] (in dev env) - Adds commands for running applications
    using the PHP built-in web server

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  https://symfony.com/doc/3.4/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.4/doctrine.html
[8]:  https://symfony.com/doc/3.4/templating.html
[9]:  https://symfony.com/doc/3.4/security.html
[10]: https://symfony.com/doc/3.4/email.html
[11]: https://symfony.com/doc/3.4/logging.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
[14]: https://symfony.com/doc/current/setup/built_in_web_server.html
[15]: https://symfony.com/doc/current/setup.html



# STEP BY STEP INSTRUCTIONS TO USE THAT

# 1st install composer 

composer install


# 2nd set symfony and composer commands

# change file vendor/friendsofsymfony/user-bundle/Resources/views/Security/login_content.html.twig

with :

.. code-block:: php

{% trans_default_domain 'FOSUserBundle' %}

<section class="login_part section_padding ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2><img src="img/LOGOHUNT1.png" alt="logo"></h2>
                        <h2>Nouveau?</h2>
                        <p>Tu es un chasseur/pecheur et tu aimerait recevoir/donner des conseils, acquerir des outils ou rester informer sur le fil d'actualité ?
                            Alors n'attend plus :</p>
                        <a href="{{ path('fos_user_registration_register') }}" class="btn_3">Creer un Compte</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="login_part_form">
                    <div class="login_part_form_iner c-form-box wow fadeInUp">
                        <h3>Bienvenue ! <br>
                            Authentifiez vous</h3>

{% if error %}
    <div style="color: red">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
{% endif %}

<form action="{{ path("fos_user_security_check") }}" method="post" class="row contact_form" >
    {% if csrf_token %}
        <input type="hidden" name="_csrf_token" value="{{ csrf_token }}" />
    {% endif %}

    <div class="col-md-12 form-group p_star">
        <label for="username">{{ 'security.login.username'|trans }}</label>
        <input type="text" class="form-control" id="username" name="_username" value="{{ last_username }}" required="required" autocomplete="username" />
    </div>

    <div class="col-md-12 form-group p_star">
        <label for="password">{{ 'security.login.password'|trans }}</label>
        <input type="password" class="form-control" id="password" name="_password" required="required" autocomplete="current-password" />
    </div>

    <div class="col-md-12 form-group">
        <div class="creat_account d-flex align-items-center">
            <input type="checkbox" id="remember_me" name="_remember_me" value="on" />
            <label for="remember_me">{{ 'security.login.remember_me'|trans }}</label>
        </div>

        <input type="submit" class="btn_3" id="_submit" name="_submit" value="{{ 'security.login.submit'|trans }}" />
        <a class="lost_pass" href="#">Mot de passe oublié?</a>
    </div>

</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


# then change file vendor/friendsofsymfony/user-bundle/Resources/views/Registration/register_content.html.twig

with

{% trans_default_domain 'FOSUserBundle' %}

<section class="login_part section_padding ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 ">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2><img src="{{ asset('img/LOGOHUNT1.png') }}" alt="logo"></h2>
                        <h2>Vous avez deja un compte?</h2>
                        <p></p>
                        <a href="{{ path('fos_user_security_login') }}" class="btn_3">Connectez vous</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" id="signup">
                <div class="login_part_form">
                    <div class="login_part_form_iner c-form-box wow fadeInUp">
                        <h3 class="c-form-top">Bienvenue ! <br>
                            Content de vous voir</h3>

{{ form_start(form, {'method': 'post', 'action': path('fos_user_registration_register'), 'attr': {'class': 'row contact_form c-form-bottom'}}) }}

                        <div class="col-md-12 form-group p_star">
                            <label for="c-form-name">
                                <span class="label-text">Nom</span>
                                <span class="contact-error">{{ form_errors(form.nom) }}</span>
                            </label>
                            {{ form_widget(form.nom,  {'attr': {'class': 'form-control'}}) }}
                        </div>

                        <div class="col-md-12 form-group p_star">
                            <label for="c-form-name">
                                <span class="label-text">Prenom</span>
                                <span class="contact-error">{{ form_errors(form.prenom) }}</span>
                            </label>
                            {{ form_widget(form.prenom,  {'attr': {'class': 'form-control'}}) }}
                        </div>

<div class="col-md-12 form-group p_star">
    <label for="c-form-name">
        <span class="label-text">Email</span>
        <span class="contact-error">{{ form_errors(form.email) }}</span>
    </label>
    {{ form_widget(form.email,  {'attr': {'class': 'form-control'}}) }}
</div>
                        <div class="col-md-12 form-group p_star">
                            <label for="c-form-name">
                                <span class="label-text">Telephone</span>
                                <span class="contact-error">{{ form_errors(form.telephone) }}</span>
                            </label>
                            {{ form_widget(form.telephone,  {'attr': {'class': 'form-control','maxlength':'8'}}) }}
                        </div>

                        <div class="col-md-12 form-group p_star">
                            <label for="c-form-name">
                                <span class="label-text">Adresse de residence</span>
                                <span class="contact-error">{{ form_errors(form.adresse) }}</span>
                            </label>
                            {{ form_widget(form.adresse,  {'attr': {'class': 'form-control'}}) }}
                        </div>

<div class="col-md-12 form-group p_star">
    <label for="c-form-name">
        <span class="label-text">Nom d'utilisateur</span>
        <span class="contact-error">{{ form_errors(form.username) }}</span>
    </label>
    {{ form_widget(form.username,  {'attr': {'class': 'form-control'}}) }}
</div>

<div class="col-md-12 form-group p_star">
    <label for="c-form-name">
        <span class="label-text">Mot de passe</span>
        <span class="contact-error">{{ form_errors(form.plainPassword.first) }}</span>
    </label>
    {{ form_widget(form.plainPassword.first,  {'attr': {'class': 'form-control'}}) }}
</div>

<div class="col-md-12 form-group p_star">
    <label for="c-form-name">
        <span class="label-text">Confirmez le Mot de passe</span>
        <span class="contact-error">{{ form_errors(form.plainPassword.second) }}</span>
    </label>
    {{ form_widget(form.plainPassword.second,  {'attr': {'class': 'form-control'}}) }}
</div>

<div class="col-md-12 form-group p_star">
    <label for="c-form-name">
        <span class="label-text">Votre domaine</span>
        <span class="contact-error">{{ form_errors(form.roles) }}</span>
    </label>
    {{ form_widget(form.roles,  {'attr': {'class': 'form-control'}}) }}
</div>

                        <div class="col-md-12 form-group p_star">
                            <label for="c-form-name">
                                <span class="label-text">Authorisation de l'exercice</span>
                                <span class="contact-error">{{ form_errors(form.num_auth) }}</span>
                            </label>
                            {{ form_widget(form.num_auth,  {'attr': {'class': 'form-control'}}) }}
                        </div>

    <div class="col-md-12 form-group" >
        <input class="btn_3" type="submit" value="{{ 'registration.submit'|trans }}" />
    </div>
{{ form_end(form) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

# continue with file vendor/friendsofsymfony/user-bundle/Resources/views/Registration/confirmed.html.twig

{% extends "@FOSUser/layout.html.twig" %}

{% trans_default_domain 'FOSUserBundle' %}

{% block fos_user_content %}

<section class="login_part section_padding ">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 ">
                <div class="login_part_text text-center">
                    <div class="login_part_text_iner">
                        <h2><img src="{{ asset('img/LOGOHUNT1.png') }}" alt="logo"></h2>
                        <h2>Vous avez deja un compte?</h2>
                        <p></p>
                        <a href="{{ path('fos_user_security_login') }}" class="btn_3">Connectez vous</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6" id="signup">
                <div class="login_part_form">
                    <div class="login_part_form_iner c-form-box wow fadeInUp">

    <p>{{ 'registration.confirmed'|trans({'%username%': user.username}) }}</p>
    {% if targetUrl %}
    <p><a href="{{ targetUrl }}">{{ 'registration.back'|trans }}</a></p>
    {% endif %}

                        <h3 class="c-form-top"><= Connectez vous pour acceder a votre compte</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{% endblock fos_user_content %}

