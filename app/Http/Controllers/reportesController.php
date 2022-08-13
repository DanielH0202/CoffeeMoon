<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPJasper\PHPJasper;

class reportesController extends Controller
{
    public function compilarReporte()
    {
        $input = 'C:\Users\52556\JaspersoftWorkspace\MyReports\ReporteAlimentos.jrxml';

        $jasper = new PHPJasper;
        $jasper->compile($input)->execute();
        return "Compilacion Exitosa!";
    }

    public function ejecutarReporte()
    {
        $input = base_path().'\vendor\geekcom\phpjasper-laravel\reportes\ReporteAlimentos.jasper';
        $output = base_path().'\vendor\geekcom\phpjasper-laravel\reportes/';

        $jdbc_dir = base_path() .'\vendor\geekcom\phpjasper-laravel\bin\jasperstarter\jdbc';

        
        $options = [
            'format' => ['pdf'],
            'params' => [],
            'db_connection' => [
                'driver' => 'generic',
                'host' => env('DB_HOST'),
                'port' => env('DB_PORT'),
                'database' => env('DB_DATABASE'),
                'username' => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
                'jdbc_driver' => 'com.microsoft.sqlserver.jdbc.SQLServerDriver',
                'jdbc_url' => 'jdbc:sqlserver://' . env('DB_HOST') . ':' . env('DB_PORT') . ';databaseName=' . env('DB_DATABASE'),
              'jdbc_dir' => $jdbc_dir
            ]
        ];

        $jasper = new PHPJasper;

        $jasper->process(
            $input,
            $output,
            $options
        )->execute();

        return response()->file($output . 'ReporteAlimentos.pdf');
        
    }
}
