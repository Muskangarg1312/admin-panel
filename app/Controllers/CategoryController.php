<?php

namespace App\Controllers;
use App\Models\CategoryModel;

$session = \Config\Services::session();

class CategoryController extends BaseController
{

	public function __constructor() {
		$session = session();
	}

	public function all_categories()
	{   
		$model = new CategoryModel();
		$categories = $model->findAll();
		$session = session();
		return view('pages/category/all_categories', ['categories' => $categories]);
	}

	public function add_category()
	{  
		if ($this->request->getMethod() == 'get') {
			return view('pages/category/add_category');
		}
		elseif ($this->request->getMethod() == 'post') {
			$validated = $this->validate([
				'name' => 'required|alpha_numeric_space|is_unique[categories.name]',
			
			]);
			if (!$validated) {
				session()->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back()->withInput();
			}

			$model = new CategoryModel();

			$insert = $model->insert([
				'name' => $this->request->getPost('name'),
				'description' => $this->request->getPost('description'),
			]);

			return redirect()->back()->with('message', 'Category successfully added!');

			if(!$insert){
				return redirect()->back()->with('error', 'Category not added, Please try again!');            
			}
		}
	}

	public function edit_category($id){

		$model = new CategoryModel();
   		// $data['row'] = $model->where('id', $id)->first();

		if ($this->request->getMethod() == 'get') {
			$data['category'] = $model->where('id', $id)->first();
			//dd($data);
			return view('pages/category/edit_category', $data);
		}

		if ($this->request->getMethod() == 'post') {
			$validated = $this->validate([
				'name' => 'required|alpha_numeric_space|is_unique[categories.name]',
			
			]);
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
				return redirect()->back()->with('message', 'Category Updated Successfully');
			} else {
				return redirect("category/$id/edit_category")->withInput();
			}
		}
	}

	public function delete_category($id=null){

		$model = new CategoryModel();
		$model->delete($id);
		$data = [
		    'status' => 'Deleted Successfully!',
		    'status_text' => 'Your imaginary file has been deleted',
		    'type' => 'success',
		];

		return $this->response->setJSON($data);
	}
}

