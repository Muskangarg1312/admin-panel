<?php

namespace App\Controllers;
use App\Models\EntryModel;
use App\Models\BankEntryModel;
use App\Models\BankAccountModel;
use App\Models\SupplierModel;
use App\Models\DayBookModel;
// use App\Models\SubCategoryModel;

$session = \Config\Services::session();

class BankEntryController extends BaseController
{

	public function __constructor() {
		$session = session();
	}

	public function all_bank_entries()
	{   
		$entrymodel = new BankEntryModel();
		$data['entries'] = $entrymodel->orderBy('id', 'DESC')->findAll();
		//dd($data);
		$session = session();
		//dd($data);
		return view('pages/bank_entry/all_bank_entries', $data);
	}

	public function add_bank_entry()
	{  
		// $categorymodel = new CategoryModel();
		// $data['categories'] = $categorymodel->findAll();

		$bankmodel = new BankAccountModel();
		$data['banks'] = $bankmodel->findAll();

		$suppliermodel = new SupplierModel();
		$data['suppliers'] = $suppliermodel->findAll();
		//dd($categories);

		if ($this->request->getMethod() == 'get') {
			return view('pages/bank_entry/add_bank_entry', $data);
		}
		elseif ($this->request->getMethod() == 'post') {

			$validated = $this->validate([
									'suppliers' => 'required',
									'bank_id' => 'required',
									'mode' => 'required',
									'total_value' => 'required',
								],[ 
									'suppliers' => [
										'required' => 'This field is required',
									],
									'mode' => [
										'required' => 'This field is required',
									],
									'bank_id' => [
										'required' => 'This field is required',
									],
									'total_value' => [
										'required' => 'This field is required',
									]
						]);
			if (!$validated) {

				$data = ['errors' =>  $this->validator->getErrors(),
				];

				return $this->response->setJSON($data);
			}

			$model = new BankEntryModel();
			$data = [
				'suppliers' => $this->request->getPost('suppliers'),
				'mode' => $this->request->getPost('mode'),
				'date' => $this->request->getPost('date'),
				'bank_id' => $this->request->getPost('bank_id'),
				'bank_name' => $this->request->getPost('bank_name'),
				'value' => $this->request->getPost('total_value'),
			];

			$type_id = $model->insert($data);
			//var_dump($data);
			// die();

			if( !$type_id ) {
				// return redirect()->back()->with('error', 'Entry not added, Please try again!');  
				return $this->response->setJSON([
						'status'		=> 'failed',
						'message'		=> 'Bank Entry could not be added.'
				]);
			}
			$date = $this->request->getPost('date');
			$dayData = new DayBookModel();
				$dayData->insert([
						'type_id'	=> $type_id,
						'date'		=> $date,
						'type'		=> 'bank_entry',
						'event'		=> 'New Entry',
						'data'		=> json_encode($data)
					]);
				return $this->response->setJSON([
						'status'		=> 'success',
						'data'			=> $data,
						'message'		=> 'Bank Entry successfully added!'
				]);
		}
	}


	public function edit_bank_entry($id){

		$model = new BankEntryModel();

		// $categorymodel = new CategoryModel();

		$bankmodel = new BankAccountModel();

		$suppliermodel = new SupplierModel();


		if ($this->request->getMethod() == 'get') {

			$data = [];
			// $data['categories'] = $categorymodel->findAll();

			$entrymodel = new BankEntryModel();

			$data['banks'] = $bankmodel->findAll();

			$data['suppliers'] = $suppliermodel->findAll();

			$data['entrymodel'] = $entrymodel->where('id', $id)->first();

			// $data['subcategories'] = false;
			// if( $data['entrymodel'] ) {
			// 	$subcategoryModel = new SubCategoryModel();
			// 	$data['subcategories'] = $subcategoryModel->where('parent_category_id', $data['entrymodel']['parent_category_id'])->findAll();
			// 	// dd($data['entrymodel']['sub_category_id']);
			// }
			// $data['bankmodel'] = new BankEntryModel();

			//dd($data);
			return view('pages/bank_entry/edit_bank_entry', $data);
			// return $this->response->setJSON($data);
		}

		if ($this->request->getMethod() == 'post') {
			$validated = $this->validate([
									'suppliers' => 'required',
									'bank_id' => 'required',
									'mode' => 'required',
									'total_value' => 'required',
								],[ 
									'suppliers' => [
										'required' => 'This field is required',
									],
									'mode' => [
										'required' => 'This field is required',
									],
									'bank_id' => [
										'required' => 'This field is required',
									],
									'total_value' => [
										'required' => 'This field is required',
									]
						]);

			if (!$validated) {
				$data = ['errors' =>  $this->validator->getErrors()];
				return $this->response->setJSON($data);
			}

			//dd($id);
			$updateData = [
				'suppliers' => $this->request->getPost('suppliers'),
				'mode' => $this->request->getPost('mode'),
				'date' => $this->request->getPost('date'),
				'bank_id' => $this->request->getPost('bank_id'),
				'bank_name' => $this->request->getPost('bank_name'),
				'value' => $this->request->getPost('total_value'),
			];
			$update = $model->update($id, $updateData);
			//var_dump($updateData);

			if (!$update) {
				return $this->response->setJSON([
						'status'		=> 'failed',
						'message'		=> 'Bank Entry could not be updated.'
				]);
			}
			$date = $this->request->getPost('date');
			$dayData = new DayBookModel();
				$exist = $dayData->where('type_id', $id)->where('DATE(date)', $date)->first();
				if(  $exist ) {
					$dayData->update($exist['id'], [
						'type_id'	=> $id,
						// 'date'		=> date('Y-m-d'),
						'type'		=> 'bank_entry',
						'event'		=> 'Entry Updated',
						'data'		=> json_encode($updateData)
					]);
				}
				else {

					$dayData->insert([
						'type_id'	=> $id,
						'date'		=> $date,
						'type'		=> 'bank_entry',
						'event'		=> 'Entry Updated',
						'data'		=> json_encode($updateData)
					]);
				}

					return $this->response->setJSON([
						'status'		=> 'success',
						'message'		=> 'Bank Entry Updated Successfully!'
				]);
		}
	}

	public function delete_bank_entry($id=null){
		$model = new BankEntryModel();
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

