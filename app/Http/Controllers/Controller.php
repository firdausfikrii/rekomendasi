<?php

namespace App\Http\Controllers;

abstract class Controller
{
    private function combination($n, $r)
    {
        return
            gmp_fact($n)
            /
            (
                gmp_fact($r)
                *
                gmp_fact($n - $r)
            );
    }
}
