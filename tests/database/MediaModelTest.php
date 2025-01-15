<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\MediaModel;

class MediaModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    protected $migrate = true;
    protected function setUp(): void
    {// se déclanchera avant chaque fonction de test unitaire

        parent::setUp();
        //Disable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncate the table before each test
        $this->db->table('media')->truncate();

        // Création de faux medias
        $data = [
            [
                'id' => 1,
                'file_path' => 'uploads/media/file1.jpg',
                'entity_id' => 1,
                'entity_type' => 'user',
                'created_at' => '2025-01-15 12:00:00'
            ],
            [
                'id' => 2,
                'file_path' => 'uploads/media/file2.jpg',
                'entity_id' => 1,
                'entity_type' => 'user',
                'created_at' => '2025-01-16 12:00:00'
            ]
        ];
        $this->db->table('media')->insertBatch($data);

        //re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
    protected function tearDown(): void
    {
        parent::tearDown();
        //Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncature des tables
        $this->db->table('media')->truncate();
        $this->db->table('user')->truncate();

        // Réactiver la vérification des clés etrangeres
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function testGetMediaByEntityIdAndType()
    {
        $model = new MediaModel();

        $result = $model->getMediaByEntityIdAndType(1,'user');
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    public function testDeleteMedia()
    {
        $model = new MediaModel();

        $result = $model->deleteMedia(1);
        $this->assertFalse($result);
    }
}