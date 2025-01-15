<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\CategoryModel;

class CategoryModelTest extends CIUnitTestCase
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
        $this->db->table('category')->truncate();

        //Création de fausses catégories
        $data = [
            [
                'id' => 1,
                'name' => 'test category',
                'slug' => 'test-category',
            ],
            [
                'id' => 2,
                'name' => 'test patinage artistique',
                'slug' => 'test-patinage-artique',
            ],
            [
                'id' => 3,
                'name' => 'test anti culture',
                'slug' => 'test-anti-culture',
            ]
        ];
        $this->db->table('category')->insertBatch($data);


        //re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
    protected function tearDown(): void
    {
        parent::tearDown();
        //Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncature des tables
        $this->db->table('category')->truncate();

        // Réactiver la vérification des clés etrangeres
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function testCreateCategory(){
        $model = new CategoryModel();

        $data = [
            'id' => 1,
            'name' => 'test category'
        ];

        $result = $model->createCategory($data);
        $this->assertTrue($result > 0 );
        $this->seeInDatabase('category', $data);
    }

    public function testUpdateCategory(){
        $model = new CategoryModel();

        $updatedData = ['name' => 'test patin a glace'];

        $model->updateCategory(1, $updatedData);
        $this->seeInDatabase('category', ['name' => 'test patin a glace']);
        $this->dontSeeInDatabase('category', ['name' => 'test category']);
    }

    public function testDeleteCategory(){
        $model = new CategoryModel();

        $model->deleteCategory(1);
        $this->dontSeeInDatabase('category', ['name' => 'test category']);
        $this->seeInDatabase('category', ['name' => 'test patinage artistique']);
    }

    public function testGetAllCategories(){
        $model = new CategoryModel();
        $result = $model->getAllCategories();
        $this->assertCount(3, $result);
    }

    public function testGetCategoryById() {
        $model = new CategoryModel();
        $result = $model->getCategoryById(1);
        $this->assertEquals('test category', $result['name']);
    }

    public function testGetPaginated(){
        $model = new CategoryModel();

        $result = $model->getPaginated(0, 3, '', 'name', 'ASC');
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    public function testGetTotal() {
        $model = new CategoryModel();
        $result = $model->getTotal();
        $this->assertEquals(3, $result);
    }

    public function testGetFiltered() {
        $model = new CategoryModel();

        $filter = $model->getFiltered('test category');
        $this->assertEquals(1, $filter);

        $filter = $model->getFiltered('test-patinage-artique');
        $this->assertEquals(1, $filter);

        $filter = $model->getFiltered('test');
        $this->assertEquals(3, $filter);
    }
}