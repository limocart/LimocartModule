<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'limocart_api' => function($sm) {
                $api = new \LimocartPhpSdk\Limocart(array(
                    'client_id' => '',
                    'client_secret' => ''
                ));

                return $api;
            },
            'LimocartModule\Authentication\Adapter\Oauth2' => function ($sm) {
                $adapter = new \LimocartModule\Authentication\Adapter\Oauth2();
                $adapter->setApi($sm->get('limocart_api'));

                return $adapter;
            }
        )
    )
);