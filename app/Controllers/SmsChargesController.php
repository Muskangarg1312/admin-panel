<?php

namespace App\Controllers;
use App\Models\SmsChargeModel;
use App\Models\BankAccountModel;
use App\Models\DayBookModel;

$session = \Config\Services::session();

class SmsChargesController extends BaseController
{

	public function __constructor() {
		$session = session();
	}

	public function all_sms_charges()
	{   

		$smschargemodel = new SmsChargeModel();
		$data['charges'] = $smschargemodel->getBanks();
		$session = session();
		// dd($data);
		return view('pages/sms_charges/all_sms_charges', $data);
	}

	public function add_sms_charge()
	{  

		$bankmodel = new BankAccountModel();
		$data['banks'] = $bankmodel->findAll();

		if ($this->request->getMethod() == 'get') {
			return view('pages/sms_charges/add_sms_charge', $data);
		}
		elseif ($this->request->getMethod() == 'post') {

			$validated = $this->validate([
									'bank_id' => 'required',
									'value' => 'required',
								],[ 
									'bank_id' => [
										'required' => 'This field is required',
									],
									'value' => [
										'required' => 'This field is required',
									]
						]);
			if (!$validated) {

				session()->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back()->withInput();
			}


			$bank_name = '';
			if( $this->request->getPost('bank_id') ) {
				$bank = $bankmodel->where('id', $this->request->getPost('bank_id'))->first();
				$bank_name = $bank['name'] ?? '';
			}

			$model = new SmsChargeModel();
			$data = [
				'date' => $this->request->getPost('date'),
				'bank_id' => $this->request->getPost('bank_id'),
				'bank_name' => $bank_name,
				'value' => $this->request->getPost('value'),
				'sgst' => $this->request->getPost('sgst'),
				'cgst' => $this->request->getPost('cgst'),
				'igst' => $this->request->getPost('igst'),
			];
			//dd($data);
			$type_id = $model->insert($data);
			

			if( !$type_id ) {

				return redirect()->back()->with('error', 'SMS Charge not added, Please try again!');  
			}
			$date = $this->request->getPost('date');
			$dayData = new DayBookModel();
				$dayData->insert([
						'type_id'	=> $type_id,
						'date'		=> $date,
						'type'		=> 'sms_charges',
						'event'		=> 'New Entry',
						'data'		=> json_encode($data)
					]);
			return redirect()->back()->with('message', 'SMS Charge successfully added!');
		}
	}


	public function edit_sms_charge($id){

		$model = new SmsChargeModel();

		$bankmodel = new BankAccountModel();


		if ($this->request->getMethod() == 'get') {

			$data = [];
			// $data['categories'] = $categorymodel->findAll();

			$smschargemodel = new SmsChargeModel();

			$data['banks'] = $bankmodel->findAll();

			$data['smschargemodel'] = $smschargemodel->where('id', $id)->first();

			//dd($data);
			return view('pages/sms_charges/edit_sms_charge', $data);
			// return $this->response->setJSON($data);
		}

		if ($this->request->getMethod() == 'post') {
			$validated = $this->validate([
									'bank_id' => 'required',
									'value' => 'required',
								],[ 
									'bank_id' => [
										'required' => 'This field is required',
									],
									'value' => [
										'required' => 'This field is required',
									]
						]);
			if (!$validated) {

				session()->setFlashdata('validation', $this->validator->getErrors());
				return redirect()->back()->withInput();
			}

			$bank_name = '';
			if( $this->request->getPost('bank_id') ) {
				$bank = $bankmodel->where('id', $this->request->getPost('bank_id'))->first();
				$bank_name = $bank['name'] ?? '';
			}

			//dd($id);
			$updateData = [
				'date' => $this->request->getPost('date'),
				'bank_id' => $this->request->getPost('bank_id'),
				'bank_name' => $bank_name,
				'value' => $this->request->getPost('value'),
				'sgst' => $this->request->getPost('sgst'),
				'cgst' => $this->request->getPost('cgst'),
				'igst' => $this->request->getPost('igst'),
			];
			$update = $model->update($id, $updateData);
			//dd($updateData);

			if (!$update) {
				return redirect()->back()->with('error', 'SMS Charge not updated, Please try again!');  
			}
			$date = $this->request->getPost('date');
			$dayData = new DayBookModel();
			$exist = $dayData->where('type_id', $id)->where('DATE(date)', $date)->first();
				if(  $exist ) {
					$dayData->update($exist['id'], [
						'type_id'	=> $id,
						// 'date'		=> date('Y-m-d'),
						'type'		=> 'sms_charges',
						'event'		=> 'Entry Updated',
						'data'		=> json_encode($updateData)
					]);
				}
				else {

					$dayData->insert([
						'type_id'	=> $id,
						'date'		=> $date,
						'type'		=> 'sms_charges',
						'event'		=> 'Entry Updated',
						'data'		=> json_encode($updateData)
					]);
				}
			return redirect()->back()->with('message', 'SMS Charge successfully updated!');
		}
	}

	public function delete_sms_charge($id=null){
		$model = new SmsChargeModel();
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

