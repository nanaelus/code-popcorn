<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\UserModel;

class UserModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;
    protected $seed = 'App\Database\Seeds\DatabaseSeeder';

    protected function setUp(): void
    {// se déclanchera avant chaque fonction de test unitaire

        parent::setUp();
        //Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncate the table before each test
        $this->db->table('user')->truncate();

        //re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
    protected function tearDown(): void
    {
        parent::tearDown();
        //Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncature des tables
        $this->db->table('user')->truncate();
        $this->db->table('showing')->truncate();

        // Réactiver la vérification des clés etrangeres
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
    public function testCreateUser()
    {
        $model = new UserModel();
        $data = [
            'username'=>'testuser',
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $result = $model->createUser($data);
        $this->assertTrue($result>0); // Vérifie que l'ID de l'utilisateur créé est superieur à 0

        // Vérifie que l'utilisdateur a bien été crée dans la base de donnée
        $this->seeInDatabase('user', ['email'=>'testuser@example.com']);
    }

}
