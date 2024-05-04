<?php

namespace App\Controllers;
use App\Models\Users;
use App\Models\Dealers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('registration');
    }

    public function registration(): string
    {
        return view('registration');
    }

    public function login(): string
    {
        return view('login');
    }

    public function register_user(): string
    {
        $users = new Users();
        $dealers = new Dealers();


        $request = $this->request;

        // Get form data
        $firstName = $request->getPost('firstName');
        $lastName = $request->getPost('lastName');
        $email = $request->getPost('email');
        $password = $request->getPost('password');
        $userType = $request->getPost('userType');

        $check_email = $users->where('email',$email)->find();

        if($check_email) {
            return json_encode(['status' => 'Error', 'message' => 'Email Already exists!!!', 'class' => 'alert-danger']);
        }

        $validationRules = [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'userType' => 'required|in_list[Employee,Dealer]',
        ];
        // Run validation
        if (!$this->validate($validationRules)) {
            // If validation fails, return the errors
            $errors = $this->validator->getErrors();
            return json_encode(['status' => 'error', 'message' => $errors]);
        }
        $data = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password,
            'user_type' => $userType
        ];
        $inserted = $users->insert($data);
        if($userType == 'Dealer') {
            $dealerData = [
                'user_id' => $users->insertID(),
                'city' => null,
                'state' => null,
                'zip_code' => null
            ];

        $dealers->insert($dealerData);
        }
        return json_encode(['status' => 'success', 'message' => 'User registered successfully', 'class' => 'alert-success']);
    }

    public function login_user()
    {
        $users = new Users();
        $dealers = new Dealers();
        $request = $this->request;
        $loginEmail = $request->getPost('loginEmail');
        $loginPassword = $request->getPost('loginPassword');
        $user = $users->where('email', $loginEmail)->where('password', $loginPassword)->first();
        if ($user) {
            $userType = $user['user_type'];
            if ($userType == 'Dealer') {
                $dealer = $dealers->where('user_id', $user['id'])->first();
                if ($dealer['first_login']) {
                    $dealers->set('first_login',0)->where('user_id',$user['id'])->update();
                    return json_encode(['status' => 'success', 'user_type' => 'Dealer', 'first_login' => true, 'user_id' => $user['id']]);
                } else {
                    return json_encode(['status' => 'Login Successful', 'class' => 'alert-success']);
                }
            } else {
                return json_encode(['status' => 'Login Successful', 'class' => 'alert-success']);
            }
        } else {
            return json_encode(['status' => 'Wrong Username/Password' , 'class' => 'alert-danger']);
        }
    }

    public function additional_data($id): string
    {
        $data['id'] = $id;
        return view('additional_details', $data);


    }

    public function add_dealer_data()
    {
        $users = new Users();
        $dealers = new Dealers();

        $request = $this->request;
        $id = $request->getPost('user_id');
        $city = $request->getPost('City');
        $state = $request->getPost('State');
        $zip_code = $request->getPost('Zip_code');
        $dealers->set([
            'city' => $city,
            'state' => $state,
            'zip_code' => $zip_code
        ])
        ->where('user_id',$id)
        ->update();

        if ($dealers->affectedRows() > 0) {
            // Data updated successfully
            return json_encode(['status' => 'Dealer data updated successfully' ,'class' => 'alert-success']);
        } else {
            // No rows affected, possibly no matching user ID found
            return json_encode(['status' => 'Failed to update dealer data' ,'class' => 'alert-danger']);
        }
    }

    public function dashboard()
    {
        $dealers = new Dealers();
        $resultArray = $dealers->getDealers();
        $data['dealer'] = $resultArray;
        return view('dashboard', $data);
    }

    public function getDealerData($id=null)
    {
        $dealers = new Dealers();

        $data = $dealers->select('*')->where('user_id',$id)->first();

        if (!empty($data)) {
            return json_encode(['data' => $data]);
        } else {
            return json_encode(['data' => 'No Data Found!']);
        }
    }
}
