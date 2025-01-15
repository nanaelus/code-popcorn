<?php

namespace database;

use App\Models\UserPermissionModel;
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
        $this->db->table('user_permission')->truncate();

        // Réactiver la vérification des clés etrangeres
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
    public function testCreateUser()
    {
        $model = new UserModel();
        $data = [
            'username'=>'testuser',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $result = $model->createUser($data);
        $this->assertTrue($result>0); // Vérifie que l'ID de l'utilisateur créé est superieur à 0

        // Vérifie que l'utilisdateur a bien été crée dans la base de donnée
        $this->seeInDatabase('user', ['email'=>'testuser@example.com']);
    }

    public function testUpdateUser()
    {
        $model = new UserModel();
        $data = [
            'username'=>'testuser',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $model->createUser($data); // Crée l'utilisateur pour le test

        $updatedData = [
            'username' => 'updateduser',
            'password' => 'newpassword123', // Mettre à jour le mot de passe
        ];

        $user = $model->getUserById(1); // Récupère l'utilisateur créé
        $model->updateUser($user['id'], $updatedData); // Met à jour l'utilisateur

        // Vérifie que le nom d'utilisateur a été mis à jour
        $this->seeInDatabase('user', ['username' => 'updateduser']);
        // Vérifie que le mot de passe a été haché (donc différent de 'newpassword123')
        $this->assertNotEquals('newpassword123', $model->getUserById(1)['password']);
    }

    public function testDeleteUser()
    {
        $model = new UserModel();
        $data = [
            'username'=>'testuser',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $model->createUser($data); // Crée l'utilisateur pour le test

        $user = $model->getUserById(1);
        $model->deleteUser($user['id']);

        // Vérifiez si la colonne `deleted_at` est non-nulle après la suppression, si vous utilisez le soft delete
        $this->seeInDatabase('user', ['id' => $user['id'], 'deleted_at !=' => null]);

    }

    public function testVerifyLogin()
    {
        $model = new UserModel();
        $data = [
            'username'=>'testuser',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $model->createUser($data); // Crée l'utilisateur pour le test

        // Test de la connexion avec des informations valides
        $user = $model->verifyLogin('testuser@example.com', 'password123');
        $this->assertNotFalse($user); // Vérifie que l'utilisateur a été retourné

        // Test de la connexion avec des informations invalides
        $user = $model->verifyLogin('testuser@example.com', 'wrongpassword');
        $this->assertFalse($user); // Vérifie que false est retourné
    }

    public function testGetAllUsers()
    {
        $model = new UserModel();
        $data1 = [
            'username'=>'testuser1',
            'firstname'=>'testuser1',
            'lastname'=>'testuser1',
            'phone'=>'+666666656',
            'dob'=> 1998-07-13,
            'email' => 'testuser1@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $data2 = [
            'username'=>'testuser2',
            'firstname'=>'testuser2',
            'lastname'=>'testuser2',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser2@example.com',
            'password' => 'password456',
            'id_permission'=> 1,
        ];

        $model->createUser($data1);
        $model->createUser($data2);

        $users = $model->getAllUsers();
        $this->assertCount(2, $users); // Vérifie qu'il y a 2 utilisateurs dans la base de données
    }

    public function testGetUserById()
    {
        $model = new UserModel();
        $data = [
            'username'=>'testuser',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $model->createUser($data); // Crée l'utilisateur

        $user = $model->getUserById(1); // Utilisez cet ID au lieu de supposer que c'est 1
        $this->assertEquals('testuser', $user['username']); // Vérification

    }

    public function testCountUserByPermission()
    {
        $model = new UserModel();
        $data1 = [
            'username'=>'testuser1',
            'firstname'=>'testuser1',
            'lastname'=>'testuser1',
            'phone'=>'+666666656',
            'dob'=> 1998-07-13,
            'email' => 'testuser1@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $data2 = [
            'username'=>'testuser2',
            'firstname'=>'testuser2',
            'lastname'=>'testuser2',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser2@example.com',
            'password' => 'password456',
            'id_permission'=> 2,
        ];

        $model->createUser($data1);
        $model->createUser($data2);

        $result = $model->countUserByPermission();
        $this->assertCount(2, $result); // Vérifie qu'il y a 2 permissions dans le résultat
    }

    public function testActivateUser()
    {
        $model = new UserModel();
        $data = [
            'username'=>'testuser',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $model->createUser($data); // Crée l'utilisateur pour le test

        $userId = $model->insertID();
        $model->deleteUser($userId); // Supprime l'utilisateur

        // Vérifie que 'deleted_at' a bien été rempli (soft delete)
        $this->seeInDatabase('user', ['id' => $userId, 'deleted_at !=' => null]);

        // Réactive l'utilisateur (annule le soft delete)
        $model->activateUser($userId);

        // Vérifie que l'utilisateur est à nouveau actif
        $this->seeInDatabase('user', ['id' => $userId, 'deleted_at' => null]);
    }

    public function testGetPermissions() {
        $model = new UserModel();

        //Création de Users
        $user1 = [
            'username'=>'testuser1',
            'firstname'=>'testuser1',
            'lastname'=>'testuser1',
            'phone'=>'+666666656',
            'dob'=> 1998-07-13,
            'email' => 'testuser1@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $user2 = [
            'username'=>'testuser2',
            'firstname'=>'testuser2',
            'lastname'=>'testuser2',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser2@example.com',
            'password' => 'password456',
            'id_permission'=> 2,
        ];
        $model->createUser($user1);
        $model->createUser($user2);

        $result = $model->getPermissions();
        $this->assertIsArray($result);

        $this->assertEquals('testuser1', $result[0]['username']);
        $this->assertEquals('Administrateur', $result[0]['permission_name']);


        $this->assertEquals('testuser2', $result[1]['username']);
        $this->assertEquals('Collaborateur', $result[1]['permission_name']);
    }

    public function testGetPaginatedUser() {
        $model = new UserModel();
        //Création d'utilisateursS
        $data = [
            'username'=>'testuser',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $data2 = [
            'username'=>'testuser2',
            'firstname'=>'testuser2',
            'lastname'=>'testuser2',
            'phone'=>'+666666662',
            'dob'=> 1998-07-12,
            'email' => 'testuser2@example.com',
            'password' => 'password1232',
            'id_permission'=> 1,
        ];
        $data3 = [
            'username'=>'testuser3',
            'firstname'=>'testuser3',
            'lastname'=>'testuser3',
            'phone'=>'+666666663',
            'dob'=> 1998-07-12,
            'email' => 'testuser3@example.com',
            'password' => 'password1233',
            'id_permission'=> 1,
        ];
        $model->createUser($data);
        $model->createUser($data2);
        $model->createUser($data3);

        $result = $model->getPaginatedUser(0, 3, '', 'username', 'ASC');
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    public function testGetTotalUser() {
        $model = new UserModel();

        //Création d'utilisateursS
        $data = [
            'username'=>'testuser',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $data2 = [
            'username'=>'testuser2',
            'firstname'=>'testuser2',
            'lastname'=>'testuser2',
            'phone'=>'+666666662',
            'dob'=> 1998-07-12,
            'email' => 'testuser2@example.com',
            'password' => 'password1232',
            'id_permission'=> 1,
        ];
        $data3 = [
            'username'=>'testuser3',
            'firstname'=>'testuser3',
            'lastname'=>'testuser3',
            'phone'=>'+666666663',
            'dob'=> 1998-07-12,
            'email' => 'testuser3@example.com',
            'password' => 'password1233',
            'id_permission'=> 1,
        ];
        $model->createUser($data);
        $model->createUser($data2);
        $model->createUser($data3);

        $result = $model->getTotalUser();
        $this->assertEquals(3, $result);
    }

    public function testGetFilteredUser() {
        $model = new UserModel;

        $data = [
            'username'=>'testuser',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'+66666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser@example.com',
            'password' => 'password123',
            'id_permission'=> 1,
        ];
        $data2 = [
            'username'=>'testuser2',
            'firstname'=>'testuser',
            'lastname'=>'testuser',
            'phone'=>'766666666',
            'dob'=> 1998-07-12,
            'email' => 'testuser2@example.com',
            'password' => 'password654',
            'id_permission'=> 1,
        ];

        $model->createUser($data);
        $model->createUser($data2);
        $filter = $model->getFilteredUser('testuser2');
        $this->assertEquals(1, $filter);

        $filter = $model->getFilteredUser('testuser');
        $this->assertEquals(2, $filter);
    }
}
