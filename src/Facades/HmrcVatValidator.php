<?php

namespace AmitPatel\HmrcVatValidator\Facades;

use Illuminate\Support\Facades\Facade;

class HmrcVatValidator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'AmitPatel\HmrcVatValidator\HmrcVatValidatorService';
    }
}