<?php

/*
 * This file is part of the LegGoogleChartsBundle package.
 *
 * (c) Titouan Galopin <http://titouangalopin.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$vendorDir = __DIR__.'/../vendor';
require_once $vendorDir.'/symfony/src/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();

$loader->registerNamespaces(array(
    'Symfony'                => array($vendorDir.'/symfony/src', $vendorDir.'/bundles'),
    'Doctrine\\Common'       => $vendorDir.'/doctrine-common/lib',
    'Doctrine\\DBAL'         => $vendorDir.'/doctrine-dbal/lib',
    'Doctrine'               => $vendorDir.'/doctrine/lib',
));

$loader->registerPrefixes(array(
    'Twig_'            => $vendorDir.'/twig/lib',
));

$loader->register();

spl_autoload_register(function($class)
{
    if (0 === strpos($class, 'Leg\\GoogleChartsBundle\\'))
    {
        $path = __DIR__.'/../'.implode('/', array_slice(explode('\\', $class), 2)).'.php';
        
        if (!stream_resolve_include_path($path))
            return false;
        
        require_once $path;
        return true;
    }
});
