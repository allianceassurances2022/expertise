@if ($errors->any())
    <div class="alert alert-danger">
        <h4><i class="icon fa fa-warning"></i> Erreur !</h4>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> OK!</h4>
                {{ session()->get('success') }}
            </div>
        </div>
    </div>
@endif