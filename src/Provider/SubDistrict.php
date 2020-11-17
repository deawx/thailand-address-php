<?php namespace Farzai\ThailandAddress\Provider;


class SubDistrict extends ProviderCollection {


    /**
     * @return array
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * @return array
     */
    public function data()
    {
        return $this->loadFromFile('sub_districts.json');
    }
}