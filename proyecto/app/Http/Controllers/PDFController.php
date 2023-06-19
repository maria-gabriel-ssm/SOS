<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Models\Orden;
use App\Models\Conferencia;
use App\Models\Area;
use App\Models\User;
use App\Models\Admin;
use App\Models\Tarea;
use App\Models\Equipo;
use App\Models\Seguimiento;
use App\Models\Custom;

class PDFController extends Controller
{
    //
    public function generatePDF(Orden $orden)
    {
        $comen = "";
        $comentarios = Seguimiento::where('id_orden', $orden->id)->get();
        foreach ($comentarios as $key => $comentario) {
            if(substr($comentario->comentario, -1)!="."){
                    $comentario->comentario = $comentario->comentario.".";
                }
            if($comen==""){
                $comen = $comentario->comentario;
            }else{
                $comen = $comen.' '.$comentario->comentario;
            }
        }
        $sup = Admin::where('id', $orden->id_admin)->get()->last();
        $hoy = Carbon::now();
        setlocale(LC_ALL, 'es_ES');
        $fecha = Carbon::parse($hoy);
        $mes = $fecha->formatLocalized('%B');
        $anio = $fecha->format('Y');
        $dia = $fecha->format('d');
        $final = $dia.' '.$mes.', '.$anio;

        $data = [
            'folio' => 'PDF Ejemplo',
            'date' => $final        ];
          
        $path = 'image/ssm_logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf = PDF::loadView('pdf', compact('data', 'orden', 'sup','comen','logo'));
        
        return $pdf->stream('Ejemplo.pdf');
    }

    public function generatePDF_Conf(Conferencia $conferencia)
    {
        $hoy = Carbon::now();
        setlocale(LC_ALL, 'es_ES');
        $fecha = Carbon::parse($hoy);
        $mes = $fecha->formatLocalized('%B');
        $anio = $fecha->format('Y');
        $dia = $fecha->format('d');
        $final = $dia.' '.$mes.', '.$anio;

        $data = [
            'folio' => 'PDF Ejemplo',
            'date' => $final        ];
          
        $path = 'image/ssm_logo.png';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $logo = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $pdf = PDF::loadView('pdf_conf', compact('data', 'conferencia','logo'));
        
        return $pdf->stream('Ejemplo.pdf');
    }
}
