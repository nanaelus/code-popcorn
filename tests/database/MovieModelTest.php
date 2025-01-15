<?php

namespace database;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use App\Models\MovieModel;

class MovieModelTest extends CIUnitTestCase
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
        $this->db->table('movie')->truncate();

        $data = [
            [
                'id' => 1,
                'title' => 'test movie',
                'release' => 1998-07-12,
                'duration' => 90,
                'description' => 'test description',
                'slug' => 'test-movie',
                'rating' => 'Tous Publics'
            ],
            [
                'id' => 2,
                'title' => 'Wazaaaa',
                'release' => 2018-11-22,
                'duration' => 90,
                'description' => 'test description666',
                'slug' => 'wazaaaa',
                'rating' => 'Tous Publics'
            ],
            [
                'id' => 3,
                'title' => 'test pagination',
                'release' => 1978-01-12,
                'duration' => 90,
                'description' => 'test description2',
                'slug' => 'test-pagination',
                'rating' => '-18 ans'
            ]
        ];
        $this->db->table('movie')->insertBatch($data);

        //re-enable foreign key checks
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }
    protected function tearDown(): void
    {
        parent::tearDown();
        //Désactiver la vérification des clés étrangères
        $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        //truncature des tables
        $this->db->table('movie')->truncate();
        $this->db->table('media')->truncate();

        // Réactiver la vérification des clés etrangeres
        $this->db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    public function testCreateMovie() {
        $model = new MovieModel();
        $data = [
            'title' => 'testouille movie',
            'release' => 1998-07-12,
            'duration' => 90,
            'descritpion' => 'test description',
            'rating' => 'Tous Publics'
        ];
        $result = $model->createMovie($data);

        $this->assertTrue($result > 0);
        $this->seeInDatabase('movie', ['title' => 'testouille movie']);
    }

    public function testUpdateMovie() {
        $model = new MovieModel();

        //Data à mettre à jour pour le film fictif
        $updatedData = ['title' => 'updated movie', 'duration' => 122];

        //Utilisation de la fonction à tester
        $model->updateMovie(1, $updatedData);

        //Vérification de la mise à jour de la data
        $this->seeInDatabase('movie', ['title' => 'updated movie', 'duration' => 122]);
        $this->dontSeeInDatabase('movie', ['title' => 'test movie', 'duration' => 90]);
    }

    public function testDeleteMovie() {
        $model = new MovieModel();

        //Vérification de l'insertion du film dans la Base de Données
        $this->seeInDatabase('movie', ['id' => 1]);

        //Utilisation de la fonction à tester
        $result = $model->deleteMovie(1);

        // Vérifiez si la colonne `deleted_at` est non-nulle après la suppression, si vous utilisez le soft delete
        $this->seeInDatabase('movie', ['id' => 1, 'deleted_at !=' => null]);
    }

    public function testGetMovieById(){
        $model = new MovieModel();

        $movie = $model->getMovieById(1);
        $this->assertEquals('test movie' ,$movie['title']);

        $movie = $model->getMovieById(2);
        $this->assertEquals('Wazaaaa' ,$movie['title']);
    }

    public function testGetPaginated() {
        $model = new MovieModel();

        $result = $model->getPaginated(0, 3, '', 'title', 'ASC');
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    public function testGetTotal() {
        $model = new MovieModel();

        $result = $model->getTotal();
        $this->assertEquals(3, $result);
    }

    public function testGetFiltered() {
        $model = new MovieModel();

        $filter = $model->getFiltered('test movie');
        $this->assertEquals(1, $filter);

        $filter = $model->getFiltered('Wazaaaa');
        $this->assertEquals(1, $filter);

        $filter = $model->getFiltered('Tous Publics');
        $this->assertEquals(2, $filter);
    }

    public function testActivateMovie() {
        $model = new MovieModel();

        $model->activateMovie(1);
        $this->seeInDatabase('movie', ['id' => 1, 'deleted_at' => null]);
    }

    public function testGetAllMovies() {
        $model = new MovieModel();

        $result = $model->getAllMovies();
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
    }

    public function testGetMovieBySlug() {
        $model = new MovieModel();

        $result = $model->getMovieBySlug('test-movie');
        $this->assertEquals(1, $result['id']);

        $result = $model->getMovieBySlug('wazaaaa');
        $this->assertEquals(2, $result['id']);

        $result = $model->getMovieBySlug('test-pagination');
        $this->assertEquals(3, $result['id']);
    }

    public function testSearchMoviesByName() {
        $model = new MovieModel();

        $movie = $model->searchMoviesByName('test movie');
        $this->assertCount(1, $movie);

        $movie = $model->searchMoviesByName('Wazaaaa');
        $this->assertCount(1, $movie);

        $movie = $model->searchMoviesByName('test pagination');
        $this->assertCount(1, $movie);
    }
}