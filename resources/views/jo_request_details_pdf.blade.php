<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Order Form</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .container { width: 100%; margin: auto; }
        .header { text-align: center; font-size: 14px; font-weight: bold; }
        .logo { height: 50px; }
        .section { border: 1px solid black; margin-top: 10px; padding: 10px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid black; padding: 5px; }
        .checkbox { display: inline-block; width: 15px; height: 15px; border: 1px solid black; }
        .center { text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo"><br>
            FACTORY AUTOMATION JOB ORDER REQUEST FORM<br>
            Control Number: FASJO-TS-0233-001
        </div>

        <div class="section">
            <strong>To be filled out by the Requesting Section</strong>
            <table class="table">
                <tr>
                    <td>Department/Section: _____________________</td>
                    <td>Equipment Name: ________________________</td>
                </tr>
                <tr>
                    <td>Date Prepared: _________________________</td>
                    <td>Equipment Number: ______________________</td>
                </tr>
                <tr>
                    <td colspan="2">Job Description:<br> <textarea style="width: 100%; height: 50px;"></textarea></td>
                </tr>
                <tr>
                    <td>Allocated Budget: _______________________</td>
                    <td>Prepared by: ____________________________</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <strong>To be filled out by the FA Section</strong>
            <table class="table">
                <tr>
                    <td>Date Received: __________________________</td>
                    <td>Approved by: ___________________________</td>
                </tr>
                <tr>
                    <td>
                        <strong>Job Classification:</strong><br>
                        <div class="checkbox"></div> Machine Repair and Troubleshooting<br>
                        <div class="checkbox"></div> Machine Equipment Modification<br>
                        <div class="checkbox"></div> New Equipment Fabrication
                    </td>
                    <td>
                        <strong>Recommendation:</strong><br>
                        <div class="checkbox"></div> Handled by FAS<br>
                        <div class="checkbox"></div> Need External Supplier
                    </td>
                </tr>
                <tr>
                    <td>Estimated Completion Date: ____________</td>
                    <td>Estimated Cost: ______________________</td>
                </tr>
            </table>
        </div>

        <div class="section center">
            <strong>Job Order Completion</strong>
            <table class="table">
                <tr>
                    <td>Date Completed: __________________________</td>
                    <td>Checked by: _____________________________</td>
                    <td>Remarks: _______________________________</td>
                </tr>
            </table>
        </div>

        <div class="footer center" style="margin-top: 20px; font-size: 10px;">
            <p>Process Flow: Requesting Section > FA Section > Approval > Job Execution</p>
            <p>© Apricon Microelectronics, Inc.</p>
        </div>
    </div>
</body>
</html>