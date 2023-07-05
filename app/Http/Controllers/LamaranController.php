<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\Skills;
use App\Models\Candidates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class LamaranController extends Controller
{
    public function getJobs()
    {
        $jobs = Jobs::all();
        return response()->json([
            'success' => true,
            'message' => 'List Semua Job',
            'data' => $jobs
        ], 200);
    }

    public function getSkills()
    {
        $skills = Skills::all();
        return response()->json([
            'success' => true,
            'message' => 'List Semua Skill',
            'data' => $skills
        ], 200);
    }

    public function applyLamaran(Request $request)
    {
        $name = $request->input('nama');
        $jobs = $request->input('jabatan');
        $phone = $request->input('telepon');
        $email = $request->input('email');
        $year = $request->input('tahun');
        $skills = $request->input('skill');
        
        $validationRules = [
            'nama' => 'required',
            'jabatan' => 'required|exists:jobs,id',
            'telepon' => 'required|unique:candidates,phone|numeric',
            'email' => 'required|unique:candidates,email|email',
            'tahun' => 'required|numeric',
            'skill' => 'required|array|exists:skills,id'
        ];
        
        try {
            $validate = $this->validate($request, $validationRules);
        } catch (ValidationException $validationException) {
            return $validationException->errors();
        }
        
        DB::beginTransaction();
        try {
            // Simpan data ke table candidates
            $candidate = Candidates::create([
                'job_id' => $jobs,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'year' => $year,
                'created_by' => 1,
                'updated_by' => 1
            ]);
    
            // Simpan data skill[] ke table skill_sets
            $candidate->skillSets()->attach($skills);
    
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Apply Lamaran Berhasil',
                'data' => $candidate
            ], 201);
        } catch (\PDOException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Apply Lamaran Gagal',
                'data' => $e->getMessage()
            ], 400);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Apply Lamaran Gagal',
                'data' => $e->getMessage()
            ], 400);
        }
    }
}
