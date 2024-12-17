<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function getindex($id=null)
    {
        if($id == $this->session->user->id) {
            $utilisateur = model('UserModel')->getUserById($id);
            return $this->view('user', ['utilisateur' => $utilisateur]);
        } else {
            $this->error('Mauvaise pioche!');
            $this->redirect('');
        }
    }

    public function getdelete($id) {
        if(model('UserModel')->deleteUser($id)) {
            if (isset($this->session->user)) {
                $this->session->remove('user');
                $this->session->remove('theater');
            }
            $this->success('Compte Suprimé! ADIEU');
            $this->redirect('');
        } else {
            $this->error('Erreur lors de la supression du compte');
            $this->redirect('user');
        }
    }

    public function postupdate() {
        // Récupération des données envoyées via POST
        $data = $this->request->getPost();

        // Récupération du modèle UserModel
        $um = Model("UserModel");

        // Vérifier si un fichier a été soumis dans le formulaire
        $file = $this->request->getFile('profile_image'); // 'profile_image' est le nom du champ dans le formulaire
        // Si un fichier a été soumis
        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            // Récupération du modèle MediaModel
            $mm = Model('MediaModel');
            // Récupérer l'ancien média avant l'upload
            $old_media = $mm->getMediaByEntityIdAndType($data['id'], 'user');

            // Préparer les données du média pour le nouvel upload
            $mediaData = [
                'entity_type' => 'user',
                'entity_id'   => $data['id'],   // Utiliser l'ID de l'utilisateur
            ];

            // Utiliser la fonction upload_file() pour gérer l'upload et enregistrer les données du média
            $uploadResult = upload_file($file, 'avatar', $data['username'], $mediaData, true, ['image/jpeg', 'image/png','image/jpg']);

            // Vérifier le résultat de l'upload
            if (is_array($uploadResult) && $uploadResult['status'] === 'error') {
                // Afficher un message d'erreur détaillé et rediriger
                $this->error("Une erreur est survenue lors de l'upload de l'image : " . $uploadResult['message']);
                return $this->redirect("user/" . $data['id']);
            }

            // Si l'upload est un succès, suppression de l'ancien média
            if ($old_media) {
                $mm->deleteMedia($old_media[0]['id']);
            }
        }

        // Mise à jour des informations utilisateur dans la base de données
        if ($um->updateUser($data['id'], $data)) {
            // Si la mise à jour réussit
            $this->success("L'utilisateur a bien été modifié.");
        } else {
            $errors = $um->errors();
            foreach ($errors as $error) {
                $this->error($error);
            }
        }
        // Redirection vers la page des utilisateurs après le traitement
        return $this->redirect("user/" . $data['id']);
    }
}
