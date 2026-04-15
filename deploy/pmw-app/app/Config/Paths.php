<?php

namespace Config;

/**
 * Paths
 *
 * This file contains the paths to the different directories
 * used by the framework.
 */
class Paths
{
    /**
     * ---------------------------------------------------------------
     * SYSTEM DIRECTORY NAME
     * ---------------------------------------------------------------
     *
     * This variable must contain the name of your "system" directory.
     * Path to the system directory.
     */
    public string $systemDirectory = __DIR__ . '/../../vendor/codeigniter4/framework/system';

    /**
     * ---------------------------------------------------------------
     * APPLICATION DIRECTORY NAME
     * ---------------------------------------------------------------
     *
     * This variable must contain the name of your "app" directory.
     */
    public string $appDirectory = __DIR__ . '/..';

    /**
     * ---------------------------------------------------------------
     * WRITABLE DIRECTORY NAME
     * ---------------------------------------------------------------
     *
     * This variable must contain the name of your "writable" directory.
     */
    public string $writableDirectory = __DIR__ . '/../../writable';

    /**
     * ---------------------------------------------------------------
     * TESTS DIRECTORY NAME
     * ---------------------------------------------------------------
     *
     * This variable must contain the name of your "tests" directory.
     */
    public string $testsDirectory = __DIR__ . '/../../tests';

    /**
     * ---------------------------------------------------------------
     * VIEW DIRECTORY NAME
     * ---------------------------------------------------------------
     *
     * This variable must contain the name of your "views" directory.
     */
    public string $viewDirectory = __DIR__ . '/../Views';
}
