<?php 
  require ("fpdf/fpdf.php");

  include '../imports/config.php';
  $conn = new mysqli($server_name, $username, $password, $database_name);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  session_start();
  $empid = $_GET['empid'];
  $month = $_GET['month'];
  $year = $_GET['year'];


  $monthNum  = $month;
  $dateObj   = DateTime::createFromFormat('!m', $monthNum);
  $monthName = $dateObj->format('F'); // March


  //uname 
  $sql = "SELECT * FROM logint WHERE euid = '$empid'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $uname = $row['uname'];

  //address
  $sql2 = "SELECT * FROM empt WHERE empid = '$empid'";
  $result2 = $conn->query($sql2);
  $row2 = $result2->fetch_assoc();
  $address = $row2['eaddress'];

  //Receipt number
  $sql3 = "SELECT id, gdate, gsalary, tsalary, bonus, dsalary FROM salpayt WHERE euid = '$empid' and month = '$month' and year = '$year'";
  $result3 = $conn->query($sql3);
  if($row3 = $result3->fetch_assoc()){
    $Receipt_number = $row3['id'];
    $gdate = $row3['gdate'];
    $gsalary = $row3['gsalary'];
    $main_salary = $row3['tsalary'];
    $bonus = $row3['bonus'];
    $dsalary = $row3['dsalary'];
    }else{
        echo "<script>alert('Salary not found for given data');</script>";
        echo "<script>window.location.href='salpayment.php';</script>";
    } 
  

  //bankacc details
  $sql4 = "SELECT bankname, bankacc FROM salaryt WHERE euid = '$empid'";
  $result4 = $conn->query($sql4);
  $row4 = $result4->fetch_assoc();
  $bankname = $row4['bankname'];
  $bankacc = $row4['bankacc'];
  


  //customer and Receipt details
  $info=[
    "customer"=> $uname,
    "address"=>"$address",
    "Receipt_no"=>"$Receipt_number",
    "Receipt_date"=>"$gdate",
    "total_amt"=>"$gsalary",
    "bankacc"=>"Bank Name : $bankname",
    "bankacc_no"=>"Bank Account Number : $bankacc"
  ];
  
  
  //Receipt Products
  $products_info=[
    [
      "name"=>"Salary for the month of ".$monthName ." ".date('Y'),
      "salary"=>"$main_salary",
      "bonus"=>"$bonus",
      "deducted"=>"$dsalary"
    ],
  ];
  
  class PDF extends FPDF
  {
    function Header(){
      
      //Display Company Info
      $this->SetFont('Arial','B',14);
      $this->Cell(50,10,"Rich Tech",0,1);
      $this->SetFont('Arial','',14);
      $this->Cell(50,7,"Wakdewadi, Shivajinagar,",0,1);
      $this->Cell(50,7,"Pune 411012.",0,1);
      $this->Cell(50,7,"PH : 9175315683",0,1);
      
      //Display Receipt text
      $this->SetY(15);
      $this->SetX(-60);
      $this->SetFont('Arial','B',18);
      $this->Cell(30,10," SALARY RECEIPT",0,1);
      
      //Display Horizontal line
      $this->Line(0,48,210,48);
    }
    
    function body($info,$products_info){
      
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,$info["address"],0,1);
      //$this->Cell(50,7,$info["city"],0,1);
      
      //Display Receipt no
      $this->SetY(55);
      $this->SetX(-60);
      $this->Cell(50,7,"Receipt No : ".$info["Receipt_no"]);
      
      //Display Receipt date
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"Receipt Date : ".$info["Receipt_date"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,9,"DESCRIPTION",1,0);
      $this->Cell(40,9,"BASE SALARY",1,0,"C");
      $this->Cell(30,9,"DEDUCTION",1,0,"C");
      $this->Cell(40,9,"BONUS",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(80,9,$row["name"],"LR",0);
        $this->Cell(40,9,$row["salary"],"R",0,"R");
        $this->Cell(30,9,$row["deducted"],"R",0,"C");
        $this->Cell(40,9,$row["bonus"],"R",1,"R");
      }
      //Display table empty rows
      for($i=0;$i<5-count($products_info);$i++)
      {
        $this->Cell(80,9,"","LR",0);
        $this->Cell(40,9,"","R",0,"R");
        $this->Cell(30,9,"","R",0,"C");
        $this->Cell(40,9,"","R",1,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
      $this->Cell(150,9,"TOTAL",1,0,"R");
      $this->Cell(40,9,$info["total_amt"],1,1,"R");
      
      //bank acc details - name
      $this->SetY(160);
      $this->SetX(10);
      $this->SetFont('Arial','B',16);
      $this->Cell(0,9,"Payment Details ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(0,9,$info["bankacc"],0,1);

      //bank acc details - acc no
      $this->SetY(175);
      $this->SetX(10);
      $this->SetFont('Arial','',12);
      $this->Cell(0,9,$info["bankacc_no"],0,1);

      //bank acc details - paid on
      $this->SetY(182);
      $this->SetX(10);
      $this->SetFont('Arial','',12);
      $this->Cell(0,9,'Paid on : ' . strval($info["Receipt_date"]),0,1);
      
    }
    function Footer(){
      
      //set footer position
      $this->SetY(190);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,10,"From Rich Tech",0,1,"R");
      $this->Ln(10);
      $this->SetFont('Arial','',12);
      $this->Cell(0,10,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',10);
      
      //Display Footer Text
      $this->Cell(340,10,"This is a computer generated Receipt",10,5,"C");
      $this->Cell(340,0,"and doesn't require a signature",10,5,"C");

      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf->Output();

?>