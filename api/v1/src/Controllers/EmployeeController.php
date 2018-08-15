<?php
namespace App\Controllers;

use App\Models\Employee;

use App\Helpers\CommonFunction;
use App\Helpers\PasswordHash;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Respect\Validation\Validator as v;

/**
 * Class EmployeeController
 * @package App\Controllers
 */

class EmployeeController
{
    protected $employee;
    protected $commonFunction;
    protected $passwordHash;

    public function __construct(Employee $employee, CommonFunction $commonFunction, PasswordHash $passwordHash)
    {
        $this->employee         = $employee;
        $this->commonFunction   = $commonFunction;
        $this->passwordHash     = $passwordHash;
    }

    /**
     * @param $request
     * @param $response
     * @return $response
     */
    
    public function addEmployee($request, $response, $args) {

        $currentUserId = (!empty($args['user_id'])) ? $args['user_id'] : null;
        
        $data = $request->getParam("data");
        $data = (!empty($data)) ? json_decode($data) : null;
        
        if (empty($data) || empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $firstName       = (!empty($data->firstName)) ? $data->firstName : null;
        $lastName        = (!empty($data->lastName)) ? $data->lastName : null;
        $email           = (!empty($data->email)) ? $data->email : null;
        $designation     = (!empty($data->designation)) ? $data->designation : null;
        $companyId         = (!empty($data->company)) ? $data->company : null;
        
        if (v::nullType()->validate($firstName) || v::nullType()->validate($lastName) 
        || v::nullType()->validate($designation) || v::nullType()->validate($companyId) || v::nullType()->validate($email) || !v::email()->validate($email)) {

            return $response->withStatus(200)->withJson(array(
            'success' => false,
            'valid'   => false
            ));
        }

        $employeeId    = uniqid(bin2hex(openssl_random_pseudo_bytes(6)));

        $result = $this->employee->addEmployee($employeeId, $firstName, $lastName , $email, 
                $designation, $companyId, $currentUserId);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
                'error' => 'Company Creation'
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function updateEmployee($request, $response, $args) {

        $currentUserId = (!empty($args['user_id'])) ? $args['user_id'] : null;
        $updateEmployeeId = (!empty($args['update_employee_id'])) ? $args['update_employee_id'] : null;

        $data = $request->getParam("data");
        $data = (!empty($data)) ? json_decode($data) : null;

        if (empty($data) || empty($currentUserId) || empty($updateEmployeeId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $firstName       = (!empty($data->firstName)) ? $data->firstName : null;
        $lastName        = (!empty($data->lastName)) ? $data->lastName : null;
        $email           = (!empty($data->email)) ? $data->email : null;
        $designation     = (!empty($data->designation)) ? $data->designation : null;
        $companyId       = (!empty($data->company)) ? $data->company : null;
        $isActive        = (!empty($data->isActive)) ? $data->isActive : null;

        if (v::nullType()->validate($firstName) || v::nullType()->validate($lastName) 
        || v::nullType()->validate($designation) || v::nullType()->validate($companyId) || v::nullType()->validate($email) || !v::email()->validate($email)) {

            return $response->withStatus(200)->withJson(array(
            'success' => false,
            'valid'   => false
            ));
        }

        $result = $this->employee->updateEmployee($updateEmployeeId, $firstName, $lastName , $email, 
        $designation, $companyId, $isActive, $currentUserId);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
                'error' => 'Employee Updating'
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function getEmployee($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];
        $companyId  = $args['company_id'];
        $searchItem = (empty($args['searchItem'])) ? '' : $args['searchItem'];
        
        $offset         = ($args['offset'] == 1) ? 0 : $args['offset'] * 10;
        $limit  = 10;

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }
        if($offset != 0) {
            $offset -= 10;
        }

        $result = $this->employee->getEmployee($companyId, $searchItem, $limit, $offset);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }

        foreach ($result as $key => $value) {
            if ($result[$key]['date_created']) {
                $old_date_timestamp           = strtotime($value['date_created']);
                $result[$key]['date_created'] = date('F d Y', $old_date_timestamp); 
            }
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function deleteEmployee($request, $response, $args)
    {   
        $userId     = (!empty($args['user_id'])) ? $args['user_id'] : null;
        $deletedEmployeeId = (!empty($args['delete_employee_id'])) ? $args['delete_employee_id'] : null;

        if (empty($userId) || empty($deletedEmployeeId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }

        $result = $this->employee->deleteEmployee($userId, $deletedEmployeeId);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }

        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }
}
