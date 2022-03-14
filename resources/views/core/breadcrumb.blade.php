<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
               @if(!empty($breadcrumb_lis ))
                @foreach( $breadcrumb_lis as $breadcrumb_li)
                @if(!$breadcrumb_li['id'])
                <li class="breadcrumb-item"><a href="{{ route($breadcrumb_li['url']) }}">
                {{$breadcrumb_li['title']}}</a></li>
                @endif
                @if($breadcrumb_li['id'])
                <li class="breadcrumb-item"><a href="{{ route($breadcrumb_li['url'],$breadcrumb_li['id']) }}">
                {{$breadcrumb_li['title']}}</a></li>
                @endif

                @endforeach
                @endif
            </ol>
        </div>
        <h5 class="page-title">@yield('title')</h5>
    </div>
</div>
<!-- end row -->