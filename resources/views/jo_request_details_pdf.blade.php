<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Order Form</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .container { width: 100%; }
        .header { text-align: center; font-size: 14px; font-weight: bold; }
        .logo { height: 50px; }
        .section { border: 1px solid black; margin-top: 10px; padding: 10px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid black; padding: 5px; }
        .checkbox { display: inline-block; width: 15px; height: 15px; border: 1px solid black; }
        .center { text-align: center; }
        .img-position {
        position: absolute;
        top: -30px;   /* Y position */
        left:-20px;  /* X position */
        width: 250px; /* image size */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid black;
            /* padding: 10px; */
            vertical-align: top;
        }
        .section-title {
            font-weight: bold;
        }
        .signature-section td {
            height: 60px;
            text-align: center;
        }
        .signature-line {
            margin-top: 20px;
            border-top: 1px solid black;
            display: inline-block;
            width: 95%;
        }
        .signature-name {
            font-size: 10px;
        }
        .checkbox { display: inline-block; width: 12px; height: 12px; border: 1px solid black; text-align: center; font-weight: bold; font-size: 10px; line-height: 12px; }
        .checked:before { content: '✔'; font-size: 10px; color: black; }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img class="img-position" src="pmiLogo.png" alt="Image" />
            <br>
        </div>

        <div style="margin-left: 39rem; margin-top: -.5rem">
            PPS-K01-001
        </div>
    
        <div class="section">
            <div style="text-align: center; font-size: 1.3rem;">
                <strong>FACTORY AUTOMATION JOB ORDER REQUEST FORM</strong>
            </div>
            <div style="text-align: right; margin-top: .5rem;">
                Control Number: 
                <span style="display: inline-block; width: 150px; border-bottom: 1px solid black; text-align: left; padding-left: 5px;">
                    {{$joDetails[0]->jo_ctrl_no}}
                </span>
            </div>
        
            <div style="text-align: center; margin-bottom: 20px;">
                <div style="border: 1px solid black; background: #ffe44d">
                    <strong style="font-size: 14px;">To be filled out by the Requesting Section</strong>
                </div>
            </div>
        
            <div style="display: flex; justify-content: center;">
                <table style="width: 100%; max-width: 800px; border-collapse: collapse;">
                    <tr>
                        <!-- Department/Section -->
                        <td style="width: 25%; vertical-align: middle; padding-right: 10px; border: none;">
                            <label for="department" style="display: inline-block; margin-bottom: 5px;">Department/Section:</label>
                        </td>
                        <td style="width: 25%; vertical-align: middle; border: none;">
                            <input type="text" id="department" style="border: none; border-bottom: 1px solid #000; outline: none; width: 75%;" value="{{ $joDetails[0]->department }}">
                        </td>
            
                        <!-- Equipment Name -->
                        <td style="width: 25%; vertical-align: middle; padding-right: 10px; border: none;">
                            <label for="equipmentName" style="display: inline-block; margin-bottom: 5px;">Equipment Name:</label>
                        </td>
                        <td style="width: 25%; vertical-align: middle; border: none;">
                            <input type="text" id="equipmentName" style="border: none; border-bottom: 1px solid #000; outline: none; width: 75%;" value="{{ $joDetails[0]->equipment_name }}">
                        </td>
                    </tr>
                </table>
            </div>

            <div style="display: flex; justify-content: center;">
                <table style="width: 100%; max-width: 800px; border-collapse: collapse;">
                    <tr>
                        <!-- Date prepared -->
                        <td style="width: 25%; vertical-align: middle; padding-right: 10px; border: none;">
                            <label for="datePrepared" style="display: inline-block; margin-bottom: 5px;">Date Prepared:</label>
                        </td>
                        <td style="width: 25%; vertical-align: middle; border: none;">
                            <input type="text" id="datePrepared" style="border: none; border-bottom: 1px solid #000; outline: none; width: 75%;" value="{{ $joDetails[0]->date_filed }}">
                        </td>
            
                        <!-- Equipment Number -->
                        <td style="width: 25%; vertical-align: middle; padding-right: 10px; border: none;">
                            <label for="equipmentNumber" style="display: inline-block; margin-bottom: 5px;">Equipment Number:</label>
                        </td>
                        <td style="width: 25%; vertical-align: middle; border: none;">
                            <input type="text" id="equipmentNumber" style="border: none; border-bottom: 1px solid #000; outline: none; width: 75%;" value="{{ $joDetails[0]->equipment_no }}">
                        </td>
                    </tr>
                </table>
            </div>

            <div style="border: none; #000; outline: none; width: 100%; padding-top:10px;">
                <table>
                    <tr>
                        <td colspan="2" style="height: 150px; position: relative;">
                            <span class="section-title">Job Description:</span>
                            {{ $joDetails[0]->job_description }}
                            <div style="position: absolute; bottom: 10; right: 5;">
                                <span>Allocated Budget:</span> 
                                <span style="border-bottom: 1px solid black; width: 100px; display: inline-block; text-align: center;"> {{ $joDetails[0]->currency == 1 ? '$' : '' }}{{ $joDetails[0]->allocated_budget }}</span>
                            </div>
                        </td>
                        <td style="width: 35%; height: 150px;">
                            <span class="section-title">Initial Action:</span>
                            {{ $joDetails[0]->initial_action }}
                        </td>
                    </tr>
                    <tr class="signature-section">
                        <td style="border-bottom: none;">
                            <div class="section-title" style="text-align: left;">Prepared by:</div>
                            <div style="margin-top: 1rem;">{{ $joDetails[0]->rapidx_user_details->name ?? '' }}</div>
                            <div class="signature-line" style="margin-top: 5px;"></div>
                            <div class="signature-name">Name and Signature</div>
                        </td>
                        <td style="border-bottom: none;">
                            <div class="section-title" style="text-align: left;">Checked by:</div><br>
                            <div>{{ $joDetails[0]->user_access_details->rapidx_user_details->name ?? '' }}</div> <!-- If available, else blank -->
                            <div class="signature-line" style="margin-top: 5px;"></div>
                            <div class="signature-name">Name and Signature</div>
                        </td>
                        <td style="border-bottom: none;">
                            <div class="section-title" style="text-align: left;">Approved by:</div><br>
                            <div>{{ $joDetails[0]->rapidx_section_head_details->name ?? '' }}</div> <!-- If available, else blank -->
                            <div class="signature-line" style="margin-top: 5px;"></div>
                            <div class="signature-name">Name and Signature</div>
                        </td>
                    </tr>
                </table>
            </div>
            
            <div style="text-align: center;">
                <div style="border: 1px solid black; background: lightblue;">
                    <strong style="font-size: 14px;">To be filled out by FA Section</strong>
                </div>
                <div>
                    <table>
                        <tr>
                            <td style="width: 25%; vertical-align: middle; border: none; padding-left: 10px;">
                                <label for="dateReceived" style="display: inline-block; margin-bottom: 5px;">Date Received: {{ date_format($joDetails[0]->jo_requests_conformance->created_at,"Y/m/d")  }}</label>
                            </td>
                            {{-- <td style="width: 25%; vertical-align: middle; border: none;">
                                <input type="text" id="dateReceived" style="border: none; outline: none; width: 100%;" value="{{ $joDetails[0]->equipment_no }}">
                            </td> --}}
                        </tr>
                    </table>
                </div>
            </div>

            <div style="#000; outline: none; width: 100%;">
                <table>
                    <tr>
                        <td  colspan="2" style="height: 100px; position: relative; border-bottom:none;">
                            <span class="section-title">FAS Assessment:</span>
                            {{ $joDetails[0]->job_description }}
                            <div style="position: absolute; bottom: 10; right: 5;">
                                <span>Assessed By:</span> 
                                <span style="border-bottom: 1px solid black; width: 100px; display: inline-block; text-align: center;"></span>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="container">
                    <table class="table">
                        <tr>
                            <!-- Job Classification -->
                            <td colspan="2">
                                <div style="margin-bottom: 10px;" class="section-title">Job Classification:</div>
                                <div>
                                    <span class="checkbox"> 
                                        @if($joDetails[0]->jo_requests_conformance->job_classification == 1)
                                        x
                                        @endif
                                    </span> Machine Repair and Troubleshooting
                                </div>
                                <div><span class="checkbox">
                                    @if($joDetails[0]->jo_requests_conformance->job_classification == 2)
                                    x
                                    @endif
                                    </span> Machine/Equipment Modification
                                </div>
                                <div><span class="checkbox">
                                    @if($joDetails[0]->jo_requests_conformance->job_classification == 3)
                                    x
                                    @endif
                                    </span> Machine/Equipment Development
                                </div>
                                <div><span class="checkbox">
                                    @if($joDetails[0]->jo_requests_conformance->job_classification == 4)
                                    x
                                    @endif
                                    </span> Program/Software Development
                                </div>
                            </td>
                            
                            <!-- Recommendation -->
                            <td colspan="2">
                                <div style="margin-bottom:10px;" class="section-title">Recommendation:</div>
                                <div><span class="checkbox">
                                    @if($joDetails[0]->jo_requests_conformance->recommendation == 1)
                                    x
                                    @endif
                                    </span> Internal Job by FAS
                                </div>
                                <div><span class="checkbox">
                                    @if($joDetails[0]->jo_requests_conformance->recommendation == 2)
                                    x
                                    @endif
                                    </span> Need External Supplier
                                </div>
                                <div><span class="checkbox">
                                    @if($joDetails[0]->jo_requests_conformance->recommendation == 3)
                                    x
                                    @endif
                                    </span> Others:
                                </div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px;">
                                    @if($joDetails[0]->jo_requests_conformance->recommendation == 3)
                                    {{ $joDetails[0]->jo_requests_conformance->others_recommendation }}
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Estimated Completion Date & Cost -->
                            <td>
                                <div class="section-title">Estimated Completion Date:</div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px;">{{  $joDetails[0]->jo_requests_conformance->estimated_completion_date }}</div>
                                <div class="section-title" style="margin-top: 10px;">Estimated Cost:</div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px;">
                                    @if($joDetails[0]->jo_requests_conformance->estimated_type == 1)
                                    {{ '$'.$joDetails[0]->jo_requests_conformance->estimated_cost }}
                                    @endif
                                    @if($joDetails[0]->jo_requests_conformance->estimated_type == 2)
                                    {{ 'PHP'.$joDetails[0]->jo_requests_conformance->estimated_cost }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <!-- Initial Approval -->
                            <td colspan="2" class="center">
                                <div class="section-title" style="text-align: left;">Initial Approval:</div>
                                <div class="signature-line center" style=" width: 150px; margin-top: 3rem;"></div> <!-- Line below the name -->
                                <div>KTE</div>
                                {{-- <div class="signature-name center" style="margin-top: 0px;">Name and Signature</div> --}}
                            </td>
                            
                            <!-- Final Approval -->
                            <td colspan="2" style="position: relative;">
                                <div class="section-title" style="text-align: left;">Final Approval:</div>
                                <div style="position: absolute; top: 0; right: 0; font-size: 10px; padding-right: 5px; word-wrap: break-word; white-space: normal; max-width: 100px;">
                                    If cost is more than $5,000, need President's approval
                                </div>

                                <div class="center" style="margin-top: 1rem;">
                                    <div class="signature-line center" style=" width: 80px; margin-top: 3rem;">
                                        <div style="text-align: center;">JCP</div>
                                    </div> <!-- Line below the name -->
    
                                    <div class="signature-line center" style=" width: 80px; margin-top: 3rem;">
                                        <div style="text-align: center;">NCP</div>
                                    </div> <!-- Line below the name -->
                                </div>
                            
                            </td>
                            
                            <!-- Approval Status -->
                            <td>
                                <div  class="section-title" style="margin-bottom: 5px;">Approval Status:</div>
                                <div class="text-green"><span class="checkbox"></span> Approved to Proceed</div>
                                <div class="text-red"><span class="checkbox"></span> Disapproved to Proceed</div>
                                
                            </td>
                        </tr>
                    </table>
                </div>
    
                <div class="container">
                    <div class="header">Job Order Completion</div>
                    <table class="table">
                        <tr>
                            <!-- Date Completed -->
                            <td colspan="12">
                                <div class="section-title">Date Completed:</div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px;"></div>
                            </td>
                        </tr>
                        <tr>
                            <!-- JO Conducted by -->
                            <td colspan="1">
                                <div class="section-title">JO Conducted by:</div>
                                <div class="center" style="margin-top: 1rem; margin-bottom: -1rem;">{{ $joDetails[0]->jo_requests_conformance->rapidx_user_details->name }}</div>
                                <div class="signature-line center"></div> <!-- Line below the name -->
                                <div class="signature-name center">Name and Signature</div>
                            </td>
                            
                            <!-- Checked by -->
                            {{-- <td>
                                <div class="section-title">Checked by:</div>
                                <div class="center" style="margin-top: 1rem; margin-bottom: -1rem;">{{ $joDetails[0]->jo_requests_conformance->rapidx_user_details->name }}</div>
                                <div class="signature-line center"></div>
                                <div class="signature-name center">Name and Signature</div>
                            </td> --}}
                            
                            <!-- Approved by -->
                            <td colspan="11">
                                <div class="section-title">Approved by:</div>
                                <div class="center" style="margin-top: 1rem; margin-bottom: -1rem;">KTE</div>
                                <div class="signature-line center"></div>
                                <div class="signature-name center">Name and Signature</div>
                            </td>
                        </tr>
                        <tr>
                            <!-- Requestor Conformance -->
                            <td class="center" colspan="1">
                                <div class="section-title" style="text-align: left;">Requestor Conformance:</div>
                                <div class="center" style="margin-top: 1rem; margin-bottom: -1rem;">{{ $joDetails[0]->rapidx_user_details->name }}</div>
                                <div class="signature-line center"></div>
                                <div class="signature-name center">Name and Signature</div>
                                
                                <div style="border-top: 1px solid black; width: 50%; display: inline-block; margin-top: 1rem;">Date</div>
                            </td>
                            
                            <!-- Documents -->
                            <td colspan="1">
                                <div class="section-title">Documents:</div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px; margin-top: 5px;"></div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px; margin-top: 5px;"></div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px; margin-top: 5px;"></div>
                            </td>
                            
                            <!-- Remarks -->
                            <td colspan="10">
                                <div class="section-title">Remarks:</div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px; margin-top: 5px;"></div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px; margin-top: 5px;"></div>
                                <div style="border-bottom: 1px solid black; width: 100%; height: 15px; margin-top: 5px;"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>