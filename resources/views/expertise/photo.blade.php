@extends('default')

@section('head_title')
    Photo
@endsection

@section('title')
    Photo
@endsection


@section('head')
    <!-- Dropzone css -->
    <link href="{{ asset('assets/plugins/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css">
    <style>
        img.illustration {
            width: 25%;
            margin: auto;
            margin-bottom: 15px;
        }

        button {
            font-size: 15px;
            text-transform: uppercase;
            font-weight: bold;
        }

    </style>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <p style="margin-top: 9px; margin-bottom: 9px;"> ODS N°: {{ $ods->num_ods }} </p>
                </div>
                <div class="col-sm-6">
                    <p style="margin-top: 9px; margin-bottom: 9px;"> Dossier N°: {{ $ods->ref_sinistre }} </p>
                </div>
            </div>
        </div>
    </div>

    </br>

    @if ($expertise->status == '1')

        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-body">

                        <div class="m-b-30">
                            <form method="POST" action="{{ Route('expertiseImagePost') }}" enctype="multipart/form-data"
                                class="dropzone" id="dropzone">
                                @csrf
                                <input type="hidden" id="title" name="title" value="Photo" class="form-control" required>
                                <input type="hidden" name="id" value="{{ $expertise->id }}">
                                <div class="dz-default dz-message">
                                    <h4>Drop files here or click to upload Using Dropzone</h4>
                                </div>
                            </form>
                        </div>

                        {{-- <div class="text-center m-t-15">
                    <button type="button" class="btn btn-primary waves-effect waves-light">Envoyer les fichiers</button>
                </div> --}}
                        <form method="POST" action="{{ Route('expertiseMeeting') }}" id="zoomzone">
                            @csrf

                            <div class="text-center m-t-15">
                                <input type="hidden" name="id" value="{{ $expertise->id }}">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Lien zoom</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

        </br>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-responsive table-hover display responsive nowrap">
                        <thead>
                            <tr>
                                <th>Identifiant de la photo</th>
                                <th>Date d'insertion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($photos as $photo)
                                <tr>
                                    <td>{{ $photo->id }}</td>
                                    <td>{{ $photo->created_at }}</td>
                                    <td>
                                        <!-- Changed from `hidden` to `auto`. -->
                                        <div style="overflow:auto;">
                                            <!-- This is the div that does the trick: -->
                                            <div style="width:100px;">
                                                <div style="display:inline-block;">
                                                    <a href="{{ url('storage/files') . '/' . $photo->file }}"
                                                        target="_blank">
                                                        <i class="typcn typcn-eye-outline"></i>
                                                    </a>
                                                </div>
                                                <div style="display:inline-block;">
                                                    <a href="{{ route('fileDownload', $photo->id) }}">
                                                        <i class="typcn typcn-download"></i>
                                                    </a>
                                                </div>

                                                @if ($expertise->status == '1')
                                                    <div style="display:inline-block;">
                                                        <form name="supression_photo"
                                                            action="{{ route('expertiseImageDelete', $photo->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer?')">
                                                            @csrf
                                                            <button type="submit" title="Supprimer"
                                                                class="btn btn-sm btn-danger" style="padding-top: 0px;
                                                                                    padding-bottom: 8px;
                                                                                    padding-right: 0px;
                                                                                    padding-left: 0px;">
                                                                <i class="typcn typcn-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 text-right ">
                    <a href="{{ route('expertise.show', $expertise->id) }}"
                        class="col-sm-2 btn btn-default btn-block btn-secondary text-center" id="btnChocRetour">Retour</a>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')
    <script src="{{ asset('assets/plugins/dropzone/dist/dropzone.js') }}"></script>
    <script>
        Dropzone.options.dropzone = {
            maxFiles: {{ $nbr_max }},
            maxFilesize: {{ $taille_max }},
            //~ renameFile: function(file) {
            //~ var dt = new Date();
            //~ var time = dt.getTime();
            //~ return time+"-"+file.name;    // to rename file name but i didn't use it. i renamed file with php in controller.
            //~ },
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: true,
            timeout: 50000,
            init: function() {

                // Get images
                var myDropzone = this;
                $.ajax({
                    url: gallery,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        $.each(data, function(key, value) {

                            var file = {
                                name: value.name,
                                size: value.size
                            };
                            myDropzone.options.addedfile.call(myDropzone, file);
                            myDropzone.options.thumbnail.call(myDropzone, file, value.path);
                            myDropzone.emit("complete", file);
                        });
                    }
                });
            },
            removedfile: function(file) {
                if (this.options.dictRemoveFile) {
                    return Dropzone.confirm("Êtes-vous sûr de " + this.options.dictRemoveFile, function() {
                        if (file.previewElement.id != "") {
                            var name = file.previewElement.id;
                        } else {
                            var name = file.name;
                        }
                        //console.log(name);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST',
                            url: '{{ route('destroyImage') }}',
                            data: {
                                filename: name,
                                '_token': function() {
                                    return $('input[name="_token"]').val();
                                },
                            },
                            success: function(data) {
                                alert(data.success +
                                    " Le fichier a été supprimé avec succès !");
                            },
                            error: function(e) {
                                console.log(e);
                            }
                        });
                        var fileRef;
                        return (fileRef = file.previewElement) != null ?
                            fileRef.parentNode.removeChild(file.previewElement) : void 0;
                    });
                }
            },

            success: function(file, response) {
                file.previewElement.id = response.success;
                // console.log(file);
                // set new images names in dropzone’s preview box.
                var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
                file.previewElement.querySelector("img").alt = response.success;
                olddatadzname.innerHTML = response.success;
            },
            error: function(file, response) {
                if ($.type(response) === "string")
                    var message = response; //dropzone sends it's own error messages in string
                else
                    var message = response.message;
                file.previewElement.classList.add("dz-error");
                _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
                _results = [];
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i];
                    _results.push(node.textContent = message);
                }
                return _results;
            }

        };
    </script>
@endsection
