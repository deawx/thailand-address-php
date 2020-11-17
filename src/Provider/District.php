<?php namespace Farzai\ThailandAddress\Provider;


class District extends ProviderCollection{


    /**
     * @return array
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }


    /**
     * @return SubDistrict|ProviderCollection
     */
    public function subDistricts()
    {
        return $this->hasMany(SubDistrict::class);
    }

    /**
     * @return array
     */
    public function data()
    {
        return $this->loadFromFile('districts.json');
    }

}