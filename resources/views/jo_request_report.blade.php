@extends('layouts.admin_layout')

@section('title', 'Generate JO Requests Report')
@section('content_page')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>JO Request Report</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">JO Request Report</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
  
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card">
                            <div class="card-header">
                                JO Request Report
                            </div>
                            <!-- Start Page Content -->
                            <div class="card-body">
                                <div class="row">                                    
                                    <div class="row">
                                        <div class="form-group col-sm-6 flex-column">
                                            <label for="date_from">JO Requests Date From:</label>
                                            <input type="text" class="form-control datePickerFrom" name="date_from" id="txtDatePickerFrom" autocomplete="off" placeholder="yyyy-mm-dd" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                        </div>
    
                                        <div class="form-group col-sm-6 flex-column">
                                            <label for="date_to">JO Requests Date To:</label>
                                            <input type="text" class="form-control datePickerTo" name="date_to" id="txtDatepickerTo" autocomplete="off" placeholder="yyyy-mm-dd" aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <div>
                                    <button style="float: right;" type="submit" id="btnExportReport" class="btn btn-primary"><i id="BtnExportReportIcon" class="fa fa-check"></i> Export</button>
                                </div>
                            </div>
                            <!-- !-- End Page Content -->
                            
                        </div>                    
                        <!-- /.card -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

<!--     {{-- JS CONTENT --}} -->
@section('js_content')
    <script type="text/javascript">

        $(document).ready(function(){

            $('#txtDatePickerFrom').datepicker({
                        format: 'yyyy-mm-dd',
                        // format: 'yyyy-mm-dd',
                        forceParse: false, // prevent from clearing existing values from input when no date selected
                        autoclose: true, // autoclose date after selecting date
                        clearBtn: true, // include clear button
                        // daysOfWeekDisabled: [0, 6], // disabled weekends
                        todayHighlight: true,
                        // daysOfWeekHighlighted: [1,2,3,4,5],
                        // datesDisabled: disabledDays,
                    
            });

            
            $('#txtDatepickerTo').datepicker({
                        format: 'yyyy-mm-dd',
                        // format: 'yyyy-mm-dd',
                        forceParse: false, // prevent from clearing existing values from input when no date selected
                        autoclose: true, // autoclose date after selecting date
                        clearBtn: true, // include clear button
                        // daysOfWeekDisabled: [0, 6], // disabled weekends
                        todayHighlight: true,
                        // daysOfWeekHighlighted: [1,2,3,4,5],
                        // datesDisabled: disabledDays,
                    
            });

            $('#btnExportReport').on('click', function(e){
                console.log('clicked');
                let date_from = $('#txtDatePickerFrom').val();
                let date_to = $('#txtDatepickerTo').val();

                window.location.href = `export_jo_request/${date_from}/${date_to}`;
                $('#txtDatePickerFrom').val("");
                $('#txtDatepickerTo').val("");
            });

            $(document).on('click','#modalExportTraceability',function(e){
                $('#txtDatePickerFrom').val("");
                $('#txtDatepickerTo').val("");
            });

        });

    </script>
@endsection

