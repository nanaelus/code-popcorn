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

        $data = [
            [
                'zip_code' => '17290',
                'label' => 'Le Thou',
                'department_name' => 'ain',
                'department_number' => 1,
                "region_name" => "PARIS"
            ],
            [
                'zip_code' => '172290',
                'label' => 'Mandala',
                'department_name' => 'ai2n',
                'department_number' => 1,
                "region_name" => "PAR2IS"
            ]
        ];
        $this->db->table('city')->insertBatch($data);

        //re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function testGetAllCities() {
        $model = new CityModel();

        $cities = $model->getAllCities();
        $this->assertCount(2, $cities);
    }

    public function testGetCityById() {
        $model = new CityModel();

        $city = $model->getCityById(1);

        $this->assertEquals('17290', $city['zip_code']);
    }

    public function testSearchCitiesByName() {
        $model = new CityModel();

        $city = $model->searchCitiesByName('Le Thou');
        $this->assertCount(1, $city);

        $city = $model->searchCitiesByName('Mandala');
        $this->assertCount(1, $city);

        $city = $model->searchCitiesByName('Wazzaaaaaah');
        $this->assertCount(0, $city);
    }
}