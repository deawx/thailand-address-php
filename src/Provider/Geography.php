<?php namespace Farzai\ThailandAddress\Provider;


class Geography extends ProviderCollection  {


    /**
     * @return Province|ProviderCollection
     */
    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

    /**
     * @return array
     */
    public function data()
    {
        return $this->loadFromFile('geographies.json');
    }
}