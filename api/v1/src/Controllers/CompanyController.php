<?php
namespace App\Controllers;

use App\Models\Company;

use App\Helpers\CommonFunction;
use App\Helpers\PasswordHash;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Respect\Validation\Validator as v;
/**
 * Class CompanyController
 * @package App\Controllers
 */

class CompanyController
{
    protected $company;
    protected $commonFunction;
    protected $passwordHash;

    public function __construct(Company $company, CommonFunction $commonFunction, PasswordHash $passwordHash)
    {
        $this->company          = $company;
        $this->commonFunction   = $commonFunction;
        $this->passwordHash     = $passwordHash;
    }

    /**
     * @param $request
     * @param $response
     * @return $response
     */
    public function getCompany($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];
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

        $result = $this->company->getCompany($limit, $offset);

        foreach ($result as $key => $value) {
            if ($result[$key]['date_created']) {
                $old_date_timestamp           = strtotime($value['date_created']);
                $result[$key]['date_created'] = date('F d Y', $old_date_timestamp); 
                $result[$key]['company_name'] =  html_entity_decode($result[$key]['company_name'], ENT_QUOTES);
                $result[$key]['company_address'] =  html_entity_decode($result[$key]['company_address'], ENT_QUOTES);
            }
        }

        
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

    public function addCompany($request, $response, $args) {

        $currentUserId = (!empty($args['user_id'])) ? $args['user_id'] : null;
        
        $data = $request->getParam("data");
        $data = (!empty($data)) ? json_decode($data) : null;
        
        if (empty($data) || empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $companyName    = (!empty($data->companyName)) ? $data->companyName : null;
        $shortName      = (!empty($data->shortName)) ? $data->shortName : null;
        $companyAddress = (!empty($data->companyAddress)) ? $data->companyAddress : null;
        $landline       = (!empty($data->landline)) ? $data->landline : null;
        $website        = (!empty($data->website)) ? $data->website : null;
        
        if (v::nullType()->validate($companyName) || v::nullType()->validate($shortName) || v::nullType()->validate($companyAddress) || v::nullType()->validate($landline) || v::nullType()->validate($website)) {

            return $response->withStatus(200)->withJson(array(
            'success' => false,
            'valid'   => false
            ));
        }

        $companyName = $this->commonFunction->cleanString($companyName);
        $companyAddress = $this->commonFunction->cleanString($companyAddress);

        $companyId     = uniqid(bin2hex(openssl_random_pseudo_bytes(6)));
        $landline      = '+971' . $landline;

        $result = $this->company->addCompany($companyId, $companyName, $shortName , $companyAddress, 
                $landline, $website, $currentUserId);

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

    public function updateCompany($request, $response, $args) {

        $currentUserId = (!empty($args['user_id'])) ? $args['user_id'] : null;
        $updateCompanyId = (!empty($args['update_company_id'])) ? $args['update_company_id'] : null;

        $data = $request->getParam("data");
        $data = (!empty($data)) ? json_decode($data) : null;

        if (empty($data) || empty($currentUserId) || empty($updateCompanyId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $companyName    = (!empty($data->companyName)) ? $data->companyName : null;
        $shortName      = (!empty($data->shortName)) ? $data->shortName : null;
        $companyAddress = (!empty($data->companyAddress)) ? $data->companyAddress : null;
        $landline       = (!empty($data->landline)) ? $data->landline : null;
        $website        = (!empty($data->website)) ? $data->website : null;

        if (v::nullType()->validate($companyName) || v::nullType()->validate($shortName) || v::nullType()->validate($companyAddress) || v::nullType()->validate($landline) || v::nullType()->validate($website)) {

            return $response->withStatus(200)->withJson(array(
            'success' => false,
            'valid'   => false
            ));
        }

        $landline = '+971' . $landline;

        $result = $this->company->updateCompany($updateCompanyId, $companyName, $shortName , $companyAddress, 
            $landline, $website, $currentUserId);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
                'error' => 'Company updating'
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function deleteCompany($request, $response, $args)
    {   
        $userId     = (!empty($args['user_id'])) ? $args['user_id'] : null;
        $deletedCompanyId = (!empty($args['delete_company_id'])) ? $args['delete_company_id'] : null;

        if (empty($userId) || empty($deletedCompanyId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }

        $result = $this->company->deleteCompany($userId, $deletedCompanyId);

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

    public function getTotalCompany($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->company->getTotalCompany();

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

    public function getTotalActiveCompany($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->company->getTotalActiveCompany();

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

    public function getTotalDeletedCompany($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->company->getTotalDeletedCompany();

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
