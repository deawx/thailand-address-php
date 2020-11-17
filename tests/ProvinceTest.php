<?php

use PHPUnit\Framework\TestCase;
use Farzai\ThailandAddress\Address;


class ProvinceTest extends TestCase {


    public function testAllProvince()
    {
        $provinces = Address::province();

        $this->assertCount(77, $provinces->toArray());
    }

    public function testFindProvince()
    {
        $id = 29;
        $shouldSee = 'Udon Thani';
        $geography = 'ภาคตะวันออกเฉียงเหนือ';
        $totalAmphure = 25;

        $amphurMueangUdonthaniId = 421;
        $totalDistrictAmphureMuengUdonthani = 29;

        $province = Address::province()->find($id);

        $this->assertEquals($shouldSee, $province['name_en']);

        $this->assertEquals($geography, $province->geography()['name']);

        $this->assertEquals($totalAmphure, $province->districts()->count());

        $this->assertEquals(
            $totalDistrictAmphureMuengUdonthani,
            $province->districts()->find($amphurMueangUdonthaniId)->subDistricts()->count()
        );
    }

}