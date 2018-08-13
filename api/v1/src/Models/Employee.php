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

    public function getEmployee($limit, $offset) {
        try {
            $sql = "
                SELECT 
                    b.company_name, a.first_name, a.last_name, a.employee_id, a.email_address, a.designation, a.date_created, a.is_deleted, a.created_user_id
                FROM
                    s_employee AS a
                INNER JOIN
                    s_company AS b
                ON
                    a.company_id = b.company_id
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


}
