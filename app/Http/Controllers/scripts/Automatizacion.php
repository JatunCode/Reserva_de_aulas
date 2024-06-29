<?php

namespace App\Http\Controllers\scripts;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ambiente;
use App\Models\Docente\Solicitud;
use Illuminate\Support\Facades\Date;

class Automatizacion extends Controller
{
    /**
     * Actualiza todas las solicitudes al tener un horario pasado de la hora actual
     * @return 
     */
    public function updateAll(){

        $ambientes = Ambiente::all(['ID_AMBIENTE']);
        $solicitudes_de_esta_semana = [];
        $fecha_actual = strtotime(Date::now());
        if(Date::now()->format('H:i:s') == '06:00:00' || Date::now()->format('H:i:s') == '18:00:00'){
            $this->updateAntiguos();
        }else{
            $this->actualizarPorHora($ambientes, $fecha_actual);
            $this->actualizarUrgente();
        }
        
        return $solicitudes_de_esta_semana;
    }
    
    private function actualizarSolicitudes(){
        return Solicitud::where('ESTADO', 'PENDIENTE')->orderBy('FECHAHORA_SOLI', 'asc')->get();
    }

    private function actualizarPorHora($ambientes, $fecha_actual){
        $solicitudes = $this->actualizarSolicitudes();
        $solicitud_first = $solicitudes->first();
        foreach ($ambientes as $ambiente) {
            $solicitudes_de_esta_semana = [];
            foreach($solicitudes as $solicitud){
                $hora_reserva = $solicitud['FECHA_RE'];
                if( strtotime($hora_reserva) >= $fecha_actual-864000 && 
                    strtotime($hora_reserva) <= $fecha_actual && 
                    $solicitud['ID_AMBIENTE'] == $ambiente &&
                    $solicitud_first['ID_MATERIA'] == $solicitud['ID_MATERIA'] &&
                    $solicitud_first['HORAINI'] == $solicitud['HORAINI']
                ){
                    $solicitudes_de_esta_semana[] = $solicitud;
                }
            }
    
            $i = 0;
            foreach ($solicitudes_de_esta_semana as $solicitud) {
                if($i > 0){
                    $solicitud->update(['ESTADO' => 'CANCELADO']);
                }else{
                    $solicitud->update(['ESTADO' => 'ACEPTADO']);
                }
                $i += 1;
            }
        }
    }

    private function updateAntiguos(){
        $solicitdes = Solicitud::where('ESTADO', 'PENDIENTE')->where('FECHA_RE', '<', Date::now()->format('Y-m-d H:i'))->get();
        foreach ($solicitdes as $solicitd) {
            $solicitd->update(['ESTADO' => 'CANCELADO']);
        }
        return ;
    }

    private function actualizarUrgente(){

        $solicitudes = Solicitud::where('PRIORIDAD', 'LIKE', "%NORMAL%")
                                  ->where('FECHA_RE', '<=', Date::now()->addDays(1)->format('Y-m-d'))
                                  ->where('FECHA_RE', '>=', Date::now()->format('Y-m-d'))->get();
        
        foreach ($solicitudes as $solicitud) {
            $objeto_urgente = json_encode([
                'URGENTE' => $solicitud['MOTIVO']
            ]);
            $solicitud->update(['PRIORIDAD' => $objeto_urgente]);
        }
    }
}
