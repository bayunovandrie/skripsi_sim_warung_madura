<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Myth\Auth\Models\UserModel;
use App\Models\GroupModel;

class ProfileController extends BaseController
{
    public function index()
    {
        $data['title'] = "Manajemen Stok | Profile";
        $data['topbar_name'] = "Profile";

        $auth = service('authentication'); 
        $authorize = service('authorization'); 

        $user = $auth->user(); 

        $isAdmin = $authorize->inGroup('admin', $user->id);
        $isUser  = $authorize->inGroup('user', $user->id);
        
        $data['users'] = $this->listUsers();
        
        return view('profile/page_profile', $data);
    }

    public function create()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');

        // cek username sudah ada
        if ($userModel->where('username', $username)->first()) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Username sudah digunakan!'
            ]);
        }

        $data = [
            'username' => $username,
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'active'   => 1,
        ];

        if (!$userModel->save($data)) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => implode(', ', $userModel->errors())
            ]);
        }

        // ambil ID user baru
        $newUserId = $userModel->getInsertID();
        if ($newUserId) {
            $auth = service('authorization');
            $auth->addUserToGroup($newUserId, 'user');
        }

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'User berhasil ditambahkan!'
        ]);
    }

    public function update()
    {
        $userID = $this->request->getPost('userid');
        $username = $this->request->getPost('username');
        $change_password = $this->request->getPost('change_password');

        $userModel = new UserModel();

        $user = $userModel->find($userID);
        if (!$user) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'User tidak ditemukan!'
            ]);
        }

        if ($username != $user->username) {
            $existing = $userModel->where('username', $username)->first();
            if ($existing) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Username sudah digunakan!'
                ]);
            }
        }

        if($change_password == 1) {
            $password = $this->request->getPost('password');

            $data_update = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
        } else {
            $data_update = [
                'username' => $username
            ];
        }

        $userModel->update($userID, $data_update);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'User berhasil diupdate!'
        ]);
    }

    public function delete()
    {
        $userID = $this->request->getPost('value_post');

        $userModel = new UserModel();

        // hapus user, bisa cek dulu
        $user = $userModel->find($userID);
        if (!$user) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'User tidak ada!'
            ]);
        }

        $userModel->delete($userID);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'User berhasil dihapus!'
        ]);
    }

    public function listUsers()
    {
        $userModel = new UserModel();
        $groupModel = new GroupModel();
    
        $users = $userModel->findAll();
    
        $usersWithGroup = [];
        foreach ($users as $user) {
            $groups = $groupModel->select('auth_groups.name')
                ->join('auth_groups_users', 'auth_groups.id = auth_groups_users.group_id')
                ->where('auth_groups_users.user_id', $user->id)
                ->findAll();

            $groupNames = array_map(fn($g) => $g['name'], $groups);

            if (in_array('user', $groupNames)) {
                $usersWithGroup[] = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'active' => $user->active,
                    'groups' => $groupNames,
                ];
            }
        }
    
        return $usersWithGroup;
    }


}