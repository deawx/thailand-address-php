# ฐานข้อมูลจังหวัดในประเทศไทย(PHP)

ฐานข้อมูลนี้ถูกดัดแปลงมาจาก https://github.com/parsilver/thailand-provinces โดยการเอาข้อมูลทั้งหมดมาเป็น PHP แล้วรวบให้เป็น ORM เพื่อที่จะสามารถใช้งานได้ง่ายยิ่งขึ้น


## การติดตั้ง

```sh
composer require farzai/thailand-provinces-php
```

## เริ่มต้นการใช้งาน

ยกตัวอย่างเช่น หากท่านต้องการดึงจังหวัดทั้งหมด ให้เรียกใช้งานแค่ `Factory::province()`

```php
<?php
use Farzai\ThailandAddress\Address;

$provinces = Address::province(); // Farzai\ThailandAddress\Provider\ProviderCollection
echo $provinces; // Json
```

หากต้องการแปลงเป็น `Array` ก็สามารถทำได้ดังนี้
```php
<?php
$provinceArray = $provinces->toArray();
```

นอกจากนั้น หากต้องการค้นหาว่าจังหวัดนั้นๆมีอำเภอใดบ้าง
```php
<?php
$districts = $provinces->find(1)->districts(); // Farzai\ThailandAddress\Provider\ProviderCollection
echo $districts; // Json
```


## API

#### Farzai\ThailandAddress\Factory
```php
<?php
use Farzai\ThailandAddress\Address;

/**
* ภูมิภาค
* @return Farzai\ThailandAddress\Provider\Geography|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$geography  = Address::geography();

/**
* จังหวัด
* @return Farzai\ThailandAddress\Provider\Province|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$provinces  = Address::province();

/**
* อำเภอ
* @return Farzai\ThailandAddress\Provider\District|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$districts   = Address::district();

/**
* ตำบล
* @return Farzai\ThailandAddress\Provider\SubDistrict|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$subDistricts  = Address::subDistrict();
```

#### Farzai\ThailandAddress\Provider\ProviderCollection

```php
<?php
use Farzai\ThailandAddress\Address;

/**
* @return Farzai\ThailandAddress\Provider\ProviderCollection
*/
$provinces = Address::province();

/**
* จำนวน
* @return int
*/
$provinces->count();

/**
* ค้นหาจาก Primary key และ return 1 column
* @return Farzai\ThailandAddress\Provider\ProviderCollection
*/
$provinces->find($id);

/**
* ค้นหา
* @return Farzai\ThailandAddress\Provider\ProviderCollection
*/
$provinces->where($key, $value);

/**
* Foreach
*@return Void
*/
$provinces->each(function($value, $key) {
    // หาต้องการหยุด ให้ return false
});

/**
* ค้นหาด้วยตัวเอง
* @return Farzai\ThailandAddress\Provider\ProviderCollection
*/
$provinces->filter(function($value, $key) {
    return true; // Return true หากค้นพบ
});

/**
* @return array
*/
$provinces->toArray();

/**
* Get primary key
* @return string
*/
$provinces->getPrimaryKey();
```

#### `Farzai\ThailandAddress\Provider\Geography`

```php
<?php
use Farzai\ThailandAddress\Address;

$geography = Address::geography();

/**
* จังหวัดของภูมิภาคนั้น
* @return Farzai\ThailandAddress\Provider\Province|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$geography->find(1)->provinces();
```

#### `Farzai\ThailandAddress\Provider\Province`

```php
<?php
use Farzai\ThailandAddress\Address;

$province = Address::province();

/**
* ภูมิภาคของจังหวัดนั้น
* @return Farzai\ThailandAddress\Provider\Geography|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$province->find(1)->geography();

/**
* อำเภอทั้งหมดคของจังหวัดนั้น
* @return Farzai\ThailandAddress\Provider\District|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$province->find(1)->districts();
```

#### `Farzai\ThailandAddress\Provider\Amphure`

```php
<?php
use Farzai\ThailandAddress\Address;

$district = Address::district();

/**
* จังหวัดคของอำเภอนั้น
* @return Farzai\ThailandAddress\Provider\Province|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$district->find(1)->province();

/**
* ตำบลทั้งหมดของอำเภอนั้น
* @return Farzai\ThailandAddress\Provider\SubDistrict|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$district->find(1)->subDistricts();
```

#### `Farzai\ThailandAddress\Provider\District`

```php
<?php
use Farzai\ThailandAddress\Address;

$subDistrict = Address::subDistrict();

/**
* อำเภอของตำบลนั้น
* @return Farzai\ThailandAddress\Provider\District|Farzai\ThailandAddress\Provider\ProviderCollection
*/
$subDistrict->find(1)->district();
```
