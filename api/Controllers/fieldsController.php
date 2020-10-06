<?php


class fieldsController extends Controller
{
    /*
     * required field to create Fields
     * @var array
     * */
    private $createRequiredFields = array('name', 'value', 'fields_types_id', 'subscribers_id');
    /*
     * required field to update Fields
     * @var array
     * */
    private $updateRequiredFields = array('name', 'value', 'fields_types_id');
    /*
     * model
     * @var object
     * */
    private $fields;

    public function __construct()
    {
        require(ROOT . 'Models/Field.php');
        $this->fields = new Field();
    }


    /*
     * create new Fields
     * POST request only
     * */
    public function create()
    {
        $input = (array)json_decode(file_get_contents('php://input'), true);

        $input = $this->secureJson($input);
        $validateCreateSubscriber = $this->validateJsonInput($input, $this->createRequiredFields);

        if ($validateCreateSubscriber['success']) {
            $input['deleted'] = 0;
            $created = $this->fields->create($input);

            if ($created) {
                $response['status_code_header'] = http_response_code(200);
                $response['body'] = json_encode($this->response($created, "sucessfully created subscriber", "200"));
            } else {
                $response['status_code_header'] = http_response_code(400);
            }
        } else {
            $response['status_code_header'] = http_response_code(400);
            $response['body'] = json_encode(
                $this->response($validateCreateSubscriber['success'], $validateCreateSubscriber['message'], 400)
            );
        }

        return $response;
    }

    /*
     * fetching fields
     * GET request only
     * */
    public function get($field = null, $value = null)
    {
        // if field is null select all users
        if ($field == 'id') {
            $data['fields'] = $this->fields->selectBy($field, $value);
            $result = $data['fields'];
        } else {
            $data['fields'] = $this->fields->selectBySubscriber($field, $value);
            $result = $data['fields'];
        }

        $response['status_code_header'] = http_response_code(200);
        $response['body'] = json_encode($result);

        return $response;
    }

    /*
     * update  Fields
     * PUT request only
     * */
    public function update($id)
    {
        $input = (array)json_decode(file_get_contents('php://input'), true);
        $input = $this->secureJson($input);

        $validateCreateSubscriber = $this->validateJsonInput($input, $this->updateRequiredFields);

        if ($validateCreateSubscriber['success']) {
            $created = $this->fields->update($input, $id);


            if ($created) {
                $response['status_code_header'] = http_response_code(202);
                $response['body'] = json_encode($this->response($created, "successfully updated", 204));
            } else {
                $response['status_code_header'] = http_response_code(400);
                $response['body'] = json_encode($this->response(false, "incorrect field name", 400));
            }
        } else {
            $response['status_code_header'] = http_response_code(400);
            $response['body'] = json_encode($this->response(false, $validateCreateSubscriber['message'], 400));
        }

        return $response;
    }

    /*
     * delete  Fields
     * DELETE request only
     * */
    public function delete($id)
    {
        if ($this->isValidIntager($id)) {
            $created = $this->fields->update($input = array('deleted' => '1'), $id);

            if ($created) {
                $response['status_code_header'] = http_response_code(202);
                $response['body'] = json_encode($this->response($created, "successfully deleted", 202));
            } else {
                $response['status_code_header'] = http_response_code(400);
                $response['body'] = json_encode($this->response(false, "invalid query", 400));
            }
        } else {
            $response['status_code_header'] = http_response_code(400);
            $response['body'] = json_encode($this->response(false, "invalid ID", 400));
        }

        return $response;
    }

}