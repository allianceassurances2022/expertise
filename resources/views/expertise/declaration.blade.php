@extends('default')

@section('head_title')
Déclaration sinistre
@endsection

@section('title')
Déclaration sinistre
@endsection


@section('head')
<!-- Dropzone css -->
{{-- <link href="{{asset('assets/plugins/dropzone/dist/dropzone.css')}}" rel="stylesheet" type="text/css"> --}}
	<style>
		img.illustration{
			width: 25%;
			margin: auto;
			margin-bottom: 15px;
		}
		button{
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

@if(auth()->user()->hasAnyPermission(['edit declaration']))

@if($statu_ods->id_status != 5)
        <div class="card">
            <div class="card-body">
                <form name="ajout_honoraire" action="{{route('expertiseDeclarationPost')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                <div class="row">

                        {{-- <div class="col-sm-5" style="margin-top:-6px;">
                            <label for="titre" class="col-form-label">Titre:  <samp class="float-right text-danger" >*</samp></label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div> --}}

                        <div class="col-sm-10" style="margin-top:-6px;">
                            <label for="lieu" class="col-form-label" id="libnbr">Déclaration :  <samp class="float-right text-danger" >*</samp></label>
                                <input type="file" id="file" name="image" accept="application/pdf,image/*" class="form-control" required>
                        </div>

                        <input type="hidden" id="title" name="title" value="Declaration" class="form-control" required>

                        <div class="col-sm-2 text-right">
                            <div class="form-group">
                                <br>
                                <input type="hidden" name="id" value="{{$ods->id}}">
                                <input id="btn_ajouter" class="btn btn-success btn-block text-center" type="submit" value="Ajouter" style="margin-top: 8px;">
                            </div>
                        </div>

                </div>
                </form>
            </div>
        </div>

        @endif

        @endif

        </br>

<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-responsive table-hover display responsive nowrap">
					<thead>
						<tr>
							<th>ID</th>
							<th>Date d'insertion</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                        @foreach ($declarations as $declaration)
						<tr>
							<td>{{$declaration->id}}</td>
							<td>{{$declaration->created_at}}</td>
							<td>
                                <!-- Changed from `hidden` to `auto`. -->
                                <div style="overflow:auto;">
                                    <!-- This is the div that does the trick: -->
                                    <div style="width:100px;">

                                    <div style="display:inline-block;">
                                        <a href="{{url('storage/declaration_files').'/'.$declaration->file}}" target="_blank">
                                            <i class="typcn typcn-eye-outline"></i>
                                        </a>
                                    </div>
                                    <div style="display:inline-block;">
                                        <a href="{{route('fileDownloadDeclaration',$declaration->id)}}">
                                        <i class="typcn typcn-download"></i>
                                        </a>
                                    </div>

                                    @if ($statu_ods)
                                        @if($statu_ods->id_status != 5)
                                    <div style="display:inline-block;">
                                        <form name="supression_photo" action="{{route('expertiseDeclarationDelete',$declaration->id)}}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer?')">
                                        @csrf
                                        <button type="submit" title="Supprimer" class="btn btn-sm btn-danger"
                                        style="padding-top: 0px;
                                        padding-bottom: 8px;
                                        padding-right: 0px;
                                        padding-left: 0px;">
                                            <i class="typcn typcn-trash"></i>
                                        </button>
                                        </form>
                                    </div>
                                        @endif
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
				<a href="{{route('expertise.liste')}}" class="col-sm-2 btn btn-default btn-block btn-secondary text-center" id="btnChocRetour">Retour</a>
			</div>
		</div>
    </div>
</div>



@endsection

