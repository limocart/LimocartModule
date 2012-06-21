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
            )
        )
    )
);