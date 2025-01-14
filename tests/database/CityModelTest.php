<?php

namespace database;

use App\Models\CityModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\UserModel;

class CityModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;
    protected function setUp(): void
    {// se déclanchera avant chaque fonction de test unitaire

        parent::setUp();
        //Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncate the table before each test
        $this->db->table('city')->truncate();

        //re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function testGetAllCities() {
        $model = new CityModel();
        $data = ['zip_code' => '17290', 'label' => 'Le Thou', 'department_name' => 'ain', 'department_number' => 1, "region_name" => "PARIS"];
        $data2 = ['zip_code' => '172290', 'label' => 'Le T2hou', 'department_name' => 'ai2n', 'department_number' => 1, "region_name" => "PAR2IS"];

        $model->insert($data);
        $model->insert($data2);

        $cities = $model->getAllCities();
        $this->assertCount(2, $cities);
    }

    public function testGetCityById() {
        $model = new CityModel();
        $data = ['zip_code' => '17290', 'label' => 'Le Thou', 'department_name' => 'ain', 'department_number' => 1, "region_name" => "PARIS"];

        $model->insert($data);
        $city = $model->getCityById(1);

        $this->assertEquals('17290', $city['zip_code']);
    }
}