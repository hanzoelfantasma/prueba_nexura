@if(isset($employeeInfo->id))
<div class="mb-3 row">
    <label for="name" class="col-sm-2 col-form-label">Id Empleado</label>
    <div class="col-sm-10">
        <input type="text"
               class="form-control"
               id="employeeId"
               name="employeeId"
               value="{{$employeeInfo->id ?? old('employeeId')}}"
               readonly>
    </div>
</div>
@endif
<div class="mb-3 row">
    <label for="name" class="col-sm-2 col-form-label">Nombre Completo *</label>
    <div class="col-sm-10">
        <input type="text"
               class="form-control @error('name') is-invalid @enderror"
               id="name"
               name="name"
               value="{{$employeeInfo->nombre ?? old('name')}}"
               placeholder="Nombre completo del empleado"
               required>
    </div>
</div>
<div class="mb-3 row">
    <label for="email" class="col-sm-2 col-form-label">Email *</label>
    <div class="col-sm-10">
        <input type="email"
               class="form-control @error('email') is-invalid @enderror"
               name="email"
               id="email"
               value="{{$employeeInfo->email ?? old('email')}}"
               placeholder="Correo electrónico"
               required>
    </div>
</div>
<div class="mb-3 row">
    <label for="gender" class="col-sm-2 col-form-label">Sexo *</label>
    <div class="col-sm-10">
        <div class="form-check">
            <input class="form-check-input @error('gender') is-invalid @enderror"
                   type="radio"
                   name="gender"
                   value="M"
                   {{ isset($employeeInfo->sexo) ? $employeeInfo->sexo =='M' ? 'checked':'' : ''  }}
                   required>
            <label class="form-check-label">
                Másculino
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input @error('gender') is-invalid @enderror"
                   type="radio"
                   name="gender"
                   {{ isset($employeeInfo->sexo) ? $employeeInfo->sexo =='F' ? 'checked':'' : ''  }}
                   value="F">
            <label class="form-check-label">
                Femenino
            </label>
        </div>
    </div>
</div>

<div class="mb-3 row">
    <label for="area" class="col-sm-2 col-form-label">Área *</label>
    <div class="col-sm-10">
        <select class="form-select @error('area') is-invalid @enderror" aria-label="Default select example" name="area" id="area">
            @if(isset($areaList) & !empty($areaList))
                @foreach($areaList as $area)
                    <option value="{{$area->id}}" {{isset($employeeInfo->area_id) ? $employeeInfo->area_id == $area->id ? 'selected=true' : '' : ''}}">{{$area->nombre}}</option>
                @endforeach
            @endif
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label for="description" class="col-sm-2 col-form-label">Descripción *</label>
    <div class="col-sm-10">
                    <textarea placeholder="Descripción de la experiencia del empleado"
                              class="form-control @error('description') is-invalid @enderror"
                              id="description"
                              rows="3"
                              name="description"
                              required>{{$employeeInfo->descripcion ?? old('description')}}</textarea>
    </div>
</div>
<div class="mb-3 row">
    <label for="description" class="col-sm-2 col-form-label"></label>
    <div class="col-sm-10 form-check">
        <input class="form-check-input "
               type="checkbox"
               value="1"
               name="news"
               id="news"
            {{ isset($employeeInfo->boletin ) ? $employeeInfo->boletin == 1 ? 'checked':'': old('news')}} >
        <label class="form-check-label" for="news">
            Deseo recibir boletín informativo
        </label>
    </div>
</div>
<div class="mb-3 row">
    <label for="roles" class="col-sm-2 col-form-label">Roles *</label>
    <div class="col-sm-10">
        @if(isset($roleList) & !empty($roleList))
            @foreach($roleList as $role)
                <div class="form-check">
                    <input class="form-check-input @error('roles') is-invalid @enderror"
                           type="checkbox"
                           value="{{$role->id}}"
                           name="roles[]"
                           @if(isset($employeeInfo->roles_info))
                               @foreach($employeeInfo->roles_info as $roleInf)
                               {{$roleInf->rol_id == $role->id ? 'checked':''}}
                               @endforeach
                           @endif
                           >
                    <label class="form-check-label">
                        {{$role->nombre}}
                    </label>
                </div>
            @endforeach
        @endif
    </div>
</div>
<button type="submit" class="btn btn-primary mt-3" >{{$buttonName}}</button>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    (function () {


        let dataForm = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(dataForm)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity() && validateCheckBox()!=true ) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    function validateCheckBox(){
        let roles=document.getElementsByName('roles[]')
        let rolesChecked=false
        roles.forEach(element =>{
            element.checked===true ? rolesChecked = true : false
        })
        if(rolesChecked == false){
            roles.forEach(element =>{
                element.classList.add('is-invalid')
            })
        }
        return rolesChecked
    }
</script>
