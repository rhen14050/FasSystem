@extends('layouts.admin_layout')
{{-- @auth
  @if(Auth::user()->is_password_changed == 0)
    <script type="text/javascript">
      window.location = "{{ url('change_pass_view') }}";
    </script>
  @endif

  @if(Auth::user()->status == 2)
    <script type="text/javascript">
    window.location = "{{ url('login') }}";
    </script>
  @endif
@endauth --}}

@section('title', 'Dashboard')
@section('content_page')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1>Dashboard {{ ($_SESSION['fas_section']) }}</h1> --}}
                        {{-- <h1>Dashboard {{ json_encode($_SESSION) }}</h1> --}}
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-3 mt-2">
                        <div class="small-box text-white" style="background: linear-gradient(135deg, #6a82fb, #fc5c7d); border-radius: 8px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); transition: transform 0.3s;">
                            <div class="inner">
                                <h3 id="listOfFiles" style="font-size: 1.3em; border-bottom: 2px solid white; padding-bottom: 5px;">
                                    JO Request System
                                </h3>
                                <p id="completedJoRequestId" style="font-size: 1em; color: #d4edda;">Completed JO Request</p>
                                <p id="OngoingjoRequestId" style="font-size: 1em; color: #f8d7da;">Pending JO Request</p>
                            </div>
                            <div class="icon" style="color: white;">
                                <i class="ion ion-bag" style="font-size: 2em;"></i>
                            </div>
                            <a href="{{ route('jo_request') }}" class="small-box-footer" style="color: white;">
                                More info <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="col-md-3 mt-2">
                        <div class="small-box text-white" style="background-color: #4ad8f5">
                            <div class="inner">
                                <h3 id="listOfFiles"></h3>
                                <p>JO Request System</p>
                                <p id="completedJoRequestId">Completed JO Request</p>
                                <p id="OngoingjoRequestId">Ongoing JO Request</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('jo_request_dashboard') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}

                </div>
            </div>
        </section>
    </div>
@endsection

<!--     {{-- JS CONTENT --}} -->
@section('js_content')
<script type="text/javascript">
    $(document).ready(function() {
        function getOngoingJoRequest() {
            $.ajax({
                url: "get_ongoing_jo_request",
                method: "get",
                dataType: "json",
                success: function(response) {
                    let ongoingJoRequestCount = response['ongoingJoRequest'];
                    document.getElementById("OngoingjoRequestId").innerText += ` (${ongoingJoRequestCount})`;
                }
            });
        }

        function getCompletedJoRequest() {
            $.ajax({
                url: "get_completed_jo_request",
                method: "get",
                dataType: "json",
                success: function(response) {
                    let completedJoRequestCount = response['completedJoRequest'];
                    document.getElementById("completedJoRequestId").innerText += ` (${completedJoRequestCount})`;
                }
            });
        }

        // Call the functions
        getOngoingJoRequest();
        getCompletedJoRequest();

        // Add hover effect
        $('.small-box').hover(
            function() {
                $(this).css('transform', 'scale(1.05)');
            },
            function() {
                $(this).css('transform', 'scale(1)');
            }
        );
    });
</script>
@endsection
