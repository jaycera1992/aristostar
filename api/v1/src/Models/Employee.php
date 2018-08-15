<?php

namespace App\Models;

use PDO;

class Employee
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;

        $this->now = date('Y-m-d H:i:s');
        $this->gmnow = gmdate('Y-m-d H:i:s');
        $this->timestamp = strtotime($this->gmnow . ' UCT');
    }

    public function addEmployee($employeeId, $firstName, $lastName , $email, $designation, $companyId, $currentUserId) {
        
        try {
            $sql = "
                INSERT INTO
                    s_employee
                    (employee_id, first_name, last_name, email_address, designation, company_id, date_created, created_user_id)
                VALUES
                ('$employeeId', '$firstName', '$lastName', '$email', '$designation', '$companyId', now(), '$currentUserId');
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
    
    public function updateEmployee($employeeId, $firstName, $lastName , $email, $designation, $companyId, $isActive, $updatedUserId) {
        try {
            $sql = "
                    UPDATE
                        s_employee
                    SET
                        `first_name` = '$firstName',
                        `last_name` = '$lastName',
                        `email_address` = '$email',
                        `designation` = '$designation',
                        `company_id` = '$companyId',
                        `is_deleted` = '$isActive',
                        `updated_user_id` = '$updatedUserId',
                        `date_updated` = NOW()
                    WHERE
                        `employee_id` = '$employeeId'
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

    public function getEmployee($companyId, $searchItem, $limit, $offset) {
        $searchClause = '';
        if($searchItem != null || $searchItem != "") {
            $searchClause = "AND (a.first_name LIKE '%{$searchItem}%' || a.last_name LIKE '%{$searchItem}%')";
        }
        try {
            $sql = "
                SELECT 
                    b.company_name, b.company_id, a.first_name, a.last_name, a.employee_id, a.email_address, a.designation, a.date_created, a.is_deleted, a.created_user_id
                FROM
                    s_employee AS a
                INNER JOIN
                    s_company AS b
                ON
                    a.company_id = b.company_id
                WHERE
                    a.company_id = '$companyId'
                    {$searchClause}
                ORDER BY
                    a.date_created DESC
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

    public function deleteEmployee($userId, $deletedEmployeeId) {
        try {
            $sql = "
                    UPDATE
                        s_employee
                    SET
                        `is_deleted` = 1,
                        `updated_user_id` = '$userId',
                        `date_updated` = NOW()
                    WHERE
                        `employee_id` = '$deletedEmployeeId'
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


}
