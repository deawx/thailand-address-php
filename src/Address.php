<?php namespace Farzai\ThailandAddress;

use Farzai\ThailandAddress\Provider\District;
use Farzai\ThailandAddress\Provider\SubDistrict;
use Farzai\ThailandAddress\Provider\Geography;
use Farzai\ThailandAddress\Provider\Province;

class Address {


    /**
     * @return Geography
     */
    public static function geography()
    {
        return new Geography();
    }

    /**
     * @return Province
     */
    public static function province()
    {
        return new Province();
    }

    /**
     * @return District
     */
    public static function district()
    {
        return new District();
    }

    /**
     * @return SubDistrict
     */
    public static function subDistrict()
    {
        return new SubDistrict();
    }
}

