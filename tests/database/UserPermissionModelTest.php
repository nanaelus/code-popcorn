<?php

namespace App\Models;

use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Config\Services;
use CodeIgniter\Database\ConnectionInterface;
use function PHPUnit\Framework\assertEquals;

class UserPermissionModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;

    protected function setUp(): void
    {// se déclanchera avant chaque fonction de test unitaire

        parent::setUp();
        //Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncate the table before each test
        $this->db->table('user_permission')->truncate();

        $data = [
            [
                'id' => 1,
                'name' => 'permitest',
                'slug' => 'permitest',
            ],
            [
                'id' => 2,
                'name' => 'permitest2',
                'slug' => 'permitest2',
            ],
            [
                'id' => 3,
                'name' => 'permitest3',
                'slug' => 'permitest3',
            ]
        ];
        $this->db->table('user_permission')->insertBatch($data);

        //re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        //Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncature des tables
        $this->db->table('user_permission')->truncate();
        $this->db->table('user')->truncate();
    }

    public function testCreatePermission() {
        $model = new UserPermissionModel();

        $data1 = ['name' => 'permitest666', 'slug' => 'permitest666'];
        $data2 = ['name' => 'permitest666', 'slug' => 'permitest666-1'];

        $result1 = $model->createPermission($data1);
        $result2 = $model->createPermission($data2);

        $this->assertTrue($result1 > 0);
        $this->assertTrue($result2 > 0);

        $this->seeInDatabase('user_permission', ['name'=>'permitest666', 'slug' => 'permitest666']);
        $this->seeInDatabase('user_permission', ['name'=>'permitest666', 'slug' => 'permitest666-1']);
    }

    public function testUpdatePermission() {
        $model = new UserPermissionModel();

        $updatedData = ['name' => 'permitest42'];

        $permission = $model->getUserPermissionById(1);
        $model->updatePermission($permission['id'], $updatedData);
        $this->seeInDatabase('user_permission', ['name' => 'permitest42']);
    }

    public function testDeletePermission() {
        $model = new UserPermissionModel();

        $permission = $model->getUserPermissionById(1);
        $this->assertNotNull($permission); // Vérifiez que la permission existe avant suppression

        // Supprimer la permission
        $model->deletePermission(1);

        // Vérifiez que la permission n'existe plus dans la base de données
        $this->assertNull($model->getUserPermissionById(1)); // La permission doit être supprimée
    }

    public function testGetAllPermissions() {
        $model = new UserPermissionModel();

        $result = $model->getAllPermissions();
        $this->assertCount(3, $result);
    }

    public function testGetUserPermissionById() {
        $model = new UserPermissionModel();

        $permission = $model->getUserPermissionById(1);
        $this->assertNotNull($permission);
        $this->seeInDatabase('user_permission', ['name'=>'permitest']);
    }

    public function testGetTotalPermission() {
        $model = new UserPermissionModel();

        $result = $model->getTotalPermission();
        $this->assertEquals(3, $result);
    }

    public function testGetFilteredPermission(){
        $model = new UserPermissionModel();

        $result = $model->getFilteredPermission('permitest');
        $this->assertEquals(3, $result);

        $result = $model->getFilteredPermission('test3');
        $this->assertEquals(1, $result);
    }

    public function testGetPaginatedPermission() {
        $model = new UserPermissionModel();

        $result = $model->getPaginatedPermission(0,3, '', 'name', 'ASC');
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }
}
