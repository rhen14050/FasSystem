@extends('layouts.admin_layout')

@section('title', 'Dashboard')
@section('content_page')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
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
                        <div class="small-box text-white" style="background-color: #01f722">
                            <div class="inner">
                                {{-- <h3 id="listOfFiles"></h3> --}}
                                {{-- <p>Completed JO Request</p> --}}
                                <p id="completedJoRequestId">Completed JO Request</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('jo_request') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-md-3 mt-2">
                        <div class="small-box text-white" style="background-color: #4ad8f5">
                            <div class="inner">
                                {{-- <h3 id="listOfFiles"></h3> --}}
                                <p id="OngoingjoRequestId">Ongoing JO Request</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('jo_request') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

<!--     {{-- JS CONTENT --}} -->
@section('js_content')
<script type="text/javascript">
    $(document).ready(function(){
        function getOngoingJoRequest(){
            $.ajax({
                url: "get_ongoing_jo_request",
                method: "get",
                dataType: "json",
                success: function (response) {
                    let ongoingJoRequestCount = response['ongoingJoRequest'];
                    document.getElementById("OngoingjoRequestId").innerText += ` (${ongoingJoRequestCount})`;
                }
            });
        }
        getOngoingJoRequest();

        function getCompletedJoRequest(){
            $.ajax({
                url: "get_completed_jo_request",
                method: "get",
                dataType: "json",
                success: function (response) {
                    let completedJoRequestCount = response['completedJoRequest'];
                    document.getElementById("completedJoRequestId").innerText += ` (${completedJoRequestCount})`;
                }
            });
        }
        getCompletedJoRequest();
    });

</script>

@endsection
