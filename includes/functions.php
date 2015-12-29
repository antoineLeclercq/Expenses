<?php

    require_once("constants.php");

    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
        exit;
    }

    /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }

    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
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

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
    function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../static/templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // render header
            require("../static/templates/header.php");

            // render template
            require("../static/templates/$template");

            // render footer
            require("../static/templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

    /**
     * Sends an email, passing in parameters.
     */
     function send_email($email, $body, $subject, $password) {
        require("../../PHPMailer-master/class.phpmailer.php");
        require("../../PHPMailer-master/class.smtp.php");

        // extract email domain
        $domain = substr(strrchr($email, "@"), 1);

        if ( filter_var($email, FILTER_VALIDATE_EMAIL) && checkdnsrr($domain, 'MX') )
        {
            // instantiate mailer
            $mail = new PHPMailer();

            // use your ISP's SMTP server (e.g., smtp.fas.harvard.edu if on campus or smtp.comcast.net if off campus and your ISP is Comcast)
            $mail->IsSMTP();

            // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPDebug = 1;

            // authentication enabled
            $mail->SMTPAuth = true;

            // secure transfer enabled REQUIRED for Gmail
            $mail->SMTPSecure = 'ssl';

            $mail->Host = "smtp.gmail.com";

            // or 587 this is the port that Gmail use
            $mail->Port = 465;
            $mail->IsHTML(true);

            //google acount username and password
            $mail->Username = "courses.email.testing@gmail.com";
            $mail->Password = "u91BP5h2qhRz";

            // set From:
            $mail->SetFrom("courses.email.testing@gmail.com");

            // set To:
            $mail->AddAddress($email);

            // set Subject:
            $mail->Subject = $subject;

            // set body
            $mail->Body = $body;

            // send mail
            if ($mail->Send() === false)
            {
                die($mail->ErrorInfo . "\n");
                return false;
            }
            else
            {
                return true;
            }
        }

        return false;

    }