<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Showing extends BaseController
{
    public function getindex($value = null)
    {
        if($value == "reserver") {
            $prices = model('PriceModel')->getAllPrices();
            return $this->view('reservation', ['prices' => $prices]);
        }
    }

    public function postreserver(){
        echo "coucou";
    }
}
