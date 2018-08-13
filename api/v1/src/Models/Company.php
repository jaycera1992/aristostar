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
            $landline, $website, $currentUserId) {
        
        try {
            $sql = "
                INSERT INTO
                    s_company
                    (company_id, company_name, short_name, phone, company_address, website, date_created, created_user_id)
                VALUES
                ('$companyId', '$companyName', '$shortName', '$landline', '$companyAddress', '$website', now(), '$currentUserId');
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

    public function updateCompany($companyId, $companyName, $shortName , $companyAddress, $landline, $website, $isActive, $updatedUserId) {
        try {
            $sql = "
                    UPDATE
                        s_company
                    SET
                        `company_name` = '$companyName',
                        `short_name` = '$shortName',
                        `phone` = '$landline',
                        `company_address` = '$companyAddress',
                        `website` = '$website',
                        `is_deleted` = '$isActive',
                        `updated_user_id` = '$updatedUserId',
                        `date_updated` = NOW()
                    WHERE
                        `company_id` = '$companyId'
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
                    company_id, company_name, short_name, phone, company_address, website, is_deleted, date_created, created_user_id
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

    public function getCompanyReference() {
        try {
            $sql = "
                SELECT
                    company_id, company_name
                FROM
                    s_company
                ORDER BY
                    company_name ASC
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
