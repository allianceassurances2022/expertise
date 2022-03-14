@extends('default')

@section('head_title')
Dashboard
@endsection

@section('title')
Dashboard
@endsection

@section('head')
	{{-- <link href="{{asset('assets/plugins/c3/c3.min.css')}}" rel="stylesheet" type="text/css" /> --}}
	{{-- <link href="{{asset('assets/plugins/chartist/css/chartist.min.css')}}" rel="stylesheet" type="text/css" /> --}}

    <style>
        #chartdiv {
  width: 100%;
  height: 50vh;
}
        </style>

@endsection

@section('content')

<div class="row">

	<div class="col-xl-12">
		{{-- <div class="card m-b-30"> --}}
			<div class="card-body">

				<h4 class="mt-0 header-title">Répartition Expertise par status</h4>

                <div class="row">

                    <div class="col-lg-3 col-md-4">
                        <a href="{{route('detail_ods')}}">
                        <div class="card-counter secondary">
                            <i class="fa fa-plus-square-o"></i>
                            <span class="count-numbers">{{$nouveau}}</span>
                            <span class="count-name">Nouveau</span>
                         </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <a href="{{route('detail','1')}}">
                        <div class="card-counter info">
                            <i class="fa fa-spin fa-spinner"></i>
                            <span class="count-numbers">{{$draft}}</span>
                            <span class="count-name">En cours d'expertise</span>
                         </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <a href="{{route('detail','2')}}">
                        <div class="card-counter danger">
                            <i class="fa fa-spin fa-cog"></i>
                            <span class="count-numbers">{{$valide}}</span>
                            <span class="count-name">Expertise pre-validée</span>
                         </div>
                        </a>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <a href="{{route('detail','3')}}">
                        <div class="card-counter primary">
                            <i class="fa fa-check"></i>
                            <span class="count-numbers">{{$finalise}}</span>
                            <span class="count-name">Expertise validée</span>
                         </div>
                        </a>
                    </div>


                </div>

				{{-- <div id="donut" style="height: 300px"></div> --}}

			</div>
		{{-- </div> --}}
	</div> <!-- end col -->
</div> <!-- end row -->

<div class="row justify-content-md-center">

    <div class="col-xl-6">
        <div class="card m-b-30">
            <div class="card-body">

                <div id="chartdiv"></div>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@section('js')

{{-- <script src="{{asset('assets/plugins/d3/d3.min.js')}}" ></script>
<script src="{{asset('assets/plugins/c3/c3.min.js')}}" ></script>
<script src="{{asset('assets/pages/c3-chart-init.js')}}" ></script> --}}


{{-- <script src="{{asset('assets/plugins/chartist/js/chartist.min.js')}}" ></script>
<script src="{{asset('assets/plugins/chartist/js/chartist-plugin-tooltip.min.js')}}" ></script>
<script src="{{asset('assets/pages/chartist.init.js')}}" ></script> --}}

<script src="{{asset('assets/plugins/select2/js/select2.js')}}" ></script>

<script src="{{asset('assets/js/core.js')}}" ></script>
<script src="{{asset('assets/js/charts.js')}}" ></script>
<script src="{{asset('assets/js/material.js')}}"></script>
<script src="{{asset('assets/js/animated.js')}}" ></script>





<script>



am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_material);
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.PieChart3D);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.legend = new am4charts.Legend();

chart.data = [
  {
    name: "Nouveaux expertises",
    value: {{$nouveau}}
  },
  {
    name: "En cours d'expertise",
    value: {{$draft}}
  },
  {
    name: "Expertise pre-validée",
    value: {{$valide}}
  },
  {
    name: "Expertise validée",
    value: {{$finalise}}
  }
];

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "value";
series.dataFields.category = "name";

}); // end am4core.ready()

    </script>
@endsection

