@extends('default')

@section('content')
    <form method="POST" action="{{ Route('expertiseMeeting') }}" id="zoomzone">
        @csrf

        <div class="text-center m-t-15">
            <input type="hidden" name="id" value="1">
            <button type="submit" class="btn btn-primary waves-effect waves-light">Lien zoom</button>
        </div>
    </form>
@endsection
