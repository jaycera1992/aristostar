<?php

namespace App\Helpers;
use PDO;
use Predis\Client as Predis;
use Predis\Connection as PredisCon;

class ElasticSearch
{
    protected $es;
    private $mRedis;
    private $sRedis;

    public function __construct($es, PDO $db, Predis $mRedis, Predis $sRedis) {
      $this->es = $es;
      $this->db = $db;

      $this->mRedis   = $mRedis;
      $this->sRedis   = $sRedis;

      $this->now = date('Y-m-d H:i:s');
      $this->dateNow = date('Y-m-d');
    }

    public function addSchool($schoolId, $school, $currentUserId) {
      
      $params = [
            'index' => 'schools',
            'type'  => 'info',
            'id'    => $schoolId,
            'body'  => [
                'school_id' => $schoolId,
                'en_school' => $school,
                'created_by_user_id' => $currentUserId,
                'updated_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }

    }

    public function addspecialties($specialtyId, $specialty, $currentUserId) {
      
      $params = [
            'index' => 'specialties',
            'type'  => 'info',
            'id'    => $specialtyId,
            'body'  => [
                'specialty_id' => $specialtyId,
                'en_specialty' => $specialty,
                'created_by_user_id' => $currentUserId,
                'updated_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }

    }

    public function addHonors($honorId, $honor, $currentUserId) {
      
      $params = [
            'index' => 'honors',
            'type'  => 'info',
            'id'    => $honorId,
            'body'  => [
                'honor_id' => $honorId,
                'en_honor' => $honor,
                'created_by_user_id' => $currentUserId,
                'updated_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }

    }

    public function addHobbies($hobbyId, $hobby, $currentUserId) {
      
      $params = [
            'index' => 'hobbies',
            'type'  => 'info',
            'id'    => $hobbyId,
            'body'  => [
                'hobby_id' => $hobbyId,
                'en_hobby' => $hobby,
                'created_by_user_id' => $currentUserId,
                'updated_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];
        
        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }

    }

    public function addIndustries($industryId, $industry, $currentUserId) {
      
      $params = [
            'index' => 'industries',
            'type'  => 'info',
            'id'    => $industryId,
            'body'  => [
                'industry_id' => $industryId,
                'en_industry' => $industry,
                'created_by_user_id' => $currentUserId,
                'updated_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }

    }

    public function addSkills($skillsId, $skills, $currentUserId) {

      $params = [
            'index' => 'skills',
            'type'  => 'info',
            'id'    => $skillsId,
            'body'  => [
                'skill_id' => $skillsId,
                'en_skill' => $skills,
                'created_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function addJob($jobId, $job, $currentUserId) {

      $params = [
            'index' => 'jobs',
            'type'  => 'info',
            'id'    => $jobId,
            'body'  => [
                'job_id' => $jobId,
                'en_job' => $job,
                'created_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function addTrainingCert($trainingCertId, $trainingCert, $currentUserId) {

      $params = [
            'index' => 'training_certificates',
            'type'  => 'info',
            'id'    => $trainingCertId,
            'body'  => [
                'training_certificate_id' => $trainingCertId,
                'en_training_certificate' => $trainingCert,
                'created_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function addCountry($countryId, $country, $currentUserId) {

      $params = [
            'index' => 'countries',
            'type'  => 'info',
            'id'    => $countryId,
            'body'  => [
                'country_id' => $countryId,
                'en_country' => $country,
                'created_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function addCourses($courseId, $course, $currentUserId) {

      $params = [
            'index' => 'courses',
            'type'  => 'info',
            'id'    => $courseId,
            'body'  => [
                'course_id' => $courseId,
                'en_course' => $course,
                'created_by_user_id' => $currentUserId,
                'date_created' => $this->now,
                'date_updated' => $this->now,
                'is_deleted' => 0,
                'is_approved' => 0,
                'approved_by_user_id' => ''
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSpecialtyHonor($specialtyId, $honorId, $honor) {
        $params = [
            'index' => 'specialties',
            'type'  => 'honors',
            'id'    => $honorId,
            'parent' => $specialtyId,
            'body'  => [
                'honor_id' => $honorId,
                'honor' => $honor
            ]
        ];
      
        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSpecialtyHobby($specialtyId, $hobbyId, $hobby) {
        $params = [
            'index' => 'specialties',
            'type'  => 'hobbies',
            'id'    => $hobbyId,
            'parent' => $specialtyId,
            'body'  => [
                'hobby_id' => $hobbyId,
                'hobby' => $hobby
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagHonorSpecialty($honorId, $specialtyId, $specialty) {
        $params = [
            'index' => 'honors',
            'type'  => 'specialties',
            'id'    => $specialtyId,
            'parent' => $honorId,
            'body'  => [
                'specialty_id' => $specialtyId,
                'specialty' => $specialty
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagHonorHobby($honorId, $hobbyId, $hobby) {
        $params = [
            'index' => 'honors',
            'type'  => 'hobbies',
            'id'    => $hobbyId,
            'parent' => $honorId,
            'body'  => [
                'hobby_id' => $hobbyId,
                'hobby' => $hobby
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagHobbyHonor($hobbyId, $honorId, $honor) {
        $params = [
            'index' => 'hobbies',
            'type'  => 'honors',
            'id'    => $honorId,
            'parent' => $hobbyId,
            'body'  => [
                'honor_id' => $honorId,
                'honor' => $honor
            ]
        ];
        
        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagHobbySpecialty($hobbyId, $specialtyId, $specialty) {
        $params = [
            'index' => 'hobbies',
            'type'  => 'specialties',
            'id'    => $specialtyId,
            'parent' => $hobbyId,
            'body'  => [
                'specialty_id' => $specialtyId,
                'specialty' => $specialty
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagTrainingCertSpecialty($trainingCertId, $specialtyId, $specialty) {
        $params = [
            'index' => 'training_certificates',
            'type'  => 'specialties',
            'id'    => $specialtyId,
            'parent' => $trainingCertId,
            'body'  => [
                'specialty_id' => $specialtyId,
                'specialty' => $specialty
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagTrainingCertIndustries($trainingCertId, $industryId, $industry) {
        $params = [
            'index' => 'training_certificates',
            'type'  => 'industries',
            'id'    => $industryId,
            'parent' => $trainingCertId,
            'body'  => [
                'industry_id' => $industryId,
                'industry' => $industry
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagTrainingCertJob($trainingCertId, $jobId, $job) {
        $params = [
            'index' => 'training_certificates',
            'type'  => 'jobs',
            'id'    => $jobId,
            'parent' => $trainingCertId,
            'body'  => [
                'job_id' => $jobId,
                'job' => $job
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSpecialtyTrainingCert($specialtyId, $trainingCertId, $trainingCert) {
        $params = [
            'index' => 'specialties',
            'type'  => 'training_certificates',
            'id'    => $trainingCertId,
            'parent' => $specialtyId,
            'body'  => [
                'training_certificate_id' => $trainingCertId,
                'training_certificate' => $trainingCert
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagIndustryTrainingCert($industryId, $trainingCertId, $trainingCert) {
        $params = [
            'index' => 'industries',
            'type'  => 'training_certificates',
            'id'    => $trainingCertId,
            'parent' => $industryId,
            'body'  => [
                'training_certificate_id' => $trainingCertId,
                'training_certificate' => $trainingCert
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagJobTrainingCert($jobId, $trainingCertId, $trainingCert) {
        $params = [
            'index' => 'jobs',
            'type'  => 'training_certificates',
            'id'    => $trainingCertId,
            'parent' => $jobId,
            'body'  => [
                'training_certificate_id' => $trainingCertId,
                'training_certificate' => $trainingCert
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSpecialtyIndustry($specialtyId, $industryId, $industry) {
        $params = [
            'index' => 'specialties',
            'type'  => 'industries',
            'id'    => $industryId,
            'parent' => $specialtyId,
            'body'  => [
                'industry_id' => $industryId,
                'industry' => $industry
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSpecialtyJobs($specialtyId, $jobId, $job) {
        $params = [
            'index' => 'specialties',
            'type'  => 'jobs',
            'id'    => $jobId,
            'parent' => $specialtyId,
            'body'  => [
                'job_id' => $jobId,
                'job' => $job
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagIndustrySpecialties($industryId, $specialtyId, $specialty) {
        $params = [
            'index' => 'industries',
            'type'  => 'specialties',
            'id'    => $specialtyId,
            'parent' => $industryId,
            'body'  => [
                'specialty_id' => $specialtyId,
                'specialty' => $specialty
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagIndustryJobs($industryId, $jobId, $job) {
        $params = [
            'index' => 'industries',
            'type'  => 'jobs',
            'id'    => $jobId,
            'parent' => $industryId,
            'body'  => [
                'job_id' => $jobId,
                'job' => $job
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagJobsSpecialty($jobId, $specialtyId, $specialty) {
        $params = [
            'index' => 'jobs',
            'type'  => 'specialties',
            'id'    => $specialtyId,
            'parent' => $jobId,
            'body'  => [
                'specialty_id' => $specialtyId,
                'specialty' => $specialty
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagJobsIndustries($jobId, $industryId, $industry) {
        $params = [
            'index' => 'jobs',
            'type'  => 'industries',
            'id'    => $industryId,
            'parent' => $jobId,
            'body'  => [
                'industry_id' => $industryId,
                'industry' => $industry
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagJobsSkills($jobId, $skillsId, $skill) {
        $params = [
            'index' => 'jobs',
            'type'  => 'skills',
            'id'    => $skillsId,
            'parent' => $jobId,
            'body'  => [
                'skill_id' => $skillsId,
                'skill' => $skill
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagJobsCourses($jobId, $courseId, $course) {
        $params = [
            'index' => 'jobs',
            'type'  => 'courses',
            'id'    => $courseId,
            'parent' => $jobId,
            'body'  => [
                'course_id' => $courseId,
                'course' => $course
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagJobsInterests($jobId, $interestId, $interest) {
        $params = [
            'index' => 'jobs',
            'type'  => 'interests',
            'id'    => $interestId,
            'parent' => $jobId,
            'body'  => [
                'interest_id' => $interestId,
                'interest' => $interest
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagJobsPositions($jobId, $positionId, $position) {
        $params = [
            'index' => 'jobs',
            'type'  => 'position',
            'id'    => $positionId,
            'parent' => $jobId,
            'body'  => [
                'position_id' => $positionId,
                'position' => $position
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSpecialtySkills($specialtyId, $skillId, $skill) {
        $params = [
            'index' => 'specialties',
            'type'  => 'skills',
            'id'    => $skillId,
            'parent' => $specialtyId,
            'body'  => [
                'skill_id' => $skillId,
                'skill' => $skill
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSpecialtyCourses($specialtyId, $courseId, $course) {
        $params = [
            'index' => 'specialties',
            'type'  => 'courses',
            'id'    => $courseId,
            'parent' => $specialtyId,
            'body'  => [
                'course_id' => $courseId,
                'course' => $course
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSpecialtyInterests($specialtyId, $interestId, $interest) {
        $params = [
            'index' => 'specialties',
            'type'  => 'interests',
            'id'    => $interestId,
            'parent' => $specialtyId,
            'body'  => [
                'interest_id' => $interestId,
                'interest' => $interest
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSpecialtyPosition($specialtyId, $positionId, $position) {
        $params = [
            'index' => 'specialties',
            'type'  => 'position',
            'id'    => $positionId,
            'parent' => $specialtyId,
            'body'  => [
                'position_id' => $positionId,
                'position' => $position
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagIndustrySkills($industryId, $skillId, $skill) {
        $params = [
            'index' => 'industries',
            'type'  => 'skills',
            'id'    => $skillId,
            'parent' => $industryId,
            'body'  => [
                'skill_id' => $skillId,
                'skill' => $skill
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagIndustryCourses($industryId, $courseId, $course) {
        $params = [
            'index' => 'industries',
            'type'  => 'courses',
            'id'    => $skillId,
            'parent' => $courseId,
            'body'  => [
                'course_id' => $courseId,
                'course' => $course
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagIndustryInterest($industryId, $interestId, $interest) {
        $params = [
            'index' => 'industries',
            'type'  => 'interests',
            'id'    => $interestId,
            'parent' => $industryId,
            'body'  => [
                'interest_id' => $interestId,
                'interest' => $interest
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagIndustryPositions($industryId, $positionId, $position) {
        $params = [
            'index' => 'industries',
            'type'  => 'positions',
            'id'    => $positionId,
            'parent' => $industryId,
            'body'  => [
                'position_id' => $positionId,
                'position' => $position
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSkillsJobs($skillsId, $jobId, $job) {
        $params = [
            'index' => 'skills',
            'type'  => 'jobs',
            'id'    => $jobId,
            'parent' => $skillsId,
            'body'  => [
                'job_id' => $jobId,
                'job' => $job
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSkillsSpecialties($skillsId, $specialtyId, $specialty) {
        $params = [
            'index' => 'skills',
            'type'  => 'specialties',
            'id'    => $specialtyId,
            'parent' => $skillsId,
            'body'  => [
                'specialty_id' => $specialtyId,
                'specialty' => $specialty
            ]
        ];
        
        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSkillsIndustries($skillsId, $industryId, $industry) {
        $params = [
            'index' => 'skills',
            'type'  => 'industries',
            'id'    => $industryId,
            'parent' => $skillsId,
            'body'  => [
                'industry_id' => $industryId,
                'industry' => $industry
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSkillsCourses($skillsId, $courseId, $course) {
        $params = [
            'index' => 'skills',
            'type'  => 'courses',
            'id'    => $courseId,
            'parent' => $skillsId,
            'body'  => [
                'course_id' => $courseId,
                'course' => $course
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }

    }

    public function tagSkillsInterests($skillsId, $interestId, $interest) {
        $params = [
            'index' => 'skills',
            'type'  => 'interests',
            'id'    => $interestId,
            'parent' => $skillsId,
            'body'  => [
                'interest_id' => $interestId,
                'interest' => $interest
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }

    }

    public function tagSkillsPositions($skillsId, $positionId, $position) {
        $params = [
            'index' => 'skills',
            'type'  => 'positions',
            'id'    => $positionId,
            'parent' => $skillsId,
            'body'  => [
                'position_id' => $positionId,
                'position' => $position
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }

    }

    public function tagCoursesJobs($courseId, $jobId, $job) {
        $params = [
            'index' => 'courses',
            'type'  => 'jobs',
            'id'    => $jobId,
            'parent' => $courseId,
            'body'  => [
                'job_id' => $jobId,
                'job' => $job
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagCoursesSpecialty($courseId, $specialtyId, $specialty) {
        $params = [
            'index' => 'courses',
            'type'  => 'specialties',
            'id'    => $specialtyId,
            'parent' => $courseId,
            'body'  => [
                'specialty_id' => $specialtyId,
                'specialty' => $specialty
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagCoursesIndustries($courseId, $industryId, $industry) {
        $params = [
            'index' => 'courses',
            'type'  => 'industries',
            'id'    => $industryId,
            'parent' => $courseId,
            'body'  => [
                'industry_id' => $industryId,
                'industry' => $industry
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagCoursesSkills($courseId, $skillId, $skill) {
        $params = [
            'index' => 'courses',
            'type'  => 'skills',
            'id'    => $skillId,
            'parent' => $courseId,
            'body'  => [
                'skill_id' => $skillId,
                'skill' => $skill
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagCoursesInterests($courseId, $interestId, $interest) {
        $params = [
            'index' => 'courses',
            'type'  => 'interests',
            'id'    => $interestId,
            'parent' => $courseId,
            'body'  => [
                'interest_id' => $interestId,
                'interest' => $interest
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagCoursesPosition($courseId, $positionId, $position) {
        $params = [
            'index' => 'courses',
            'type'  => 'positions',
            'id'    => $positionId,
            'parent' => $courseId,
            'body'  => [
                'position_id' => $positionId,
                'position' => $position
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagInterestsJobs($interestId, $jobId, $jobs) {
        $params = [
            'index' => 'interests',
            'type'  => 'jobs',
            'id'    => $jobId,
            'parent' => $interestId,
            'body'  => [
                'job_id' => $jobId,
                'job' => $job
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagInterestsSpecialties($interestId, $specialtyId, $specialty) {
        $params = [
            'index' => 'interests',
            'type'  => 'specialties',
            'id'    => $specialtyId,
            'parent' => $interestId,
            'body'  => [
                'specialty_id' => $specialtyId,
                'specialty' => $specialty
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagInterestsIndustries($interestId, $industryId, $industry) {
        $params = [
            'index' => 'interests',
            'type'  => 'industries',
            'id'    => $industryId,
            'parent' => $interestId,
            'body'  => [
                'industry_id' => $industryId,
                'industry' => $industry
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagInterestsSkills($interestId, $skillId, $skill) {
        $params = [
            'index' => 'interests',
            'type'  => 'skills',
            'id'    => $skillId,
            'parent' => $interestId,
            'body'  => [
                'skill_id' => $skillId,
                'skill' => $skill
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagInterestsCourses($interestId, $courseId, $course) {
        $params = [
            'index' => 'interests',
            'type'  => 'courses',
            'id'    => $courseId,
            'parent' => $interestId,
            'body'  => [
                'course_id' => $courseId,
                'course' => $course
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagInterestsPosition($interestId, $positionId, $position) {
        $params = [
            'index' => 'interests',
            'type'  => 'positions',
            'id'    => $positionId,
            'parent' => $interestId,
            'body'  => [
                'position_id' => $positionId,
                'position' => $position
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagPositionJobs($positionId, $jobId, $job) {
        $params = [
            'index' => 'positions',
            'type'  => 'jobs',
            'id'    => $jobId,
            'parent' => $courseId,
            'body'  => [
                'job_id' => $jobId,
                'job' => $job
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagPositionSpecialty($positionId, $specialtyId, $specialty) {
        $params = [
            'index' => 'positions',
            'type'  => 'jobs',
            'id'    => $jobId,
            'parent' => $positionId,
            'body'  => [
                'job_id' => $jobId,
                'job' => $job
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

     public function tagPositionIndustries($positionId, $industryId, $industry) {
        $params = [
            'index' => 'positions',
            'type'  => 'industries',
            'id'    => $industryId,
            'parent' => $positionId,
            'body'  => [
                'industry_id' => $industryId,
                'industry' => $industry
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagPositionSkills($positionId, $skillId, $skill) {
        $params = [
            'index' => 'positions',
            'type'  => 'skills',
            'id'    => $skillId,
            'parent' => $positionId,
            'body'  => [
                'skill_id' => $skillId,
                'skill' => $skill
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagPositionCourses($positionId, $courseId, $course) {
        $params = [
            'index' => 'positions',
            'type'  => 'courses',
            'id'    => $courseId,
            'parent' => $positionId,
            'body'  => [
                'course_id' => $courseId,
                'course' => $course
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagPositionInterests($positionId, $courseId, $course) {
        $params = [
            'index' => 'positions',
            'type'  => 'courses',
            'id'    => $courseId,
            'parent' => $positionId,
            'body'  => [
                'course_id' => $courseId,
                'course' => $course
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSchoolCountries($schoolId, $countryId, $country) {
        $params = [
            'index' => 'schools',
            'type'  => 'countries',
            'id'    => $countryId,
            'parent' => $schoolId,
            'body'  => [
                'country_id' => $countryId,
                'country' => $country
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagCountriesCourse($countryId, $courseId, $course) {
        $params = [
            'index' => 'countries',
            'type'  => 'courses',
            'id'    => $courseId,
            'parent' => $countryId,
            'body'  => [
                'course_id' => $courseId,
                'course' => $course
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagSchoolCourses($schoolId, $courseId, $course) {
        $params = [
            'index' => 'schools',
            'type'  => 'courses',
            'id'    => $courseId,
            'parent' => $schoolId,
            'body'  => [
                'course_id' => $courseId,
                'course' => $course
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagCountriesSchool($countryId, $schoolId, $school) {
        $params = [
            'index' => 'countries',
            'type'  => 'schools',
            'id'    => $schoolId,
            'parent' => $countryId,
            'body'  => [
                'school_id' => $schoolId,
                'school' => $school
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagCoursesSchool($courseId, $schoolId, $school) {
        $params = [
            'index' => 'courses',
            'type'  => 'schools',
            'id'    => $schoolId,
            'parent' => $courseId,
            'body'  => [
                'school_id' => $schoolId,
                'school' => $school
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function tagCoursesCountries($courseId, $countryId, $country) {
        $params = [
            'index' => 'courses',
            'type'  => 'countries',
            'id'    => $countryId,
            'parent' => $courseId,
            'body'  => [
                'scountry_id' => $countryId,
                'country' => $country
            ]
        ];

        try {
        $response = $this->es->index($params);

        if($response['_shards']['successful'] >= 1) {
            return true;
        } else {
            return false;
        }
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (BadRequest400Exception $e) {
            return false;
        }
    }

    public function getSpecialties ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
            "from": '. $from .',
            "size": 10,
        ';

        $filtering = '';
        
        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }
        

      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
            "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "hobbies"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "honors"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
 
      $params = [
          'index' => 'specialties',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function getHonors ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
          "from": '. $from .',
          "size": 10,
        ';

        $filtering = '';

        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }

      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
            "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "specialties"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "hobbies"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
  
      $params = [
          'index' => 'honors',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function getHobbies ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
          "from": '. $from .',
          "size": 10,
        ';
        $filtering = '';

        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }


      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
            "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "specialties"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "honors"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
  
      $params = [
          'index' => 'hobbies',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function getTrainingCert ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
          "from": '. $from .',
          "size": 10,
        ';

        $filtering = '';

        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }

      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
             "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "specialties"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "industries"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "jobs"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
  
      $params = [
          'index' => 'training_certificates',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function getJobs ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
          "from": '. $from .',
          "size": 10,
        ';

        $filtering = '';

        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }


      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
             "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "skills"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "industries"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
  
      $params = [
          'index' => 'jobs',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function getSkills ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
          "from": '. $from .',
          "size": 10,
        ';

        $filtering = '';

        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }


      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
             "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "jobs"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "industries"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
  
      $params = [
          'index' => 'skills',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function getIndustries ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
          "from": '. $from .',
          "size": 10,
        ';

        $filtering = '';

        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }

      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
             "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "jobs"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "skills"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
  
      $params = [
          'index' => 'industries',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function getCountries ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
          "from": '. $from .',
          "size": 10,
        ';

        $filtering = '';

        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }


      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
             "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "courses"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "schools"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
  
      $params = [
          'index' => 'countries',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function getCourses ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
          "from": '. $from .',
          "size": 10,
        ';

        $filtering = '';

        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }


      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
             "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "countries"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "schools"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
  
      $params = [
          'index' => 'courses',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function getSchools ($from, $filter) {

      $from = (empty($from)) ? 0 : ($from * 10) - 10;

 
        $limit = '
          "from": '. $from .',
          "size": 10,
        ';

        $filtering = '';

        if($filter != 2) {
            $filtering = '
            {
                "match": {
                    "is_approved": "'. $filter .'"
                }
            },
        ';
        }


      $json = '
        {
            "sort": [
                {
                "date_created": {
                    "order": "desc"
                }
                }
            ],
            '. $limit .'
             "query": {
                "bool": {
                "must": [
                    {
                    "match": {
                        "is_deleted": "0"
                    }
                    },
                    '. $filtering .'
                    {
                    "bool": {
                        "should": [
                        {
                            "match": {
                            "is_deleted": "0"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "countries"
                            }
                        },
                        {
                            "has_child": {
                            "inner_hits": {},
                            "query": {
                                "match_all": {}
                            },
                            "score_mode": "max",
                            "type": "courses"
                            }
                        }
                        ]
                    }
                    }
                ]
                }
            }
        }    
      ';
  
      $params = [
          'index' => 'schools',
          'type' => 'info',
          'body' => $json
      ];

      $result = $this->es->search($params);

      if(empty($result['hits']['total'])) {
        return false;
      }

      $arr = array();

      $arr['total']   = $result['hits']['total'];
      $arr['result']  = $result['hits']['hits'];

      return $arr;
    }

    public function changeStatus($id, $key, $approved, $userId, $keyword, $createdUser) {
        try {
            $sql = "";

            if($approved == 1) {
                $sql = "
                    INSERT INTO data_tool_approve 
                        (category_id, category, approved_by_user_id, date_created, keyword, created_user_id)
                    VALUES 
                        ('$id', '$key', '$userId', now(), '$keyword', '$createdUser')
                    ON DUPLICATE KEY
                        UPDATE keyword='$keyword', category='$key', approved_by_user_id='$userId', date_updated=now(), created_user_id='$createdUser';
                ";
            } else {
                $sql = "
                    DELETE FROM
                        data_tool_approve
                    WHERE
                        category_id = '$id' AND
                        category = '$key'
                ";
            }

            $statement = $this->db->prepare($sql);

            if (!$statement->execute()) {
                return false;
            }

                    
            $params = [
                'index' => $key,
                'type'  => 'info',
                'id'    => $id,
                'body'  => [
                    'doc' => [
                    'is_approved' => $approved,
                    'approved_by_user_id' => $userId,
                    'date_updated' => $this->now,
                    'updated_by_user_id' => $userId
                    ]
                ]
            ];

            try {
                $response = $this->es->update($params);

            if($response['_shards']['successful'] >= 1) {
                return true;
            } else {
                return false;
            }
            } catch (InvalidArgumentException $e) {
                return false;
            } catch (BadRequest400Exception $e) {
                return false;
            }

        } catch (PDOException $e) {
            return $e;
        }
    }
}
