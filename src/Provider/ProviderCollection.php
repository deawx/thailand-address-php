<?php namespace Farzai\ThailandAddress\Provider;

use Farzai\ThailandAddress\Support\Collection;

/**
 * Class ProviderCollection
 * @package Farzai\ThailandAddress\Provider
 */
abstract class ProviderCollection extends Collection {

    /**
     * @return array
     */
    abstract public function data();

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * ProviderCollection constructor.
     * @param null $data
     */
    public function __construct($data = null)
    {
        parent::__construct(is_null($data) ? $this->data() : $data);
    }

    /**
     * @param $id
     * @return $this
     */
    public function find($id)
    {
        return new static($this->where($this->primaryKey, $id)->first());
    }

    /**
     * @param callable $callback
     */
    public function each(callable $callback)
    {
        foreach ($this->getItems() as $key => $value) {
            $callbackResult = $callback(new static($value), $key);

            if ($callbackResult === false) {
                break;
            }
        }
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * @param $provider
     * @param string $foreignKey
     * @return ProviderCollection
     */
    protected function hasMany($provider, $foreignKey = null)
    {
        if ($this->itemIsObject()) {
            $this->setItems([
                $this->getItems()
            ]);
        }

        $provider = new $provider();

        if (is_null($foreignKey)) {
            $foreignKey = strtolower($this->getClassName($this)) . '_id';
        }

        return $provider->where($foreignKey, $this->first()[$this->getPrimaryKey()]);
    }


    /**
     * @param $provider
     * @param $localForeignKey
     * @return array
     */
    protected function belongsTo($provider, $localForeignKey = null)
    {
        if ($this->itemIsObject()) {
            $this->setItems([$this->getItems()]);
        }

        $provider = new $provider();

        if (is_null($localForeignKey)) {
            $localForeignKey = strtolower($this->getClassName($provider)) . '_id';
        }

        return $provider->where(
            $provider->getPrimaryKey(),
            $this->first()[$localForeignKey]
        )->first();
    }

    /**
     * @param $object
     * @return false|string
     */
    protected function getClassName($object)
    {
        $className = get_class($object);

        return (substr($className, strrpos($className, '\\') + 1));
    }


    /**
     * @param string $filename
     * @return array
     */
    protected function loadFromFile($filename)
    {
        return json_decode(file_get_contents(__DIR__.'/../../data/'.$filename), true);
    }

    /**
     * @return bool
     */
    private function itemIsObject()
    {
        return isset($this->getItems()[$this->getPrimaryKey()]);
    }

}