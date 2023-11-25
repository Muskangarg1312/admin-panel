<?php

namespace App\Controllers;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;

$session = \Config\Services::session();

class SubCategoryController extends BaseController
{

	public function __constructor() {
		$session = session();
	}

	 public function getSubcategories($categoryId)
    {
        $subcategoryModel = new SubCategoryModel();
        $subcategories = $subcategoryModel->where('parent_category_id', $categoryId)->findAll();

        return $this->response->setJSON($subcategories);
    }

	public function all_sub_categories()
	{   
		$model = new SubCategoryModel();
		$sub_categories = $model->getCategoriesWithParent();
		//dd($sub_categories);
		$session = session();
		return view('pages/sub_category/all_sub_categories', ['sub_categories' => $sub_categories]);
	}

	public function add_sub_category()
	{  
    	$model = new CategoryModel();
		$categories = $model->findAll();
		//dd($categories);

		if ($this->request->getMethod() == 'get') {
			return view('pages/sub_category/add_sub_category', ['categories' => $categories]);
		}
		elseif ($this->request->getMethod() == 'post') {
			$validated = $this->validate([
                'name' => 'required|alpha_numeric_space',
				'parent_category_id' => 'required',
            ],[ 
                'parent_category_id' => [
                     'required' => 'This field is required',
                ]
           ]);
			if (!$validated) {
				session()->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back()->withInput();
			}

			$model = new SubCategoryModel();
			$data = [
				'parent_category_id' => $this->request->getPost('parent_category_id'),
				'name' => $this->request->getPost('name'),
				'description' => $this->request->getPost('description'),
			];

			if( !$model->insert($data) ) {
				return redirect()->back()->with('error', 'Sub Category not added, Please try again!');  
			}
			return redirect()->back()->with('message', 'Sub Category successfully added!');

		}
	}

	public function edit_sub_category($id){

		$Categorymodel = new CategoryModel();
		// $categories = $Categorymodel->findAll();
		$model = new SubCategoryModel();
		if ($this->request->getMethod() == 'get') {
			$data['categories'] = $Categorymodel->findAll();
			$data['sub_category'] = $model->where('id', $id)->first();
			//dd($data);
			return view('pages/sub_category/edit_sub_category', $data);
		}

		if ($this->request->getMethod() == 'post') {
			// $fields = [
			// 	'name' => 'required|alpha_space',
			// 	'parent_category_id' => 'required'
			// ];

			 $validated = $this->validate([
                'name' => 'required|alpha_numeric_space',
				'parent_category_id' => 'required',
            ],[ 
                'parent_category_id' => [
                     'required' => 'This field is required',
                ]
           ]);
			//$validated = $this->validate($fields);

			if (!$validated) {
				session()->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back()->withInput();
			}
			$id = $this->request->getPost('id');
			//dd($id);
			$updateData = [
				'name' => $this->request->getPost('name'),
				'parent_category_id' => $this->request->getPost('parent_category_id'),
				'description' => $this->request->getPost('description'),
			];
			//dd($updateData);
			$update = $model->update($id, $updateData);

			if ($update) {
				return redirect()->back()->with('message', 'Sub Category Updated Successfully');
			} else {
				return redirect("sub_category/$id/edit_sub_category")->withInput();
			}
		}
	}

	public function delete_sub_category($id=null){
		$model = new SubCategoryModel();
		$model->delete($id);
		$data = [
		    'status' => 'Deleted Successfully!',
		    'status_text' => 'Your imaginary file has been deleted',
		    'type' => 'success',
		];

		return $this->response->setJSON($data);
	}
}

