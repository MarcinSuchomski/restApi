<?php


class fieldsTypesController extends Controller
{
    /*
     * related model
     * @var object
     * */
    private $model;

    public function __construct()
    {
        require(ROOT . 'Models/FieldsType.php');
        $this->model = new FieldsType();
    }

    public function create()
    {
        $response['status_code_header'] = http_response_code(403);
    }
    /*
     * Fetching fieldsTypes
     * Get Request only
     * */
    public function get( $field = null ,$value = null )
    {
        // if field is null select all users
        if (is_null($field))
        {
            $data['fields'] = $this->model->selectAll();
            $result = $data['fields'];
        }
        else
        {
            $data['fields'] = $this->model->selectBy( $field , $value);
            $result = $data['fields'];
        }

        $response['status_code_header'] = http_response_code(200);
        $response['body'] = json_encode($result);

        return $response;
    }

    public function update( $id )
    {
        $response['status_code_header'] = http_response_code(403);
    }

    public function delete( $id  )
    {
        $response['status_code_header'] = http_response_code(403);
    }
}