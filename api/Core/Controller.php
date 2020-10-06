<?php

/*
 *  Main controller calss
 *
 * contains data validation (to be moved outiste )
 *
 * */

class Controller
{
    /*
     * controller response
     * @param $success bool
     * @param $message string
     * @param $statusCodeHeader string
     *
     * @return array
     * */
    function json_validate($string)
    {
        // decode the JSON data
        $result = json_decode($string);

        // switch and check possible JSON errors
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                $error = ''; // JSON is valid // No error has occurred
                break;
            case JSON_ERROR_DEPTH:
                $error = 'The maximum stack depth has been exceeded.';
                break;
            case JSON_ERROR_STATE_MISMATCH:
                $error = 'Invalid or malformed JSON.';
                break;
            case JSON_ERROR_CTRL_CHAR:
                $error = 'Control character error, possibly incorrectly encoded.';
                break;
            case JSON_ERROR_SYNTAX:
                $error = 'Syntax error, malformed JSON.';
                break;
            // PHP >= 5.3.3
            case JSON_ERROR_UTF8:
                $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_RECURSION:
                $error = 'One or more recursive references in the value to be encoded.';
                break;
            // PHP >= 5.5.0
            case JSON_ERROR_INF_OR_NAN:
                $error = 'One or more NAN or INF values in the value to be encoded.';
                break;
            case JSON_ERROR_UNSUPPORTED_TYPE:
                $error = 'A value of a type that cannot be encoded was given.';
                break;
            default:
                $error = 'Unknown JSON error occured.';
                break;
        }

        if ($error !== '') {
            // throw the Exception or exit // or whatever :)
            $this->response(false, $error, "404");
        }

        // everything is OK
        return $this->response(true, "", "200");
    }

    /*
     * checks if its intager
     *
     * */

    public function response($success, $message, $statusCodeHeader)
    {
        return array(
            'success' => $success,
            'message' => $message,
            'status_code_header' => $statusCodeHeader
        );
    }

    /*
     * validate email
     * @param $value email
     * */

    public function secureJson($data)
    {
        foreach ($data as $key => $value) {
            $returnData[$key] = $this->secureInput($value);
        }

        return $returnData;
    }

    public function secureInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        //print_r($data);
        return $data;
    }

    /*
     * secureInput
     * @param array
     * */

    function validateJsonInput($input, $requireFields)
    {
        foreach ($requireFields as $field) {
            if (!array_key_exists($field, $input)) {
                // error
                return $this->response(false, "missing $field", "");
            }

            // check email
            if (isset($input['email_address'])) {
                if (!$this->isValidEmail($input['email_address'])) {
                    return $this->response(false, "Invalid Email", "400");
                }
            }
            // check int
            if (isset($input['state_id'])) {
                if (!$this->isValidIntager($input['state_id'])) {
                    return $this->response(false, "state_id must be a intager", "400");
                }
            }

            if (isset($input['fields_types_id'])) {
                if (!$this->checkIfExist("fields_types", "fields_types_id", $input['fields_types_id'])) {
                    return $this->response(false, "this type of file does not exist ", "400");
                }
            }

            if (isset($input['subscribers_id'])) {
                if (!$this->checkIfExist("subscribers", "subscribers_id", $input['subscribers_id'])) {
                    return $this->response(false, "this subscriber does does not exist ", "400");
                }
            }
        }

        return $this->response(true, "", "");
    }

    /*
     * secureJson loop array to secure input
     * @param array
     * */

    public function isValidEmail($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $domain_name = substr(strrchr($value, "@"), 1);
            return checkdnsrr($domain_name) ? true : false;
        } else {
            return false;
        }
    }

    /*
     * check if value exist in the DB
     * */

    public function isValidIntager($value)
    {
        return ctype_digit($value);
    }

    /*
     * validate input
     * @param $requireFields array  - list of required field pre action
     * @param $input array - list of posted field and values
     *
     * @return response
     * */

    public function checkIfExist($table, $field, $value)
    {
        // require(ROOT . 'Core/Model.php');
        // echo $table .",". $field.", ".$value;
        $model = new Model();
        return $model->checkIfExists($table, $field, $value);
    }


}

?>