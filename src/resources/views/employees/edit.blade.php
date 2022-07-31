@include('partials/_header')

<div class="container mt-5">
    <div>
        @include('partials._alerts')
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                Por favor verifique, los campos con asteriscos (*) son obligatorios
            </div>
        @endif
            <form method="POST" action="{{route('update')}}" class="needs-validation" novalidate>
                @csrf
                @include('employees/partials/_form',['buttonName'=>'Actualizar','employeeInfo'=>$employeeInfo])
            </form>
    </div>
</div>
</body>
</div>
</div>
</body>
</html>
