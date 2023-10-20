
<?php

require('fpdf.php');
$pdf=new FPDF();
$pdf->SetAuthor("Dhrubo Raj Roy-http://TheDhrubo.xyz");

$con=mysqli_connect('localhost','root','','lab_report');
if(isset($_GET['submit'])){
    $type="labreport";
    if(isset($_GET['course_code'])){
        $course_code=$_GET['course_code'];
        $type=$_GET['type'];
        $exp_name=$_GET['exp_name'];
        if($type==""){
            $type="labreport";
        }
    }

    $font="fonts/Mainak-Buniyadi-V1.ttf";
    // $font="fonts/Siyam-Rupali.ttf";
    // $sql="select * from students limit 1";
    $php_array = json_decode(file_get_contents('sartho.json'), true);
    $count=count($php_array);
    for ($i=0; $i < $count; $i++) {
    // echo "<pre>";
    // print_r($php_array[$i]['amount_2022']);
        $image=imagecreatefromjpeg("pics/rasid-2023.jpg");
        $color=imagecolorallocate($image,0,0,0);
        // $name=ucfirst($row['name']);
        imagettftext($image,55,0,580,645,$color,$font,$php_array[$i]['name']);
        if($php_array[$i]['amount_2022']>1000 && $php_array[$i]['amount_2022']<1499){
            $amount=1500;
        }else{
            $amount= $php_array[$i]['amount_2022'];
        }
        imagettftext($image,55,0,440,745,$color,$font,$amount." UvKv");
        imagettftext($image,55,0,1240,745,$color,$font,'Av`k© cvov');
        
        $file=" ".$i." ".'_'.$i;
        $pdf->SetTitle($php_array[$i]['goli_name']);
                
        $file_path=$i.".jpg";
        $file_path_pdf=$php_array[$i]['goli_name'].".pdf";
        imagejpeg($image,$file_path);
        imagedestroy($image);

        
        //Page start 
        $pdf->AddPage('L','A5');
        $pdf->Image($file_path,0,0,210);
        //Page Ended
        unlink($file_path);
    }
    $pdf->Output($file_path_pdf,"I");
    unlink($file_path);
}else{
    // header('location:./');
}
?>