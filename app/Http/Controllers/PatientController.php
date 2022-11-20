<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
	# membuat method index
    public function index() {
        $patients = Patient::all();

		if ($patients->count() !== 0) {
			$data = [
				'message' => 'Get All Resource',
				'data' => $patients
			];
			
			return response()->json($data, 200);
		} else {
			$data = [
				'message' => 'Data is empty'
			];
	
			return response()->json($data, 200);
		}
    }
    
	# membuat method store
    public function store(Request $request) {
		$validateData = $request->validate([
			'name' => 'required',
			'phone' => 'required|numeric',
			'address' => 'required',
			'status' => 'required',
			'in_date_at' => 'required|date',
			'out_date_at' => 'required|date'
		]);

        $patient = Patient::create($validateData);

        $data = [
            'message' => 'Resource is added successfully',
            'data' => $patient
        ];

        return response()->json($data, 201);
    }

	# membuat method show
	public function show($id) {
		$patient = Patient::find($id);

		if ($patient) {
			$data = [
				'message' => 'Get Detail Resource',
				'data' => $patient
			];
	
			return response()->json($data, 200);
		} else {
			$data = [
				'message' => 'Resource not found'
			];
	
			return response()->json($data, 404);
		}

	}
    
	# membuat method update
    public function update(Request $request, $id) {
		$patient = Patient::find($id);

		if ($patient) {
			$input = [
				'name' => $request->name ?? $patient->name,
				'phone' => $request->phone ?? $patient->phone,
				'address' => $request->address ?? $patient->address,
				'status' => $request->status ?? $patient->status,
				'in_date_at' => $request->in_date_at ?? $patient->in_date_at,
				'out_date_at' => $request->out_date_at ?? $patient->out_date_at
			];

			$patient->update($input);

			$data = [
				'message' => 'Resource is updated successfully',
				'data' => $patient
			];

			return response()->json($data, 200);
		} else {
			$data = [
				'message' => 'Resource not found'
			];
	
			return response()->json($data, 404);
		}
    }
    
	# membuat method destroy
    public function destroy($id) {
		$patient = Patient::find($id);

		if ($patient) {
			$patient->delete();

			$data = [
				'message' => 'Resource is deleted successfully',
			];

			return response()->json($data, 200);
		} else {
			$data = [
				'message' => 'Resource not found'
			];
	
			return response()->json($data, 404);
		}
    }

	# membuat method search
	public function search($name) {
		$patient = Patient::where('name', 'LIKE', $name)->first(); // jika menggunakan get(), kode di dalam blok else tidak bisa dijalankan jika data yang dicari tidak tersedia.

		if ($patient) {
			$data = [
				'message' => 'Get searched resource',
				'data' => $patient
			];
	
			return response()->json($data, 200);
		} else {
			$data = [
				'message' => 'Resource not found'
			];
	
			return response()->json($data, 404);
		}
	}

	# membuat method positive
	public function positive() {
		$patient = Patient::where('status', 'Positive')->get();

		if ($patient) {
			$data = [
				'message' => 'Get positive resource',
				'total' => $patient->count(),
				'data' => $patient
			];
	
			return response()->json($data, 200);
		}
	}

	# membuat method recovered
	public function recovered() {
		$patient = Patient::where('status', 'Recovered')->get();

		if ($patient) {
			$data = [
				'message' => 'Get recovered resource',
				'total' => $patient->count(),
				'data' => $patient
			];
	
			return response()->json($data, 200);
		}
	}

	# membuat method dead
	public function dead() {
		$patient = Patient::where('status', 'Dead')->get();

		if ($patient) {
			$data = [
				'message' => 'Get dead resource',
				'total' => $patient->count(),
				'data' => $patient
			];
	
			return response()->json($data, 200);
		}
	}
}
