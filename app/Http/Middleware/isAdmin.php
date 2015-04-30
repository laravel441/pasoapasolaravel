<?php
/**
 * Created by PhpStorm.
 * User: william.uricoechea
 * Date: 30/04/2015
 * Time: 10:38 AM
 */

namespace App\Http\Middleware;
class IsAdmin extends IsType {
    public function getType()
    {
        return 'admin';
    }
}