<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Movie extends BaseController
{
    protected $require_auth = true;
    protected $requiredPermissions = ['administrateur'];
    public function getindex($id = null)
    {
        if($id == null) {
            return $this->view('admin/movie/index', [],true);
        }
        $categories = model('CategoryModel')->getAllCategories();
        if($id == "new") {
            return $this->view('/admin/movie/movie', ['categories'=>$categories],true);
        }
        if($id) {
            $movie = model('MovieModel')->getMovieById($id);
            if($movie) {
                return $this->view('admin/movie/movie', ['movie' => $movie, 'categories' => $categories, 'category_movie' => model('CategoryMovieModel')->getAllCategoriesByIdMovie($id)],true);
            } else {
                $this->error('Aucun film correspondant à cet ID');
                $this->redirect('admin/movie');
            }
        }
    }

    public function postcreate() {
        $data = $this->request->getPost();
        $newMovieId = model('MovieModel')->createMovie($data);
        if($newMovieId) {

            // Gestion des Images
            $file = $this->request->getFile('movie_image');
            if($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $mediaData = [
                    'entity_type' => "movie",
                    'entity_id' => $newMovieId,
                ];
                $uploadResult = upload_file($file, 'movie_preview', $data['title'], $mediaData, false, ['image/jpeg', 'image/png','image/jpg']);
                if(is_array($uploadResult)&& $uploadResult['status'] === 'error') {
                    $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                    $this->redirect("admin/movie");
                }
            }

            //Gestion des Catégories
            $data_categ = [];
            if(isset($data['categories'])) {
                foreach($data['categories'] as $c) {
                    $categ = [];
                    $categ['movie_id'] = $newMovieId;
                    $categ['category_id'] = $c;
                    $data_categ[] = $categ;
                }
            } else {
                $data_categ = [ ['movie_id' => $newMovieId, 'category_id' => 1] ];
            }
            model('CategoryMovieModel')->insertMultipleCategories($data_categ);

            $this->success('Film Ajouté');
        } else {
            $this->error("Erreur lors de l'ajout du film");
        }
        $this->redirect('/admin/movie');
    }

    public function postupdate() {
        $data = $this->request->getPost();
        if(model('MovieModel')->updateMovie($data['id'], $data)) {

            // Gestion des Images
            $file = $this->request->getFile('movie_image');
            if($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
                $old_media = model('MediaModel')->getMediaByEntityIdAndType($data['id'], 'movie');
                $mediaData = [
                    'entity_type' => "movie",
                    'entity_id' => $data['id'],
                ];
                $uploadResult = upload_file($file, 'movie_preview', $data['title'], $mediaData, false, ['image/jpeg', 'image/png','image/jpg']);
                if(is_array($uploadResult)&& $uploadResult['status'] === 'error') {
                    $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                    $this->redirect("/admin/movie");
                }
                if($old_media) {
                    model('MediaModel')->deleteMedia($old_media[0]['id']);
                }
            }

            // Gestion des Catégories
            if(isset($data['categories'])) {
                $categ_final = $data['categories'];
            } else {
                $categ_final = [];
            }
            $categ_initial = model('CategoryMovieModel')->getAllCategoryMovieByIdMovie($data['id']);
            $categ_initial = array_column($categ_initial, 'category_id');
            $categ_a_supprimer = array_diff($categ_initial, $categ_final);
            $categ_a_ajouter = array_diff($categ_final, $categ_initial);
            $data_categ = [];
            if($categ_a_supprimer) {
                foreach($categ_a_ajouter as $c) {
                    $categ = [];
                    $categ['movie_id'] = $data['id'];
                    $categ['category_id'] = $c;
                    $data_categ[] = $categ;
                }
            } else {
                if(count($categ_initial) == 0 || count($categ_final) == 0) {
                    $data_categ = [ ['movie_id' => $data['id'], 'category_id' => 1] ];
                }
            }
            $cmm = model('CategoryMovieModel');
            if(!(count($categ_initial) == 1 && $categ_initial[0] == 1 ) || count($categ_a_ajouter) != 0) {
                if(isset($categ_a_supprimer) && $categ_a_supprimer) {
                    $cmm->deleteMultipleCategories($data['id'], $categ_a_supprimer);
                }
                if(count($data_categ) !=0) {
                    $cmm->insertMultipleCategories($data_categ);
                }
            }

            $this->success('Fiche du Film Modifié');
        } else {
            $this->error("Erreur lors de la modification de la fiche du film");
        }
        $this->redirect('/admin/movie');
    }

    public function getdeactivate($id){
        $um = Model('MovieModel');
        if ($um->deleteMovie($id)) {
            $this->success("Film maintenant Indisponible");
        } else {
            $this->error("Erreur lors de la mise à jour");
        }
        $this->redirect('/admin/movie');
    }

    public function getactivate($id){
        $um = Model('MovieModel');
        if ($um->activateMovie($id)) {
            $this->success("Film maintenant Disponible");
        } else {
            $this->error("Erreur lors de la mise à jour");
        }
        $this->redirect('/admin/movie');
    }

    public function getcategory($id = null) {
        if($id == null) {
            return $this->view('admin/category/index', [], true);
        }
        if($id == "new") {
            return $this->view('admin/category/category', [], true);
        }
        $categ = model('CategoryModel')->getCategoryById($id);
        if($categ) {
            return $this->view('admin/category/category', ['categ' => $categ], true);
        }
    }

    public function postcreatecategory(){
        $data = $this->request->getPost();
        if(model('CategoryModel')->createCategory($data)) {
            $this->success('Catégorie Créee');
        } else {
            $this->error('Erreur lors de la création de la catégorie');
        }
        return $this->redirect('/admin/movie/category');
    }

    public function postupdatecategory() {
        $data = $this->request->getPost();
        if(model('CategoryModel')->updateCategory($data['id'], $data)) {
            $this->success('Catégorie Modifiée');
        } else {
            $this->error('Erreur lors de la modification de la catégorie');
        }
        return json_encode(model('CategoryModel')->getCategoryById($data['id']));
    }

    public function getdeletecategory($id) {
        if($id == 1) {
            $this->error('Impossible de supprimer cette catégorie');
        } else {
            if(model('CategoryModel')->deleteCategory($id)){
                $this->success('Catégorie Supprimée');
            } else {
                $this->error('Erreur lors de la suppression de la catégorie');
            }
        }
        return $this->redirect('admin/movie/category');
    }
}
