@include('partials/_header')

<div class="container mt-5">
    <div >
        @include('partials._alerts')
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highligh"><a href="{{route('create')}}" class="btn btn-primary" >Crear <i class="fa-solid fa-user-plus"></i></a></div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-user"></i> Nombre</th>
                        <th scope="col"><i class="fa-solid fa-at"></i> Email</th>
                        <th scope="col"><i class="fa-solid fa-venus-mars"></i> Sexo</th>
                        <th scope="col"><i class="fa-solid fa-toolbox"></i> Área</th>
                        <th scope="col"><i class="fa-solid fa-envelope"></i> Boletín</th>
                        <th scope="col">Modificar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($employees) && !empty($employees))
                        @foreach($employees as $employee)
                            <tr>
                                <td>{{$employee->nombre}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->sexo == 'F' ? 'Femenino': 'Masculino'}}</td>
                                <td>{{$employee->area}}</td>
                                <td>{{$employee->boletin == 1 ?'Si':'No'}}</td>
                                <td><a href="{{url('edit_employee/'.$employee->id)}}"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                <td><a href="{{url('delete_employee/'.$employee->id)}}"><i class="fa-solid fa-trash-can"></i></a></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>
    </div>
</div>
</body>
</html>
