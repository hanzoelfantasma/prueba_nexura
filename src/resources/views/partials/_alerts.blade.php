@if (session('status'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <span>
            {{ session('status') }}
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    {{--<div class="alert alert-success">
        {{ session('status') }}
    </div>--}}
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span>
              {{ session('error') }}
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
