<?php

namespace App\Controllers;
use App\Models\EntryModel;
use App\Models\BankEntryModel;
use App\Models\CustomerModel;
use App\Models\CustomerEntryModel;
use App\Models\BankAccountModel;
use App\Models\SupplierModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\DayBookModel;

$session = \Config\Services::session();

class CustomerEntryController extends BaseController
{

	public function __constructor() {
		$session = session();
	}

	public function all_customer_entries()
	{   
		$entrymodel = new CustomerEntryModel();
		$data['entries'] = $entrymodel->orderBy('id', 'DESC')->findAll();
		//dd($data);
		$session = session();
		//dd($data);
		return view('pages/customer_entry/all_customer_entries', $data);
	}

	public function add_customer_entry()
	{  
		$bankmodel = new BankAccountModel();
		$data['banks'] = $bankmodel->findAll();

		$customermodel = new CustomerModel();
		$data['customers'] = $customermodel->findAll();
		//dd($categories);

		if ($this->request->getMethod() == 'get') {
			return view('pages/customer_entry/add_customer_entry', $data);
		}
		elseif ($this->request->getMethod() == 'post') {

			$validated = $this->validate([
				'customer_id' => 'required',
				'parent_bank_id' => 'required',
				'mode' => 'required',
				'value' => 'required',
			],[ 
				'customer_id' => [
					'required' => 'This field is required',
				],
				'mode' => [
					'required' => 'This field is required',
				],
				'parent_bank_id' => [
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

			$customer_name = '';
			if( $this->request->getPost('customer_id') ) {
				$customer = $customermodel->where('id', $this->request->getPost('customer_id'))->first();
				$customer_name = $customer['name'] ?? '';
			}
			$bank_name = '';
			if( $this->request->getPost('parent_bank_id') ) {
				$bank = $bankmodel->where('id', $this->request->getPost('parent_bank_id'))->first();
				$bank_name = $bank['name'] ?? '';
			}

			$model = new CustomerEntryModel();
			$data = [
				'customer_name' => $this->request->getPost('customer_id'),
				'mode' => $this->request->getPost('mode'),
				'date' => $this->request->getPost('date'),
				'bank_name' => $this->request->getPost('parent_bank_id'),
				'value' => $this->request->getPost('value'),
			];
			//var_dump($data);

			// if( !$model->insert($data) ) {
			// 	// return redirect()->back()->with('error', 'Entry not added, Please try again!');  
			// 	return $this->response->setJSON([
			// 			'status'		=> 'failed',
			// 			'message'		=> 'Customer Entry could not be added.'
			// 	]);
			// }
			// else{
			// 	return $this->response->setJSON([
			// 			'status'		=> 'success',
			// 			'data'			=> $data,
			// 			'message'		=> 'Customer Entry successfully added!'
			// 	]);
			// }

			$type_id = $model->insert($data);
			//var_dump($data);
			// die();

			if( !$type_id ) {
				return $this->response->setJSON([
						'status'		=> 'failed',
						'message'		=> 'Customer Entry could not be added.'
				]);
			}
			$date = $this->request->getPost('date');
			$dayData = new DayBookModel();
				$dayData->insert([
						'type_id'	=> $type_id,
						'date'		=> $date,
						'type'		=> 'customer_entry',
						'event'		=> 'New Entry',
						'data'		=> json_encode($data)
					]);
				return $this->response->setJSON([
						'status'		=> 'success',
						'data'			=> $data,
						'message'		=> 'Customer Entry successfully added!'
				]);
		}
	}


	public function edit_customer_entry($id){

		$model = new CustomerEntryModel();

		$categorymodel = new CategoryModel();

		$bankmodel = new BankAccountModel();

		$customermodel = new CustomerModel();


		if ($this->request->getMethod() == 'get') {

			$data = [];
			$data['categories'] = $categorymodel->findAll();

			$entrymodel = new CustomerEntryModel();

			$data['banks'] = $bankmodel->findAll();

			$data['customers'] = $customermodel->findAll();

			$data['entrymodel'] = $entrymodel->where('id', $id)->first();

			// $data['subcategories'] = false;
			// if( $data['entrymodel'] ) {
			// 	$subcategoryModel = new SubCategoryModel();
			// 	$data['subcategories'] = $subcategoryModel->where('parent_category_id', $data['entrymodel']['parent_category_id'])->findAll();
			// 	// dd($data['entrymodel']['sub_category_id']);
			// }
			// $data['bankmodel'] = new BankEntryModel();

			//dd($data);
			return view('pages/customer_entry/edit_customer_entry', $data);
			// return $this->response->setJSON($data);
		}

		if ($this->request->getMethod() == 'post') {
			$validated = $this->validate([
				'customer_id' => 'required',
				'parent_bank_id' => 'required',
				'mode' => 'required',
				'value' => 'required',
			],[ 
				'customer_id' => [
					'required' => 'This field is required',
				],
				'mode' => [
					'required' => 'This field is required',
				],
				'parent_bank_id' => [
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

			$customer_name = '';
			if( $this->request->getPost('customer_id') ) {
				$customer = $customermodel->where('id', $this->request->getPost('customer_id'))->first();
				$customer_name = $customer['name'] ?? '';
			}
			$bank_name = '';
			if( $this->request->getPost('parent_bank_id') ) {
				$bank = $bankmodel->where('id', $this->request->getPost('parent_bank_id'))->first();
				$bank_name = $bank['name'] ?? '';
			}

			//dd($id);
			$updateData = [
				'customer_name' => $this->request->getPost('customer_id'),
				'mode' => $this->request->getPost('mode'),
				'date' => $this->request->getPost('date'),
				'bank_name' => $this->request->getPost('parent_bank_id'),
				'value' => $this->request->getPost('value'),
			];
			//var_dump($updateData);
			$update = $model->update($id, $updateData);

			// if ($update) {
			// 	return $this->response->setJSON([
			// 			'status'		=> 'success',
			// 			'message'		=> 'Customer Entry Updated Successfully!'
			// 	]);
			// } else {
			// 	return $this->response->setJSON([
			// 			'status'		=> 'failed',
			// 			'message'		=> 'Customer Entry could not be updated.'
			// 	]);
			// }

			$update = $model->update($id, $updateData);
			//var_dump($updateData);

			if (!$update) {
				return $this->response->setJSON([
						'status'		=> 'failed',
						'message'		=> 'Customer Entry could not be updated.'
				]);
			}
			$date = $this->request->getPost('date');
			$dayData = new DayBookModel();
				$exist = $dayData->where('type_id', $id)->where('DATE(date)', $date)->first();
				if(  $exist ) {
					$dayData->update($exist['id'], [
						'type_id'	=> $id,
						//'date'		=> date('Y-m-d'),
						'type'		=> 'customer_entry',
						'event'		=> 'Entry Updated',
						'data'		=> json_encode($updateData)
					]);
				}
				else {

					$dayData->insert([
						'type_id'	=> $id,
						'date'		=> $date,
						'type'		=> 'customer_entry',
						'event'		=> 'Entry Updated',
						'data'		=> json_encode($updateData)
					]);
				}

					return $this->response->setJSON([
						'status'		=> 'success',
						'message'		=> 'Customer Entry Updated Successfully!'
				]);
		}
	}

	public function delete_customer_entry($id=null){
		$model = new CustomerEntryModel();
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

