@extends('default')

@section('head_title')
    Zoom meeting
@endsection

@section('title')
    Zoom meeting
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
    <div>
        <input type="text" name="meetingNum" id="meetingNum" value="{{ $meetingNum }} ">
        <input type="text" name="signature" id="signature" value="{{ $signature }} ">
        <input type="text" name="password" id="password" value="{{ $password }} ">
    </div>
@endsection

@section('js')
    <script>
        $meetingNumber = document.getElementById("meetingNum").value;
        $signature = document.getElementById("signature").value;
        $password = document.getElementById("password").value;

        console.log($meetingNumber);
        console.log($signature);
        console.log($password);
    </script>
@endsection
