<?php

return array(
    'di' => array(
        'instance' => array(
            'alias' => array(
                'limocart_api' => 'LimocartPhpSdk\Limocart'
            ),
            'limocart_api' => array(
                'parameters' => array(
                    'config' => array(
                        'clientId' => '',
                        'clientSecret' => ''
                    )
                )
            ),
            'LimocartModule\Authentication\Adapter\Oauth2' => array(
                'parameters' => array(
                    'api' => 'limocart_api'
                )
            )
        )
    )
);