<?php namespace Farzai\ThailandAddress\Provider;


class Province extends ProviderCollection
{
    /**
     * @return array
     */
    public function geography()
    {
        return $this->belongsTo(Geography::class);
    }

    /**
     * @return District|ProviderCollection
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }

    /**
     * @return array
     */
    public function data()
    {
        return $this->loadFromFile('provinces.json');
    }
}
