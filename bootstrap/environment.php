<?php
/**
 * Created by PhpStorm.
 * User: Alessandro
 * Date: 24/11/2015
 * Time: 11:25
 */

$env = $app->detectEnvironment(function(){
    $environmentPath = __DIR__.'/../env/.environment.env';

    if (getenv('APP_ENV')=='testing') {//&& file_exists(__DIR__.'/../env/.' .getenv('APP_ENV').'.env')) {
        //Dotenv::load(__DIR__ . '/../env/', '.' . getenv('APP_ENV') . '.env');
        $environmentPath = __DIR__.'/../env/.environment.testing.env';
    }

    if (file_exists($environmentPath)) {

        /*$setEnv = trim(file_get_contents($environmentPath));

        if (file_exists(__DIR__.'/../.' .$setEnv .'.env')) {
            putenv("APP_ENV=$setEnv");
            if (getenv('APP_ENV') && file_exists(__DIR__.'/../.' .getenv('APP_ENV') .'.env')) {
                Dotenv::load(__DIR__ . '/../', '.' . getenv('APP_ENV') . '.env');
            }
        }*/

        $setEnvArray = file($environmentPath);

        foreach ($setEnvArray as $setEnv) {
            $setEnv=trim($setEnv);
            if (file_exists(__DIR__.'/../env/.' .$setEnv .'.env')) {
                putenv("APP_ENV=$setEnv");
                if (getenv('APP_ENV') && file_exists(__DIR__.'/../env/.' .getenv('APP_ENV') .'.env')) {
                    Dotenv::load(__DIR__ . '/../env/', '.' . getenv('APP_ENV') . '.env');
                }
            }
        }


    }
});