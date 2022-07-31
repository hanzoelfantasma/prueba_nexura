@include('partials/_header')
<div class="container mt-5">
    <div>
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
            Por favor verifique, los campos con asteriscos (*) son obligatorios
        </div>
        @endif

        <form method="POST" action="{{route('store')}}" class="needs-validation" novalidate>
            @csrf
            @include('employees/partials/_form',['buttonName'=>'Crear'])
        </form>
    </div>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    (function () {


        let dataForm = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(dataForm)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>


</body>
</div>
</div>
</body>
</html>
