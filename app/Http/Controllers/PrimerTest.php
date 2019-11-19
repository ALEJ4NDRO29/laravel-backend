<?php

namespace App\Http\Controllers;

use App\PrimerModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrimerTest extends Controller
{

    function __construct() {}

    public function index()
    {
        $result = PrimerModel::getList();
        return response($result);
    }

    public function getById($id)
    {
        $result = PrimerModel::getById($id);
        return response($result);
    }

}
