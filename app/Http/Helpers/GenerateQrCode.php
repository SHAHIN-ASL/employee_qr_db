<?php

namespace App\Http\Helpers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQrCode {
    public static function generate($employee_id)
    {
        $file_path = public_path("storage/qrcode/".$employee_id.".png");

        try {
            QrCode::size(500)
            ->format('png')
            ->generate('http://employee.asl.aero/employee/verification/'.$employee_id , $file_path);
        } catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        $file_path = "qrcode/".$employee_id.".png";
        
        return $file_path;
        
    }
}