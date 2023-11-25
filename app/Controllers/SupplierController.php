<?php

namespace App\Controllers;
use App\Models\SupplierModel;

$session = \Config\Services::session();

class SupplierController extends BaseController
{

	public function __constructor() {
		$session = session();
		// session()->set('logged_in', 'logged_in');
	}

	public function all_supplier()
	{   
		$model = new SupplierModel();
		$suppliers = $model->findAll();
		$session = session();
		return view('pages/supplier/all_supplier', ['suppliers' => $suppliers]);
	}

	public function add_supplier()
	{  
		if ($this->request->getMethod() == 'get') {
			return view('pages/supplier/add_supplier');
		}
		elseif ($this->request->getMethod() == 'post') {
			$validated = $this->validate([
				'name' => 'required|alpha_numeric_space',
				'gst_type' => 'required',
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

			$model = new SupplierModel();

			$insert = $model->insert([
				'name' => $this->request->getPost('name'),
				'address' => $this->request->getPost('address'),
				'gst_type' => $this->request->getPost('gst_type'),
				'contact_person_name' => $this->request->getPost('contact_person_name'),
				'contact_number' =>  $this->request->getPost('contact_number'),
			]);

			return redirect()->back()->with('message', 'Supplier successfully added!');

			if(!$insert){
				return redirect()->back()->with('error', 'Supplier not added, Please try again!');            
			}
		}
	}


	public function edit_supplier($id){

		$model = new SupplierModel();
   		// $data['row'] = $model->where('id', $id)->first();

		if ($this->request->getMethod() == 'get') {
			$data['supplier'] = $model->where('id', $id)->first();
			//dd($data);
			return view('pages/supplier/edit_supplier', $data);
		}

		if ($this->request->getMethod() == 'post') {

			$validated = $this->validate([
				'name' => 'required|alpha_numeric_space',
				'gst_type' => 'required',
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
				'gst_type' => $this->request->getPost('gst_type'),
				'contact_person_name' => $this->request->getPost('contact_person_name'),
				'contact_number' =>  $this->request->getPost('contact_number'),
			];
			//dd($updateData);
			$update = $model->update($id, $updateData);

			if ($update) {
				return redirect()->back()->with('message', 'Supplier Updated Successfully');
			} else {
				return redirect("suppliers/$id/edit_supplier")->withInput();
			}
		}
	}


	public function delete_supplier($id=null){
		$model = new SupplierModel();
		$model->delete($id);
		// $id = $this->request->getPost('id');
		//dd($id);
		// $model->where('id', $id)->delete();
		$data = [
			'status' => 'Deleted Successfully!',
			'status_text' => 'Your imaginary file has been deleted',
			'type' => 'success',
		];

		return $this->response->setJSON($data);
	}
}

