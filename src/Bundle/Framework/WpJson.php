<?php

namespace App\Bundle\Framework;

use App\Bundle\RegisterInterface;
use App\Controller\MonumentsContoller;

/*
Class to register WPJson
*/

class WpJson implements RegisterInterface
{
    public function register(): void
    {  
       $monuments = new MonumentsContoller('https://2cw.pl/recrutation/francja21_wpdev.txt');
    }
}
