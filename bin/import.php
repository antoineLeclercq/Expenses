<?php

    // include config.php
    require("../includes/constants.php");

    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO('pgsql:host='.SERVER.';port=5432;dbname='.DATABASE, USERNAME, PASSWORD);
                //pgsql:user=' . USERNAME ' dbname=' . DATABASE ' password=' . PASSWORD);

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

    // run only if one argument
    if ( $argc != 2) {
        print("Usage: ./import path/to/file.txt");
    }
    else {

        // validate path
        $path = $argv[1];
        $path_parts = pathinfo($argv[1]);

        if ( $path_parts['filename'] =! "US" || $path_parts['extension'] != "txt" ) {
            print ("This not a valid file!");
        }

        // check file exists
        if ( !file_exists($path) ) {
            print ("File does not exist!");
        }

        // check file is readable
        if ( !is_readable($path) ) {
            print ( "File is not readable!");
        }

        // initialize array containing line elements
        $line = [];
        $data = [];
        $i = 0;

        // open file
        $file = fopen($path, 'r');

        // for each line
        while ( ($data = fgetcsv($file, 1000, "\t")) != NULL ) {

            print_r($data);
            // insert into database via query
            if ( query("INSERT INTO places (country_code, postal_code, place_name, admin_name1, admin_code1, admin_name2, admin_code2, admin_name3, admin_code3, latitude, longitude, accuracy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11]) !== false) {
                print("OK\n");
            }
            else {
                print("ERROR\n");
            }

        }
    }

?>
