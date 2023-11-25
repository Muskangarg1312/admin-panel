<?php

namespace App\Controllers;
use App\Models\EntryModel;
use App\Models\SupplierModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\DayBookModel;

$session = \Config\Services::session();

class EntryController extends BaseController
{

	public function __constructor() {
		$session = session();
	}

	public function all_entries()
	{   
		$entrymodel = new EntryModel();
		$data['entries'] = $entrymodel->orderBy('id', 'DESC')->findAll();
		//dd($data);
		$session = session();
		//dd($data);
		return view('pages/entry/all_entries', $data);
	}

	public function add_entry()
	{  
		$categorymodel = new CategoryModel();
		$data['categories'] = $categorymodel->findAll();

		$suppliermodel = new SupplierModel();
		$data['suppliers'] = $suppliermodel->findAll();
		//dd($categories);

		if ($this->request->getMethod() == 'get') {
			return view('pages/entry/add_entry', $data);
		}
		elseif ($this->request->getMethod() == 'post') {

			$validated = $this->validate([
				'supplier_id' => 'required',
				'gst_percentage' => 'required',
				'parent_category_id' => 'required',
				'value' => 'required',
			],[ 
				'supplier_id' => [
					'required' => 'This field is required',
				],
				'gst_percentage' => [
					'required' => 'This field is required',
				],
				'parent_category_id' => [
					'required' => 'This field is required',
				],
				'value' => [
					'required' => 'This field is required',
				]
			]);
			if (!$validated) {

				$data = ['errors' =>  $this->validator->getErrors(),
				];

				return $this->response->setJSON($data);
			}

			$supplier_name = '';
			if( $this->request->getPost('supplier_id') ) {
				$supplier = $suppliermodel->where('id', $this->request->getPost('supplier_id'))->first();
				$supplier_name = $supplier['name'] ?? '';
			}
			$category_name = '';
			if( $this->request->getPost('parent_category_id') ) {
				$category = $categorymodel->where('id', $this->request->getPost('parent_category_id'))->first();
				$category_name = $category['name'] ?? '';
			}
			$subcategory_name = '';
			if( $this->request->getPost('sub_category_id') ) {
				$subcategoryModel = new SubCategoryModel();
				$category = $subcategoryModel->where('id', $this->request->getPost('sub_category_id'))->first();
				$subcategory_name = $category['name'] ?? '';
			}

			$model = new EntryModel();
			$data = [
				'supplier_id' => $this->request->getPost('supplier_id'),
				'date' => $this->request->getPost('date'),
				'gst_type' => $this->request->getPost('gst_type'),
				'supplier_name'	=> $supplier_name,
				'category_name' => $category_name,
				'subcategory_name' => $subcategory_name,
				'gst_percentage' => $this->request->getPost('gst_percentage'),
				'parent_category_id' => $this->request->getPost('parent_category_id'),
				'sub_category_id' => $this->request->getPost('sub_category_id'),
				'value' => $this->request->getPost('value'),
				'sgst' => $this->request->getPost('sgst'),
				'cgst' => $this->request->getPost('cgst'),
				'igst' => $this->request->getPost('igst'),
			];
			//dd($data);

			// if( !$model->insert($data) ) {
			// 	// return redirect()->back()->with('error', 'Entry not added, Please try again!');  
			// 	return $this->response->setJSON([
			// 			'status'		=> 'failed',
			// 			'message'		=> 'Entry could not be added.'
			// 	]);
			// }
			// // return redirect()->back()->with('message', 'Entry successfully added!');
			// else{
			// 	return $this->response->setJSON([
			// 			'status'		=> 'success',
			// 			'data'			=> $data,
			// 			'message'		=> 'Entry successfully added!'
			// 	]);
			// }

			$type_id = $model->insert($data);
			//var_dump($data);
			// die();

			if( !$type_id ) {
				return $this->response->setJSON([
						'status'		=> 'failed',
						'message'		=> 'Entry could not be added.'
				]);
			}
			$date = $this->request->getPost('date');
			$dayData = new DayBookModel();
				$dayData->insert([
						'type_id'	=> $type_id,
						'date'		=> $date,
						'type'		=> 'voucher_entry',
						'event'		=> 'New Entry',
						'data'		=> json_encode($data)
					]);
				return $this->response->setJSON([
						'status'		=> 'success',
						'data'			=> $data,
						'message'		=> 'Entry successfully added!'
				]);
		}
	}

	public function storeSelectedSubcategory()
	{
	    $subCategoryId = $this->request->getPost('sub_category_id');

	    // Here, you can write the code to store the $subCategoryId in your database

	    // return $this->response->setJSON(['success' => true]);

	     session()->set('old_sub_category_id', $sub_category_id);
	}


	public function edit_entry($id){

		$model = new EntryModel();
		if ($this->request->getMethod() == 'get') {

			$data = [];
			$categorymodel = new CategoryModel();
			$data['categories'] = $categorymodel->findAll();

			$suppliermodel = new SupplierModel();
			$data['suppliers'] = $suppliermodel->findAll();

			$entrymodel = new EntryModel();
			$data['entrymodel'] = $entrymodel->where('id', $id)->first();
			$data['subcategories'] = false;
			if( $data['entrymodel'] ) {
				$subcategoryModel = new SubCategoryModel();
				$data['subcategories'] = $subcategoryModel->where('parent_category_id', $data['entrymodel']['parent_category_id'])->findAll();
				// dd($data['entrymodel']['sub_category_id']);
			}

			return view('pages/entry/edit_entry', $data);
			// return $this->response->setJSON($data);
		}

		if ($this->request->getMethod() == 'post') {
			$validated = $this->validate([
				'supplier_id' => 'required',
				'gst_percentage' => 'required',
				'parent_category_id' => 'required',
				'value' => 'required',
			],[ 
				'supplier_id' => [
					'required' => 'This field is required',
				],
				'gst_percentage' => [
					'required' => 'This field is required',
				],
				'value' => [
					'required' => 'This field is required',
				],
				'parent_category_id' => [
					'required' => 'This field is required',
				],
				'value' => [
					'required' => 'This field is required',
				]
			]);

			if (!$validated) {
				$data = ['errors' =>  $this->validator->getErrors(),
				];

				return $this->response->setJSON($data);
			}

			$supplier_name = '';
			if( $this->request->getPost('supplier_id') ) {
				$suppliermodel = new SupplierModel();
				$supplier = $suppliermodel->where('id', $this->request->getPost('supplier_id'))->first();
				$supplier_name = $supplier['name'] ?? '';
			}
			$category_name = '';
			if( $this->request->getPost('parent_category_id') ) {
				$categorymodel = new CategoryModel();
				$category = $categorymodel->where('id', $this->request->getPost('parent_category_id'))->first();
				$category_name = $category['name'] ?? '';
			}
			$subcategory_name = '';
			if( $this->request->getPost('sub_category_id') ) {
				$subcategoryModel = new SubCategoryModel();
				$category = $subcategoryModel->where('id', $this->request->getPost('sub_category_id'))->first();
				$subcategory_name = $category['name'] ?? '';
			}

			//dd($id);
			$updateData = [
						'supplier_id' => $this->request->getPost('supplier_id'),
						'date' => $this->request->getPost('date'),
						'gst_type' => $this->request->getPost('gst_type'),
						'supplier_name'	=> $supplier_name,
						'category_name' => $category_name,
						'subcategory_name' => $subcategory_name,
						'gst_percentage' => $this->request->getPost('gst_percentage'),
						'parent_category_id' => $this->request->getPost('parent_category_id'),
						'sub_category_id' => $this->request->getPost('sub_category_id'),
						'value' => $this->request->getPost('value'),
						'sgst' => $this->request->getPost('sgst'),
						'cgst' => $this->request->getPost('cgst'),
						'igst' => $this->request->getPost('igst'),
					];
			$update = $model->update($id, $updateData);

			// if ($update) {
			// 	return $this->response->setJSON([
			// 			'status'		=> 'success',
			// 			'message'		=> 'Entry Updated Successfully!'
			// 	]);
			// } else {
			// 	return $this->response->setJSON([
			// 			'status'		=> 'failed',
			// 			'message'		=> 'Entry could not be updated.'
			// 	]);
			// }

			if (!$update) {
				return $this->response->setJSON([
						'status'		=> 'failed',
						'message'		=> 'Entry could not be updated.'
				]);
			}
			$date = $this->request->getPost('date');
			$dayData = new DayBookModel();
				$exist = $dayData->where('type_id', $id)->where('DATE(date)', $date)->first();
				if(  $exist ) {
					$dayData->update($exist['id'], [
						'type_id'	=> $id,
						// 'date'		=> date('Y-m-d'),
						'type'		=> 'voucher_entry',
						'event'		=> 'Entry Updated',
						'data'		=> json_encode($updateData)
					]);
				}
				else {

					$dayData->insert([
						'type_id'	=> $id,
						'date'		=> $date,
						'type'		=> 'voucher_entry',
						'event'		=> 'Entry Updated',
						'data'		=> json_encode($updateData)
					]);
				}

					return $this->response->setJSON([
						'status'		=> 'success',
						'message'		=> 'Entry Updated Successfully!'
				]);
		}
	}

	public function delete_entry($id=null){
		$model = new EntryModel();
		$data = $model->where('id', $id)->first();
		if( !$data ) {
			return $this->response->setJSON([
							'status' => 'Data not found!',
							'status_text' => 'Your imaginary file has been deleted',
							'type' => 'failed',
					]);
		}

		$dayData = new DayBookModel();
		$date = $data['date'];
		$exist = $dayData->where('type_id', $id)->where('DATE(date)', $date)->first();
		if(  $exist ) {
			$dayData->delete($exist['id']);
		}
		$model->delete($id);
		$data = [
			'exist'	=> $exist,
			'status' => 'Deleted Successfully!',
			'status_text' => 'Your imaginary file has been deleted',
			'type' => 'success',
		];

		return $this->response->setJSON($data);
	}
}

