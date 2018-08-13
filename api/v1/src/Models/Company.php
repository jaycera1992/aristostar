<?php

namespace App\Models;

use PDO;

class Company
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;

        $this->now = date('Y-m-d H:i:s');
        $this->gmnow = gmdate('Y-m-d H:i:s');
        $this->timestamp = strtotime($this->gmnow . ' UCT');
    }

    public function addCompany($companyId, $companyName, $shortName , $companyAddress, 
            $landline, $commission, $website, $contractDate, $repPosition, $repName, $repPhone, $repEmail, $currentUserId) {
        
        try {
            $sql = "
                INSERT INTO
                    s_company
                    (company_id, company_name, short_name, phone, commission, company_address, website, contract_date, representative_position, 
                        representative_name, representative_phone, representative_email, date_created, created_user_id)
                VALUES
                ('$companyId', '$companyName', '$shortName', '$landline', '$commission', '$companyAddress', '$website', '$contractDate', '$repPosition'
                , '$repName', '$repPhone', '$repEmail', now(), '$currentUserId');
            ";
 
            $statement = $this->db->prepare($sql);

            if (!$statement->execute()) {
                return false;
            }
            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getCompany($limit, $offset) {
        try {
            $sql = "
                SELECT
                    company_id, company_name, short_name, phone, commission, company_address, website,
                    contract_date, representative_name, representative_email, representative_position,
                    representative_phone, is_deleted, date_created, created_user_id
                FROM
                    s_company
                ORDER BY
                    date_created DESC
                LIMIT
                    $offset, $limit
            ";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();
            
            if (count($results) >= 1) {
              return $results;
            } else {
              return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function deleteCompany($userId, $deletedCompanyId) {
        try {
            $sql = "
                    UPDATE
                        s_company
                    SET
                        `is_deleted` = 1,
                        `updated_user_id` = '$userId',
                        `date_updated` = NOW()
                    WHERE
                        `company_id` = '$deletedCompanyId'
                ";

            $statement = $this->db->prepare($sql);

            if (!$statement->execute()) {
                return false;
            }

            return true;

        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getTotalCompany() {
        try {
            $sql = "
                SELECT
                   count(company_id) as total
                FROM
                    s_company
                ORDER BY
                    date_created
            ";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();
            
            if (count($results) >= 1) {
              return $results[0];
            } else {
              return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getTotalDeletedCompany() {
        try {
            $sql = "
                SELECT
                   count(company_id) as total
                FROM
                    s_company
                WHERE
                    is_deleted = 1
                ORDER BY
                    date_created
            ";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();
            
            if (count($results) >= 1) {
              return $results[0];
            } else {
              return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }

    public function getTotalActiveCompany() {
        try {
            $sql = "
                SELECT
                   count(company_id) as total
                FROM
                    s_company
                WHERE
                    is_deleted = 0
                ORDER BY
                    date_created
            ";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();
            
            if (count($results) >= 1) {
              return $results[0];
            } else {
              return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }


}
