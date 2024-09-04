<?php return array(
    'root' => array(
        'name' => '__root__',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '4a2d718df63c144925b34682e7dfeaeb88aa9b3e',
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '4a2d718df63c144925b34682e7dfeaeb88aa9b3e',
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'lastcraft/simpletest' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => 'v1.1.7',
            ),
        ),
        'phpmailer/phpmailer' => array(
            'pretty_version' => 'v6.9.1',
            'version' => '6.9.1.0',
            'reference' => '039de174cd9c17a8389754d3b877a2ed22743e18',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpmailer/phpmailer',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'simpletest/simpletest' => array(
            'pretty_version' => 'v1.1.7',
            'version' => '1.1.7.0',
            'reference' => '2f8c466c114bdb9c11028a0c3e6d1380ae6a18dc',
            'type' => 'library',
            'install_path' => __DIR__ . '/../simpletest/simpletest',
            'aliases' => array(),
            'dev_requirement' => true,
        ),
        'vierbergenlars/simpletest' => array(
            'dev_requirement' => true,
            'replaced' => array(
                0 => 'v1.1.7',
            ),
        ),
    ),
);
