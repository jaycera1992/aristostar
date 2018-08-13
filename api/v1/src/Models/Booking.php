<?php

namespace App\Models;

use PDO;

class Booking
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;

        $this->now = date('Y-m-d H:i:s');
        $this->gmnow = gmdate('Y-m-d H:i:s');
        $this->timestamp = strtotime($this->gmnow . ' UCT');
    }

    public function getBookingTime() {
        try {
            $sql = "
            SELECT
                    time_id, time, is_deleted, created_user_id, date_created, date_updated
            FROM
                    s_time_reference
            ";

            $statement = $this->db->prepare($sql);

            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $results = $statement->fetchAll();

            if (count($results) >= 0) {
              return $results;
            } else {
              return false;
            }
        } catch (PDOException $e) {
            return $e;
        }
    }
}
