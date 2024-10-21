<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\LeadsModel;
use DB, Session;

class LeadsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     */
    public function model(array $row)
    {
        // dd($row);
        $company_id = Session::get('company_id');
        $user_id = Session::get('user_id');

        // Ensure that the column names in your Excel file match these keys
        $lead_name = $row['name'];
        $lead_email = $row['email'];
        $lead_contact = $row['contact'];
        $lead_service = $row['service'];
        $lead_state = $row['state'];
        $lead_city = $row['city'];

        $data = [
            'name' => $lead_name,
            'email' => $lead_email,
            'contact' => $lead_contact,
            'service' => $lead_service,
            'state' => $lead_state,
            'city' => $lead_city,
            'added_by' => $user_id,
            'lead_type' => 1,
            'company_id' => $company_id,
        ];
        // dd($data);

        // Use try-catch block to handle potential exceptions during insertion
        try {
            //  dd($data);
            // $leads = LeadsModel::create($data);
            // $leads = DB::table('leads')->insertGetId($data);
            // // dd($leads);

            // if ($leads) {
            //     // dd('success');
            //     return ['success' => true, 'msg' => "Leads Added"];
            // } else {
            //     return ['success' => false, 'msg' => "Failed to add leads"];
            // }

            return new LeadsModel($data);
        } catch (\Exception $e) {
            // dd($e->getMessage());

            // Handle the exception (e.g., log the error)
            return ['success' => false, 'msg' => "Something went wrong: " . $e->getMessage()];
        }
    }
}
