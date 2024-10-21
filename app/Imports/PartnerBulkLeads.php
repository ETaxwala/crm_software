<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\LeadsModel;
use DB, Session;

class PartnerBulkLeads implements ToModel, WithHeadingRow
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
            'lead_type' => 2,
            'company_id' => $company_id,
        ];
        // dd($data);

        // Use try-catch block to handle potential exceptions during insertion
        try {
            // dd("in import try block");
            // return new LeadsModel($data);

            $lead = new LeadsModel($data);
            $lead->save();

            // Get the ID of the inserted record
            $insertedId = $lead->id;
            DB::table('lead_assign')->insert([
                'lead_id' => $insertedId,
                    'assign_to' => $user_id,
                    'lead_type' => 2,
            ]);

            return $lead;
        } catch (\Exception $e) {
            // dd($e->getMessage());

            // Handle the exception (e.g., log the error)
            return ['success' => false, 'msg' => "Something went wrong: " . $e->getMessage()];
        }
    }
}
