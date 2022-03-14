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
    <!--
                                                                                                <div class="card">
                                                                                                                                                                                        <div class="card-body">
                                                                                                                                                                                            <div class="row">
                                                                                                                                                                                                <div class="col-12">
                                                                                                                                                                                                   
                                                                                                                                                                                                </div>
                                                                                                                                                                                            </div>

                                                                                                                                                                                        </div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                -->
    <div id="meetingSDKElement"></div>
    <br>
    <div id="zmmtg-root" style="position: relative;right: 8px;display: block;margin-top: 62px;"></div>
    <br>
    <br>
    <div id="aria-notify-area"></div>




@endsection



@section('js')


    <script src="{{ asset('assets/js/lib/react.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/react-dom.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/redux.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/redux-thunk.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/lodash.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/zoom-meeting-2.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/zoom-meeting-embedded-2.1.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/tool.js') }}"></script>
    <script src="{{ asset('assets/js/vconsole.min.js') }}"></script>
    <script src="assets/js/tool.js"></script>
    <script src="assets/js/vconsole.min.js"></script>
    <script src="assets/js/meeting.js"></script>


    <script>
        document.getElementById("side-menu").style.display = "none";
        document.getElementById("menu-button").style.display = "none";
        document.getElementById("zmmtg-root").style.top = "70px";
    </script>

    <script>
        var meetingNumber = 0;
        var signature = '';

        $.ajax({
            type: "POST",
            url: "https://demo.adexcloud.dz/api/zoommeeting/1",
            success: function(res) {
                if (res) {
                    console.log(res);
                    result = JSON.parse(res);

                    meetingNumber = result['meeting_id'];
                    signature = result['signature'];
                    password = result['password'];
                    ZoomMtg.preLoadWasm();
                    ZoomMtg.prepareWebSDK();
                    ZoomMtg.i18n.load('fr-FR');
                    ZoomMtg.i18n.reload('fr-FR');
                    ZoomMtg.setZoomJSLib('https://source.zoom.us/2.1.1/lib', '/av');

                    const client = ZoomMtgEmbedded.createClient();
                    let meetingSDKElement = document.getElementById('zmmtg-root');

                    client.init({
                        debug: true,
                        zoomAppRoot: meetingSDKElement,
                        language: 'en-US',
                        customize: {
                            meetingInfo: ['topic', 'host', 'mn', 'pwd', 'telPwd', 'invite',
                                'participant', 'dc', 'enctype'
                            ],
                            toolbar: {
                                buttons: [{
                                    text: 'Custom Button',
                                    className: 'CustomButton',
                                    onClick: () => {
                                        console.log('custom button');
                                    }
                                }]
                            }
                        }
                    });

                    /*
                    xhttp.open("GET", "http://localhost/siggen.php?role=1&mn=98964723608",false);
                    */

                    client.join({
                        apiKey: "XiTA_uUqToafY8cefEIedQ",
                        signature: signature,
                        meetingNumber: meetingNumber,
                        password: password,
                        userName: "Alliance assurances"
                    })





                }


            },
            error: function(e) {
                console.log(e)
            }
        });
    </script>


@endsection
