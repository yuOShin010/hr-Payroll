<?php   
    require_once __DIR__ . '/vendor/autoload.php';

    $fn = $_POST['fname'];
    $sn = $_POST['lname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $dept_code = $_POST['dept_code'];
    $position_desc = $_POST['position_desc'];
    $stats = $_POST['stats'];
    $date_from = $_POST['d_from'];
    $date_to = $_POST['d_to'];
    $days_work = $_POST['days_works'];
    $hours_work = $_POST['hours_work'];
    $overtime = $_POST['overtime'];
    $holidays = $_POST['holidays'];
    $leave = $_POST['leave'];
    $hours_pay = $_POST['hours_pay'];
    $ot_pay = $_POST['ot_pay'];
    $holiday_pay = $_POST['holiday_pay'];
    $leave_pay = $_POST['leave_pay'];
    $allowance_pay = $_POST['allowance_pay'];
    $sss = $_POST['sss'];
    $tax = $_POST['tax'];
    $pagibig = $_POST['pagibig'];
    $philhealth = $_POST['philhealth'];
    $others = $_POST['others'];
    $gross_pay = $_POST['gross_pay'];
    $t_deduction = $_POST['t_deduction'];
    $netpay = $_POST['netpay'];


    use Dompdf\dompdf;
    // $mpdf = new \Mpdf\Mpdf();
    $dompdf = new Dompdf;

    $data = '';

    $data .= '<h1> Personal Info </h1>';

    $data .= '<strong>First Name </strong>' . $fn . '<br/>';
    $data .= '<strong>Surname </strong>' . $sn . '<br/>';
    $data .= '<strong>Contact: </strong>' . $contact . '<br/>';
    $data .= '<strong>Email: </strong>' . $email . '<br/>';
    $data .= '<strong>Department:  </strong>' . $dept_code . '<br/>';
    $data .= '<strong>Position: </strong>' . $position_desc . '<br/>';
    $data .= '<strong>Status: </strong>' . $stats . '<br/>';
    $data .= '<strong>Date From: </strong>' . $date_from . '<br/>';
    $data .= '<strong>Date To: </strong>' . $date_to . '<br/>';
    $data .= '<strong>Days Work: </strong>' . $days_work . '<br/>';
    $data .= '<strong>Total Hours: </strong>' . $hours_work . '<br/>';
    $data .= '<strong>Overtime: </strong>' . $overtime . '<br/>';
    $data .= '<strong>Holidays Work: </strong>' . $holidays . '<br/>';
    $data .= '<strong>Leave Day/s: </strong>' . $leave . '<br/>';

    $data .= '<h1> Payroll </h1>';

    $data .= '<strong>Total Hours Pay: </strong>' . $hours_pay . '<br/>';
    $data .= '<strong>Overtime Pay: </strong>' . $ot_pay . '<br/>';
    $data .= '<strong>Holiday Pay: </strong>' . $holiday_pay . '<br/>';
    $data .= '<strong>Leave Pay: </strong>' . $leave_pay . '<br/>';
    $data .= '<strong>Allowance Pay: </strong>' . $allowance_pay . '<br/>';

    $data .= '<h1> Deductions </h1>';

    $data .= '<strong>SSS:  </strong>' . $sss . '<br/>';
    $data .= '<strong>Tax: </strong>' . $tax . '<br/>';
    $data .= '<strong>Pag-ibig: </strong>' . $pagibig . '<br/>';
    $data .= '<strong>Phil-health: </strong>' . $philhealth . '<br/>';
    $data .= '<strong>Others: </strong>' . $others . '<br/>';
    
    $data .= '<h1> Total Salary </h1>';

    $data .= '<strong>Gross Pay: </strong>' . $gross_pay . '<br/>';
    $data .= '<strong>Total Deduction: </strong>' . $t_deduction . '<br/>';
    $data .= '<strong>NetPay: </strong>' . $netpay . '<br/>';


    $dompdf->loadHTML($data);

    $dompdf->render();

    $dompdf->stream("SalarySlip.pdf");
    
?>

