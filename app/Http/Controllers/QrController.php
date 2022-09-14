<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class QrController extends Controller
{
    public function download($id)
    {
        $employee = Employee::find($id);
        $qrpath = public_path("/storage/".$employee->qrimage);
        $filename = $employee->employee_id.".png";

        if (file_exists($qrpath))
        {
            return Response::download($qrpath, $filename, [
                'Content-Length: '. filesize($qrpath)
            ]);
        }
        else
        {
            // Error
            exit('Requested file does not exist on our server!');
        }


    }
}
