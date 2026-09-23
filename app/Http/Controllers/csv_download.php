<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\add_faculty_model;

class csv_download extends Controller
{
    public function csv_insert(Request $request)
    {
        $filename = $request->file('csv_file');
        $extension = $filename->getClientOriginalExtension();
        $newFilename = time() . '.' . $extension;
        $filename->move('Csv_Files/', $newFilename);
        
        $newpath= 'Csv_Files/' .$newFilename;

        $filePath = $newpath;
        
        // Open the file and read its contents
        if (($handle = fopen('Csv_Files/' .$newFilename, 'r')) !== false) {
            $header = fgetcsv($handle); // Read the header row
    
            while (($row = fgetcsv($handle)) !== false) {
              
               // echo $row[0] . $row[1] .$row[2];
                $rec = new add_faculty_model();
                $rec->faculty_code = $row[0];
                $rec->faculty_name = $row[1];
                $rec->faculty_mo = $row[2];
                $rec->email = $row[3];
               
                $rec->save();

            }
            fclose($handle);
    
            return redirect('/upload_csv')->with('success','File successfully uploaded to databse.');

        } else {
            return redirect('/upload_csv')->with('success','Error in File Upload!.');

        }
    }

    public function exportCsv()
    {
    
        $fileName = 'FacultyData.csv';

        $rec = add_faculty_model::get()->where('deleted', 0);

        // Set up CSV headers for the browser
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        // Create a callback to generate the CSV file
        $callback = function () use ($rec) {
            $file = fopen('php://output', 'w');

          
            fputcsv($file, ['Id','Code', 'Name', 'Mobile','Email']);

            
            foreach ($rec as $user) {
                fputcsv($file, [$user->f_id,$user->faculty_code, $user->faculty_name, $user->faculty_mo,$user->email]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

    }
        

}
