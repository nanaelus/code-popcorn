<?php

namespace App\Models;

use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Config\Services;
use CodeIgniter\Database\ConnectionInterface;

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

        $data1 = ['name' => 'permitest', 'slug' => 'permitest'];
        $data2 = ['name' => 'permitest', 'slug' => 'permitest-1'];

        $result1 = $model->createPermission($data1);
        $result2 = $model->createPermission($data2);

        $this->assertTrue($result1 > 0);
        $this->assertTrue($result2 > 0);

        $this->seeInDatabase('user_permission', ['name'=>'permitest', 'slug' => 'permitest']);
        $this->seeInDatabase('user_permission', ['name'=>'permitest', 'slug' => 'permitest-1']);
    }

    public function testUpdatePermission() {
        $model = new UserPermissionModel();

        $data = ['name' => 'permitest'];
        $model->createPermission($data);

        $updatedData = ['name' => 'permitest2'];

        $permission = $model->getUserPermissionById(1);
        $model->updatePermission($permission['id'], $updatedData);
        $this->seeInDatabase('user_permission', ['name' => 'permitest2']);
    }

    public function testDeletePermission() {
        $model = new UserPermissionModel();
        $data = ['name' => 'permitest2'];
        $model->createPermission($data);

        // Récupérer la permission que nous venons de créer
        $permission = $model->getUserPermissionById(1);
        $this->assertNotNull($permission); // Vérifiez que la permission existe avant suppression

        // Supprimer la permission
        $model->deletePermission(1);

        // Vérifiez que la permission n'existe plus dans la base de données
        $this->assertNull($model->getUserPermissionById(1)); // La permission doit être supprimée
    }

    public function testGetAllPermissions() {
        $model = new UserPermissionModel();
        $data1 = ['name' => 'permitest'];
        $data2 = ['name' => 'permitest2'];

        $model->createPermission($data1);
        $model->createPermission($data2);

        $result = $model->getAllPermissions();
        $this->assertCount(2, $result);
    }

    public function testGetUserPermissionById() {
        $model = new UserPermissionModel();
        $data = ['name' => 'permitest'];
        $model->createPermission($data);

        $permission = $model->getUserPermissionById(1);
        $this->assertNotNull($permission);
        $this->seeInDatabase('user_permission', ['name'=>'permitest']);
    }
}
