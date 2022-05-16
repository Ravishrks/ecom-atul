<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class SearchController extends Controller {

    public function index() {
        $product = $this->post('get-products', ['data' => ['get_all_products_name' => '1']]);
        echo \GuzzleHttp\json_encode( $product['data']);

    }

}
