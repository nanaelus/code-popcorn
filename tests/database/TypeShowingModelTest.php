<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\TypeShowingModel;

class TypeShowingModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;
    //protected $seed = 'App\Database\Seeds\DatabaseSeeder';

    protected function setUp(): void
    {// se déclanchera avant chaque fonction de test unitaire

        parent::setUp();
        //Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncate the table before each test
        $this->db->table('type_showing')->truncate();

        //re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        //Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncature des tables
        $this->db->table('type_showing')->truncate();

        // Réactiver la vérification des clés etrangeres
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function testGetAllTypeShowing(){
        $model = new TypeShowingModel();
        $data = [
            ['name'=> 'Régulière'],
            ['name'=> 'Avant-première']
        ];
        $model->insertBatch($data);

        $results = $model->getAllTypeShowing();
        $this->assertIsArray($results);
        $this->assertCount(2, $results);
    }
}