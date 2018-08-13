<?php
namespace App\Controllers;

use App\Models\Booking;

use App\Helpers\CommonFunction;
use App\Helpers\PasswordHash;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use Respect\Validation\Validator as v;

/**
 * Class BookingController
 * @package App\Controllers
 */

class BookingController
{
    protected $booking;
    protected $commonFunction;
    protected $passwordHash;

    public function __construct(Booking $booking, CommonFunction $commonFunction, PasswordHash $passwordHash)
    {
        $this->booking             = $booking;
        $this->commonFunction   = $commonFunction;
        $this->passwordHash     = $passwordHash;
    }

    /**
     * @param $request
     * @param $response
     * @return $response
     */
    public function getBookingTime($request, $response, $args) {

        $result = $this->booking->getBookingTime();

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
