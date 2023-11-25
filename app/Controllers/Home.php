<?php

namespace App\Controllers;
use App\Models\SupplierModel;
use App\Models\CustomerModel;
use App\Models\BankAccountModel;

$session = \Config\Services::session();

class Home extends BaseController
{

    public function __constructor() {
        $session = session();
    }

    // public function welcome(){
    //     return view('welcome_message');
    // }

    public function index()
    {   
        $bankmodel = new BankAccountModel();
        $data['banks'] = $bankmodel->countAllResults();

        $suppliermodel = new SupplierModel();
        $data['suppliers'] = $suppliermodel->countAllResults();

        $customermodel = new CustomerModel();
        $data['customers'] = $customermodel->countAllResults();
       //dd($data);
        // var_dump($data);
        // die;

        return view('index', $data);
    }

    public function login()
    {
        if ($this->request->getMethod() == 'get') {
            return view('login');
        } elseif ($this->request->getMethod() == 'post') {

        // Validation rules
            $validated = $this->validate([
                'username' => 'required',
                'password' => 'required',
            ]);

            if (!$validated) {
                session()->setFlashdata('validation', $this->validator->getErrors());
                return redirect()->back()->withInput();
            }

        // Proceed with login attempt
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            if ($username == 'admin' && $password == 'admin@123') {
                $session = session();
                session()->set('logged_in', 'logged_in');
                return redirect()->to(base_url())->with('message', 'Logged in Successfully!');
            } else {
                session()->setFlashdata('error', 'Incorrect username or password');
                return redirect()->back()->withInput();
            }
        }
    }


    public function logout()
    {
        $session = session();
        session_unset();
        session_destroy();
        return redirect()->to(base_url('login'));
    }
}