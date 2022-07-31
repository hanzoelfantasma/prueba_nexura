<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Empleado;
use App\Models\EmpleadoRol;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class employeeController extends Controller
{
    private $areaList;
    private $roleList;
    public function  index(){
        try {
            $employees=DB::table('empleados')
                ->join('areas','empleados.area_id','=','areas.id')
                ->select(
                    'empleados.id',
                    'empleados.nombre',
                    'empleados.email',
                    'empleados.sexo',
                    'empleados.boletin',
                    'areas.nombre as area')
                ->get();
            return view('employees/list',compact('employees'));
        }catch (Exception $exception){
            return view('employees/list',['error'=>$exception->getMessage()]);
        }catch (\Illuminate\Database\QueryException $exq){
            return view('employees/list',['error'=>$exq->getMessage()]);
        }
    }

    public function create(){
        $this->setAreas();
        return view('employees/create',
            [
                'areaList'=>$this->areaList,
                'roleList'=>$this->roleList
            ]);

    }

    public function delete($id){
        if(empty(Empleado::find($id))){
            return redirect('/')->with('error','El usuario que intenta eliminar no existe, por favor verifique');
        }
        try {
            $EmployeeRole= new roleEmployeeController();
            $EmployeeRole->delete($id);
            Empleado::destroy($id);

            return redirect('/')->with('status','Usuario eliminado');
        }catch (Exception $exception){
            return redirect('/')->with('error',$exception->getMessage());
        }catch (\Illuminate\Database\QueryException $ex){
            return redirect('/')->with('error',$ex->getMessage());
        }


    }


    public function store(Request $request){
        $this->validateEmployeeData($request);

        try {
            $employee= new Empleado();
            $employee->nombre=$request->name;
            $employee->email=$request->email;
            $employee->sexo=$request->gender;
            $employee->area_id=$request->area;
            $employee->descripcion=$request->description;
            $employee->boletin=$request->has('news')?$request->news:0;
            $employee->save();

            foreach ($request->roles as $roles){
                $roleEmployee= new EmpleadoRol();
                $roleEmployee->empleado_id=$employee->id;
                $roleEmployee->rol_id=$roles;
                $roleEmployee->save();
            }

            return redirect('/')->with('status','Empleado creado');


        }catch (Exception $exception){
            return redirect('/')->with('error',$exception->getMessage());
        }catch (\Illuminate\Database\QueryException $ex){
            return redirect('/')->with('error',$ex->getMessage());
        }
    }

    public function edit($id){
        if(!empty($id) && $id>0){
            try {
                $employeeInfo=Empleado::findOrFail($id);
                $roles=DB::table('empleado_rol')
                    ->join('roles','empleado_rol.rol_id','roles.id')
                    ->select('empleado_rol.*','roles.nombre')
                    ->where('empleado_rol.empleado_id',$id)
                    ->get();
                $employeeInfo->roles_info=$roles;
                $this->setAreas();
                return view('employees/edit',
                    [
                        'employeeInfo'=>$employeeInfo,
                        'areaList'=>$this->areaList,
                        'roleList'=>$this->roleList
                    ]);
            }catch (Exception $exception){
                return redirect('/')->with('error',$exception->getMessage());
            }catch (\Illuminate\Database\QueryException $ex){
                return redirect('/')->with('error',$ex->getMessage());
            }

        }
        return redirect('/')->with('error','El usuario no existe, por favor verique');

    }

    public function update(Request $request){
        $this->validateEmployeeData($request);
        try {
            $oldEmployee=Empleado::findOrFail($request->employeeId);

            $oldEmployee->nombre=$request->name;
            $oldEmployee->email=$request->email;
            $oldEmployee->sexo=$request->gender;
            $oldEmployee->area_id=$request->area;
            $oldEmployee->descripcion=$request->description;
            $oldEmployee->boletin=$request->has('news')?$request->news:0;
            $oldEmployee->save();

            $EmployeeRoles=new roleEmployeeController();
            $EmployeeRoles->deleteEmployeeRole($request->roles,$request->employeeId);

            foreach ($request->roles as $roles){
                $roleEmployee=EmpleadoRol::select('rol_id')
                    ->where('rol_id',$roles)
                    ->where('empleado_id',$request->employeeId)
                    ->get();
                if($roleEmployee->isEmpty()){
                    EmpleadoRol::create([
                        'empleado_id'=>$request->employeeId,
                        'rol_id'=>$roles
                    ]);
                }
            }

            return redirect('/')->with('status','Usuario actualizado');

        }catch (Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }catch (\Illuminate\Database\QueryException $ex){
            return redirect()->back()->with('error',$ex->getMessage());
        }
    }

    private function setAreas(){
        $this->areaList=Area::all();
        $this->roleList=Role::all();
    }

    private function validateEmployeeData($employeeData){
        $employeeData->validate([
            'name'=>'required',
            'email'=>'required|email',
            'gender'=>'required',
            'area'=>'required|integer',
            'description'=>'required',
            'roles'=>'required'
        ]);

    }

}
