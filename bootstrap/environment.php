<?php

if(!function_exists('laravel_version_compare')) {
    /**
     *
     * Compare two sets of versions, where major/minor/etc. releases are separated by dots.
     * Returns 0 if both are equal, 1 if A > B, and -1 if B < A.
     *
     * @see http://php.net/manual/en/function.version-compare.php#89416
     *
     * @param $vers
     * @return int
     */
    function laravel_version_compare($vers)
    {
        $a = explode(".", rtrim($vers, ".0")); //Split version into pieces and remove trailing .0
        $laravel = app();
        $b = explode(".", rtrim($laravel::VERSION, ".0")); //Split version into pieces and remove trailing .0
        foreach ($a as $depth => $aVal) { //Iterate over each piece of A
            if (isset($b[$depth])) { //If B matches A to this depth, compare the values
                if ($aVal > $b[$depth]) return 1; //Return A > B
                else if ($aVal < $b[$depth]) return -1; //Return B > A
                //An equal result is inconclusive at this point
            } else { //If B does not match A to this depth, then A comes after B in sort order
                return 1; //so return A > B
            }
        }
        //At this point, we know that to the depth that A and B extend to, they are equivalent.
        //Either the loop ended because A is shorter than B, or both are equal.
        return (count($a) < count($b)) ? -1 : 0;
    }
}


$env = $app->detectEnvironment(function(){
    $environmentPath = __DIR__.'/../env/.environment.env';

    if (getenv('APP_ENV')=='testing') {//&& file_exists(__DIR__.'/../env/.' .getenv('APP_ENV').'.env')) {
        //Dotenv::load(__DIR__ . '/../env/', '.' . getenv('APP_ENV') . '.env');
        $environmentPath = __DIR__.'/../env/.environment.testing.env';
    }

    if (file_exists($environmentPath)) {


        $setEnvArray = file($environmentPath);

        foreach ($setEnvArray as $setEnv) {
            $setEnv=trim($setEnv);
            if (file_exists(__DIR__.'/../env/.' .$setEnv .'.env')) {
                putenv("APP_ENV=$setEnv");
                if (getenv('APP_ENV') && file_exists(__DIR__.'/../env/.' .getenv('APP_ENV') .'.env')) {

                    if(laravel_version_compare('5.2')>=0){ //for laravel 5.0.x-5.1.x (DOTENV 1.x)
                        Dotenv::load(__DIR__ . '/../env/', '.' . getenv('APP_ENV') . '.env');
                    }else{ //for laravel 5.2.x+ (DOTENV 2.x)
                        new \Dotenv\Dotenv(__DIR__ . '/../env/', '.' . getenv('APP_ENV') . '.env');
                    }

                }
            }
        }


    }
});

