<?php

namespace App\Http\Controllers;

use App\Models\LeadNote;
use App\Validations\leadnoteValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;


class LeadNoteController extends Controller
{
    //
    protected $table = 'lead_note';
    
    
    public function save(Request $request)
    {
        try {
            $returnData = [];

            $leads = new leadnoteValidation();
            $validationResult = $leads->validate($request->all());

            if ($validationResult !== null) {
                return json_encode($validationResult);
            }
            
            $objleads = new LeadNote();
            $returnData = $objleads->saveData($request->all());
            if (count($returnData) <= 0) {
                $returnData = ['status' => 'error', 'message' => 'Error in data insertion'];
            }
            return redirect()->back()->with('success', 'Lead Note created');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function destroy(Request $request, $id)
    {
        try {
            if ($id) {
                DB::table('lead_note')->where('id', $id)->update(['status'=>'1']);
            }
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
