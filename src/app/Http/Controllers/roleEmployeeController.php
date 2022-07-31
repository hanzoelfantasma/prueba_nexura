<?php

namespace App\Http\Controllers;

use App\Models\EmpleadoRol;
use Illuminate\Http\Request;

class roleEmployeeController extends Controller
{
    public function delete($employeeId){
        EmpleadoRol::where('empleado_id',$employeeId)->delete();
    }

    public function deleteEmployeeRole($rolesId,$employeeId){
        $rolesToDelete=EmpleadoRol::select('rol_id','empleado_id')
            ->where('empleado_id',$employeeId)
            ->whereNotIn('rol_id',$rolesId)
            ->get();
        if(!$rolesToDelete->isEmpty()){
            foreach ($rolesToDelete as $rlDelete){
                EmpleadoRol::where('rol_id',$rlDelete->rol_id)->delete();
            }
        }
    }
}
