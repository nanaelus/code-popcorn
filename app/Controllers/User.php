<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    public function getindex($id=null)
    {
        if($this->session->user->deleted_at != null) {
            $this->redirect('theater');
        }
        if($id==$this->session->user->id && $this->session->user->deleted_at == null) {
            return $this->view('user');
        } else {
            $this->error('Mauvaise pioche!');
            $this->redirect('');
        }
    }

    public function getdelete($id) {
        if(model('UserModel')->deleteUser($id)) {
            $this->success('Compte Suprimé! ADIEU');
            $this->logout();
            $this->redirect('');
        } else {
            $this->error('Erreur lors de la supression du compte');
            $this->redirect('user');
        }
    }
}
