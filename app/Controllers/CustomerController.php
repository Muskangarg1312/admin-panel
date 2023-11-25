<?php

namespace App\Controllers;
use App\Models\CustomerModel;

$session = \Config\Services::session();

class CustomerController extends BaseController
{

	public function __constructor() {
		$session = session();
	}

	public function all_customer()
	{   
		$model = new CustomerModel();
		$customers = $model->findAll();
		$session = session();
		return view('pages/customers/all_customer', ['customers' => $customers]);
	}

	public function add_customer()
	{  
		if ($this->request->getMethod() == 'get') {
			return view('pages/customers/add_customer');
		}
		elseif ($this->request->getMethod() == 'post') {
			$validated = $this->validate([
				'name' => 'required|alpha_numeric_space',
				'contact_person_name' => 'permit_empty|alpha_space',
				'contact_number' => 'permit_empty|min_length[10]|max_length[10]'
			],[ 
				'gst_type' => [
					'required' => 'This field is required',
				],
				'contact_person_name' => [
					'alpha_space' => 'Only letters and alphabets are allowed',
				],
				'contact_number' => [
					'min_length' => 'Minimum 10 digit required',
					'max_length' => 'Maximum 10 digit required',
				],
			]);
			if (!$validated) {
				session()->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back()->withInput();
			}

			$model = new CustomerModel();

			$insert = $model->insert([
				'name' => $this->request->getPost('name'),
				'address' => $this->request->getPost('address'),
				'contact_person_name' => $this->request->getPost('contact_person_name'),
				'contact_number' =>  $this->request->getPost('contact_number'),
			]);

			return redirect()->back()->with('message', 'Customer successfully added!');

			if(!$insert){
				return redirect()->back()->with('error', 'Customer not added, Please try again!');            
			}
		}
	}

	public function edit_customer($id){

		$model = new CustomerModel();
   		// $data['row'] = $model->where('id', $id)->first();

		if ($this->request->getMethod() == 'get') {
			$data['customer'] = $model->where('id', $id)->first();
			//dd($data);
			return view('pages/customers/edit_customer', $data);
		}

		if ($this->request->getMethod() == 'post') {

			$validated = $this->validate([
				'name' => 'required|alpha_numeric_space',
				'contact_person_name' => 'permit_empty|alpha_space',
				'contact_number' => 'permit_empty|min_length[10]|max_length[10]'
			],[ 
				'gst_type' => [
					'required' => 'This field is required',
				],
				'contact_person_name' => [
					'alpha_space' => 'Only letters and alphabets are allowed',
				],
				'contact_number' => [
					'min_length' => 'Minimum 10 digit required',
					'max_length' => 'Maximum 10 digit required',
				],
			]);
			if (!$validated) {
				session()->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back()->withInput();
			}
			$id = $this->request->getPost('id');
			//dd($id);
			$updateData = [
				'name' => $this->request->getPost('name'),
				'address' => $this->request->getPost('address'),
				'contact_person_name' => $this->request->getPost('contact_person_name'),
				'contact_number' =>  $this->request->getPost('contact_number'),
			];
			//dd($updateData);
			$update = $model->update($id, $updateData);

			if ($update) {
				return redirect()->back()->with('message', 'Customer Updated Successfully');
			} else {
				return redirect("customers/$id/edit_customer")->withInput();
			}
		}
	}

	public function delete_customer($id=null){
		$model = new CustomerModel();
		$model->delete($id);
		$data = [
		    'status' => 'Deleted Successfully!',
		    'status_text' => 'Your imaginary file has been deleted',
		    'type' => 'success',
		];

		return $this->response->setJSON($data);
	}
}

