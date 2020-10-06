<?php

/*
 * subscribersController extend Controller
 *
 * */

class subscribersController extends Controller
{
    /*
     * current table
     * @var string
     * */
    private $table = "subscribers";
    /*
     * required field to create subscriber
     * @var array
     * */
    private $createRequiredFields = array('name', 'email_address', 'states_id');
    /*
     *required field to update subscriber
     * @var array
     * */
    private $updateRequiredFields = array('name', 'states_id');
    /*
     * related model
     * @var object
     * */
    private $subscribers;

    public function __construct()
    {
        require(ROOT . 'Models/Subscriber.php');
        $this->subscribers = new Subscriber();
    }

    /*
     * create new subscriber
     * POST request only
     * */
    public function create()
    {
        $input = (array)json_decode(file_get_contents('php://input'), true);

        $input = $this->secureJson($input);
        $validateCreateSubscriber = $this->validateJsonInput($input, $this->createRequiredFields);

        if ($validateCreateSubscriber['success']) {
            $input['changed_date'] = date('Y-m-d H:i:s');
            $input['created_date'] = date('Y-m-d H:i:s');
            $created = $this->subscribers->create($input);

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
     * fetching  subscribers
     *
     * GET request only
     * */
    public function get($field = null, $value = null)
    {
        // if field is null select all users
        if (is_null($field)) {
            $data['subscribers'] = $this->subscribers->selectAll();
            $result = $data['subscribers'];
        } else {
            $data['subscribers'] = $this->subscribers->selectBy($field, $value);
            $result = $data['subscribers'];
        }

        $response['status_code_header'] = http_response_code(200);
        $response['body'] = json_encode($result);

        return $response;
    }

    /*
     * updating  subscribers
     *
     * PUT request only
     * */
    public function update($id)
    {
        $input = (array)json_decode(file_get_contents('php://input'), true);
        $input = $this->secureJson($input);

        $validateCreateSubscriber = $this->validateJsonInput($input, $this->updateRequiredFields);

        if ($validateCreateSubscriber['success']) {
            $input['changed_date'] = date('Y-m-d H:i:s');
            $created = $this->subscribers->update($input, $id);

            if ($created) {
                $response['status_code_header'] = http_response_code(202);
                $response['body'] = json_encode($this->response($created, "successfully updated", 204));
            } else {
                $response['status_code_header'] = http_response_code(400);
                $response['body'] = json_encode($this->response(false, "incorrect field name", 400));
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
     * delete  subscribers
     *
     * DELETE request only
     * */
    public function delete($id = 0)
    {
        if ($this->isValidIntager($id)) {
            $input = array(
                'states_id' => '6',
                'changed_date' => date('Y-m-d H:i:s')
            );

            $created = $this->subscribers->update($input, $id);

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