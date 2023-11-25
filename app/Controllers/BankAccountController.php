<?php

namespace App\Controllers;
use App\Models\BankAccountModel;

$session = \Config\Services::session();

class BankAccountController extends BaseController
{

	public function __constructor() {
		$session = session();
	}

	public function all_bank_accounts()
	{   
		$model = new BankAccountModel();
		$bank_accounts = $model->findAll();
		$session = session();
		return view('pages/bank_account/all_bank_account', ['bank_accounts' => $bank_accounts]);
	}

	public function add_bank_account()
	{  
		if ($this->request->getMethod() == 'get') {
			return view('pages/bank_account/add_bank_account');
		}
		elseif ($this->request->getMethod() == 'post') {
			$fields = [
				'name' => 'required|alpha_numeric_space',
			];
			$validated = $this->validate($fields);
			if (!$validated) {
				session()->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back()->withInput();
			}

			$model = new BankAccountModel();

			$insert = $model->insert([
				'name' => $this->request->getPost('name'),
				'description' => $this->request->getPost('description'),
			]);

			return redirect()->back()->with('message', 'Bank Account successfully added!');

			if(!$insert){
				return redirect()->back()->with('error', 'bank_account not added, Please try again!');            
			}
		}
	}

	public function edit_bank_account($id){

		$model = new BankAccountModel();
   		// $data['row'] = $model->where('id', $id)->first();

		if ($this->request->getMethod() == 'get') {
			$data['bank_account'] = $model->where('id', $id)->first();
			//dd($data);
			return view('pages/bank_account/edit_bank_account', $data);
		}

		if ($this->request->getMethod() == 'post') {

			$fields = [
				'name' => 'required|alpha_numeric_space',
			];
			$validated = $this->validate($fields);
			if (!$validated) {
				session()->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back()->withInput();
			}

			$id = $this->request->getPost('id');
			//dd($id);
			$updateData = [
				'name' => $this->request->getPost('name'),
				'description' => $this->request->getPost('description'),
			];
			//dd($updateData);
			$update = $model->update($id, $updateData);

			if ($update) {
				return redirect()->back()->with('message', 'Bank Account Updated Successfully');
			} else {
				return redirect("bank_accounts/$id/edit_bank_account")->withInput();
			}
		}
	}

	public function delete_bank_account($id=null){
		$model = new BankAccountModel();
		$model->delete($id);
		$data = [
		    'status' => 'Deleted Successfully!',
		    'status_text' => 'Your imaginary file has been deleted',
		    'type' => 'success',
		];

		return $this->response->setJSON($data);
	}
}

