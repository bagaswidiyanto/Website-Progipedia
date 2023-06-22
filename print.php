<?php 
ob_start();
date_default_timezone_set('Asia/Jakarta');
require('../../assets/fpdf/fpdf.php');
require('../../assets/fpdf/PDF_Code128.php');

//function hex2dec

//returns an associative array (keys: R,G,B) from

//a hex html code (e.g. #3FE5AA)

function hex2dec($couleur = "#000000"){

    $R = substr($couleur, 1, 2);

    $rouge = hexdec($R); 

    $V = substr($couleur, 3, 2);

    $vert = hexdec($V);

    $B = substr($couleur, 5, 2);

    $bleu = hexdec($B);

    $tbl_couleur = array();

    $tbl_couleur['R']=$rouge;

    $tbl_couleur['V']=$vert;

    $tbl_couleur['B']=$bleu;

    return $tbl_couleur;

}



//conversion pixel -> millimeter at 72 dpi

function px2mm($px){

    return $px*25.4/72;

}



function txtentities($html){

    $trans = get_html_translation_table(HTML_ENTITIES);

    $trans = array_flip($trans);

    return strtr($html, $trans);

}

// class PDF extends FPDF
class PDF extends PDF_Code128
{
var $angle=0;

function Rotate($angle,$x=-1,$y=-1)
{
  if($x==-1)
    $x=$this->x;
  if($y==-1)
    $y=$this->y;
  if($this->angle!=0)
    $this->_out('Q');
  $this->angle=$angle;
  if($angle!=0)
  {
    $angle*=M_PI/180;
    $c=cos($angle);
    $s=sin($angle);
    $cx=$x*$this->k;
    $cy=($this->h-$y)*$this->k;
    $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
  }
}

function _endpage()
{
  if($this->angle!=0)
  {
    $this->angle=0;
    $this->_out('Q');
  }
  parent::_endpage();
}

function RotatedText($x, $y, $txt, $angle)

{

    //Text rotated around its origin

    $this->Rotate($angle,$x,$y);

    $this->Text($x,$y,$txt);

    $this->Rotate(0);

}

var $extgstates = array();



    // alpha: real value from 0 (transparent) to 1 (opaque)

    // bm:    blend mode, one of the following:

    //          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,

    //          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity

    function SetAlpha($alpha, $bm='Normal')

    {

        // set alpha for stroking (CA) and non-stroking (ca) operations

        $gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));

        $this->SetExtGState($gs);

    }



    function AddExtGState($parms)

    {

        $n = count($this->extgstates)+1;

        $this->extgstates[$n]['parms'] = $parms;

        return $n;

    }



    function SetExtGState($gs)

    {

        $this->_out(sprintf('/GS%d gs', $gs));

    }



    function _enddoc()

    {

        if(!empty($this->extgstates) && $this->PDFVersion<'1.4')

            $this->PDFVersion='1.4';

        parent::_enddoc();

    }

    protected $javascript;

    protected $n_js;



    function IncludeJS($script, $isUTF8=false) {

        if(!$isUTF8)

            $script=utf8_encode($script);

        $this->javascript=$script;

    }



    function _putjavascript() {

        $this->_newobj();

        $this->n_js=$this->n;

        $this->_put('<<');

        $this->_put('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');

        $this->_put('>>');

        $this->_put('endobj');

        $this->_newobj();

        $this->_put('<<');

        $this->_put('/S /JavaScript');

        $this->_put('/JS '.$this->_textstring($this->javascript));

        $this->_put('>>');

        $this->_put('endobj');

    }



    function _putextgstates()

    {

        for ($i = 1; $i <= count($this->extgstates); $i++)

        {

            $this->_newobj();

            $this->extgstates[$i]['n'] = $this->n;

            $this->_out('<</Type /ExtGState');

            $parms = $this->extgstates[$i]['parms'];

            $this->_out(sprintf('/ca %.3F', $parms['ca']));

            $this->_out(sprintf('/CA %.3F', $parms['CA']));

            $this->_out('/BM '.$parms['BM']);

            $this->_out('>>');

            $this->_out('endobj');

        }

    }



    function _putresourcedict()

    {

        parent::_putresourcedict();

        $this->_out('/ExtGState <<');

        foreach($this->extgstates as $k=>$extgstate)

            $this->_out('/GS'.$k.' '.$extgstate['n'].' 0 R');

        $this->_out('>>');

    }



    function _putresources()

    {

        $this->_putextgstates();

        parent::_putresources();



        if (!empty($this->javascript)) {

            $this->_putjavascript();

        }

    }

    function _putcatalog() {

        parent::_putcatalog();

        if (!empty($this->javascript)) {

            $this->_put('/Names <</JavaScript '.($this->n_js).' 0 R>>');

        }

    }



    //  function AutoPrint($printer='')

    // {

    //     // Open the print dialog

    //     if($printer)

    //     {

    //         $printer = str_replace('\\', '\\\\', $printer);

    //         $script = "var pp = getPrintParams();";

    //         $script .= "pp.interactive = pp.constants.interactionLevel.full;";

    //         $script .= "pp.printerName = '$printer'";

    //         $script .= "print(false);";

    //     }

    //     else

    //         $script = 'print(false);';

    //     $this->IncludeJS($script);

    // }

    function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}


function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
 
 
function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}

// function tes1()
//   {            
      include "../../inc/config.php";
    include "../../phpqrcode/qrlib.php";
      define('EXAMPLE_TMP_SERVERPATH', dirname(__FILE__).'/temp/');
      define('EXAMPLE_TMP_URLRELPATH', dirname(__FILE__).'/temp/');
      $tempDir = EXAMPLE_TMP_SERVERPATH; 
      
      session_start();
      $user    = $_SESSION['id_user'];
      $branch  = $_SESSION['id_branch'];
      $agent   = $_SESSION['id_agent'];
      $gerai   = $_SESSION['id_gerai'];
      $Lat     = $_SESSION['Latitude'];
      $Lon     = $_SESSION['Longitude'];
      $Konid   = $_GET['id'];
      
        // $pdf = new FPDF('P','mm',array(215 ,165));
        // $pdf=new PDF_Code128('P','mm',array(215 ,165 ));
        //210 x 297
    

        $pdf=new PDF('P','mm',array(210 , 297 ));
        // $pdf = new PDF_Code128('P', 'mm', array(210, 297));
        // $pdf=new PDF('P','mm',array(210 ,297  ));


        $x_pos = 0; // posisi garis X
        $y_pos = 0; // posisi garis Y
        $pdf->SetMargins(7,0,0,0);
        // $pdf->SetMargins(7,0,0,0); // Set margin ke 0 semua
        
        if($x_pos == 0 && $y_pos == 0) {
            $pdf->AddPage('P',array(210 ,297  ));
           
        } 
      $cabang=$db->fetch_custom_single("SELECT * FROM log_branch where kode='".$branch."'");
      $comp=$db->fetch_custom_single("SELECT * from em_company LIMIT 1");

      $pdf->setAutoPageBreak(AUTO,0);
        

        
        
        // DATABASE
            $dataResi = $db->fetch_custom_single('SELECT A.*,A.createDate as tanggal,A.nilaiBarang,A.discount,G.billingType,F.contentDelivery,serviceName,D.first_name,D.last_name,A.Jenis_Barang,B.nama as Asal,CONCAT(C.kecName,", Kab. ",C1.kabName) as TujuanKota,C.kecName,C1.kabName as kabs,IF(C.kecName=C1.kabName, "Kota ","Kab. " ) as statt

              from em_konos_detail A 

              LEFT JOIN log_branch B ON A.Asal=B.kode 

              LEFT JOIN log_kecamatan C ON A.Tujuan=C.id
              left join log_kabupaten C1 on C.kabupaten=C1.id 

              LEFT JOIN sys_users D on A.CreatedUserId=D.id 

              LEFT JOIN log_services E ON A.Satuan=E.serviceID

              LEFT JOIN log_contentdelivery  F ON A.Product=F.ID 

              LEFT JOIN log_billingtype G ON A.Jenis_Biaya=G.ID 

              WHERE A.Konid="'.$Konid.'"');
        
$x = 1;

while($x < 4) {  
// if($x_pos == 0 && $y_pos == 0) {

//             $pdf->AddPage('L',array(210 , 99 ));



//         } 
      //=========================== H E A D E R ===================================

            // if($dataResi->Satuan==1 || $dataResi->Satuan==3){
        // QUERY
         $pdf->Image('../company/foto/' . $comp->foto,8, $y_pos + 6, 17, 17, '', ''); //LOGO
 
            //$pdf->Image('../mykurir.png',7,$y_pos+6,45,'','','');//LOGO

 

            $pdf->SetAlpha(0.1);

           // $pdf->Image('../logo.jpeg',$x_pos+70,$y_pos+25,65,'','','');//LOGO

            $pdf->SetAlpha(1);

            // $pdf->SetFont('Arial','',7);


            $pdf->SetFont('Arial','',8);
            $pdf->Text($x_pos+35, $y_pos+10, 'Kantor Pusat : ');
            $pdf->Text($x_pos+35, $y_pos+12.5, $comp->alamatPerusahaan.',');
            $pdf->Text($x_pos+35, $y_pos+15, $comp->alamatPerusahaan2.'. '.$comp->Kota.' - Indonesia');
            $pdf->Text($x_pos+35, $y_pos+17.5, 'Telp. '.$comp->Telp);
            $pdf->Text($x_pos+35, $y_pos+20, $comp->website);

            $pdf->SetFont('Arial','',8);
           QRcode::png($dataResi->Konid, $tempDir.'QRCODE.png', QR_ECLEVEL_H, 10); //generate ERCODENYA

           $pdf->Image(EXAMPLE_TMP_URLRELPATH.'QRCODE.png',$x_pos+77,$y_pos+45,25,25,'','');//QRCODE

            $pdf->SetFont('Arial','',6.5);

            if($x==1){
              $pdf->RotatedText($x_pos+5,$y_pos+60,'PAGE 1/3 : SHIPPER',90);
            }else if($x==2){
              $pdf->RotatedText($x_pos+5,$y_pos+60,'PAGE 2/3 : OPERATIONAL',90);
            }else if($x==3){
              $pdf->RotatedText($x_pos+5,$y_pos+65,'PAGE 3/3 : BILLING',90);
            }else if($x==4){
              $pdf->RotatedText($x_pos+5,$y_pos+65,'PAGE 4/4 : POD',90);
            }

            $pdf->Code128(143 + $x_pos,9 + $y_pos,$dataResi->Konid,60,8);

            $pdf->SetFont('Arial','',10);

            $pdf->setXY(162 + $x_pos,18 + $y_pos);



            $pdf->Cell(23,3,$dataResi->Konid,0,1,C);

            $pdf->setX(162+$x_pos);

            $pdf->SetFont('Arial','B',8);

            $pdf->Cell(32,8,'',0,1,C);

            $pdf->setX(159+$x_pos);
            $cek_dimensi=$db->fetch_custom_single("SELECT COUNT(ID) as jml FROM log_dimensi WHERE Konid='$dataResi->Konid'");


            
            $pdf->SetTextColor(0,0,0);
            $pdf->Text($x_pos+85, $y_pos+25, 'Origin');
            $pdf->Text($x_pos+115, $y_pos+25, 'Destination');
            $pdf->Text($x_pos+145, $y_pos+25, 'Service');
            $pdf->Text($x_pos+180, $y_pos+25, 'No. Reff');
            $pdf->Text($x_pos+85, $y_pos+37, 'Pieces');
            $pdf->Text($x_pos+115, $y_pos+37, 'Weight');

            $pdf->Text($x_pos+135, $y_pos+37, 'Volume');

            $pdf->Text($x_pos+155, $y_pos+37, 'Payment');
            $pdf->Text($x_pos+180, $y_pos+37, 'Handling');
            
            $pdf->SetFont('Arial','',7);
            $pdf->Text($x_pos+85, $y_pos+30, $dataResi->Asal);
            // $pdf->Text($x_pos+115, $y_pos+30, $dataResi->kecName);
            $pdf->Text($x_pos+115, $y_pos+30, $dataResi->kecName.', ');
            $pdf->Text($x_pos+115, $y_pos+33, $dataResi->statt.$dataResi->kabs);
            
            $pdf->Text($x_pos+145, $y_pos+30, $dataResi->serviceName);
            $pdf->Text($x_pos+180, $y_pos+30, $dataResi->No_DO);
            $pdf->Text($x_pos+85, $y_pos+42, $dataResi->Koli." C");
            // if($cek_dimensi->jml > 0){
            // foreach($db->fetch_custom("SELECT sum(Berat) as beratnya,sum(Volume) as volumenya  FROM log_dimensi WHERE Konid='$dataResi->Konid'") as $berat){
            //     if($berat->beratnya>$berat->volumenya){
            //     $pdf->Text($x_pos+115, $y_pos+42, number_format($berat->beratnya,1)." Kg");
            //     }else{
            //         $pdf->Text($x_pos+115, $y_pos+42, ceil($berat->volumenya)." Kg");
            //     }
            // }
            // }else{
                $pdf->Text($x_pos+115, $y_pos+42, $dataResi->Kilo." Kg");   
            // }
            
            // $pdf->SetFont('Arial','',8);
            $pdf->Text($x_pos+135, $y_pos+42, $dataResi->Volume);
            $pdf->Text($x_pos+155, $y_pos+42, $dataResi->billingType);
            $pdf->SetFont('Arial','',7);
            $pdf->Text($x_pos+180, $y_pos+42, 'GENERAL CARGO');
            $pdf->SetFont('Arial','',10);

            $pdf->SetTextColor(0,0,0);

            $pdf->SetFont('Arial','UB',7.5);

            $pdf->SetY($y_pos+18);  
            //$pdf->Cell(196,5,$dataResi->Konid,0,1,C);

            //$pdf->Cell(196,5,"AIRWAYBILL",0,1,C);
            $pdf->Cell(190,5,"",0,1,C);


            $ye=$pdf->GetY();



            //=========================== D A T A   P E N G I R I M ===================================

            $pdf->SetFont('Arial','B',8);
            // $pdf->Cell(15,5,"",0,1,L);
            $pdf->Cell(15,5,"Shipper/Pengirim :",0,1,L);
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(60,3,strtoupper($dataResi->namaPengirim),0,1,L);

            $barisTerima=$pdf->NbLines(65,strtoupper($dataResi->alamatPengirim1).' '.strtoupper($dataResi->alamatPengirim2));

            if($barisTerima > 1){

            $pdf->MultiCell(65,3,strtoupper($dataResi->alamatPengirim1),0,L);
            $pdf->MultiCell(65,3,strtoupper($dataResi->alamatPengirim2),0,L);

            }else{

            $pdf->Cell(65,3,strtoupper($dataResi->alamatPengirim1).' '.strtoupper($dataResi->alamatPengirim2),0,1,L);

            $pdf->Cell(65,3,"",0,1,L);

            }       
            
            
           
            $pdf->SetFont('Arial','',7);

            // $pdf->Cell(60,2.8,$dataResi->TujuanKota,0,1,L);
            //$pdf->Cell(60,2.8,strtoupper($dataResi->kotaPengirim).' '.strtoupper($dataResi->posPengirim).' ('.strtoupper($dataResi->Asal).')',0,1,L);

            $pdf->SetFont('Arial','',7);

            $pdf->Cell(60,2.8,'PHONE/TELP No. '.$dataResi->telpPengirim,0,1,L);

            $pdf->Cell(60,2,'',0,1,L);

           

            //=========================== D A T A   P E N E R I M A ===================================

            $pdf->SetFont('Arial','B',8);

            $pdf->Cell(15,5,"Consignee/Penerima :",0,1,L);

            $pdf->SetFont('Arial','',7);

            $pdf->Cell(60,3,strtoupper($dataResi->namaPenerima),0,1,L);

            $barisKirim=$pdf->NbLines(65,strtoupper($dataResi->alamatPenerima1).' '.strtoupper($dataResi->alamatPenerima2).' '.strtoupper($dataResi->TujuanKota));

            if($barisKirim > 1){

            $pdf->MultiCell(65,3,strtoupper($dataResi->alamatPenerima1).' '.strtoupper($dataResi->alamatPenerima2).' '.strtoupper($dataResi->TujuanKota),0,L);

            }else{

            $pdf->Cell(65,3,strtoupper($dataResi->alamatPenerima1).' '.strtoupper($dataResi->alamatPenerima2).' '.strtoupper($dataResi->TujuanKota),0,1,L);

            $pdf->Cell(65,3,"",0,1,L);

            }

            $pdf->SetFont('Arial','',7);


            $pdf->Cell(60,3,'PHONE/TELP No. '.$dataResi->telpPenerima,0,1,L);

            $pdf->Cell(60,3,'',0,1,L);

           


              //=========================== A L A M A T   K A N T O R ===================================

            $pdf->SetFont('Arial','',5.5);

            $pdf->Cell(60,2.3,"",0,1,L);

            $pdf->Cell(60,2.3,"",0,1,L);

            $pdf->Cell(60,2.3,"",0,1,L);

            $pdf->Cell(60,2.3,"",0,1,L);

            //LINE
            // 297
            $pdf->Line(114.5 + $x_pos, 45 + $y_pos, 114.5 + $x_pos, 75 + $y_pos); // vertical kanan

            $pdf->Line(114.5 + $x_pos, 45 + $y_pos, 202 + $x_pos, 45 + $y_pos); // horizontal atas

            $pdf->Line(202 + $x_pos, 45 + $y_pos, 202 + $x_pos, 75 + $y_pos); // vertical kiri

            $pdf->Line(114.5 + $x_pos, 75 + $y_pos, 202 + $x_pos, 75 + $y_pos); // horizontal bawah

            $pdf->Line(153 + $x_pos, 45 + $y_pos, 153 + $x_pos, 75 + $y_pos); // vertical Tengah
            

            //=========================== D A T A  B A R A N G ===================================

            $pdf->SetXY(115,$ye+53);

            $pdf->SetTextColor(0,0,0);

            $pdf->SetFont('Arial','B',8);

            $pdf->Cell(40,3,"Description of Shipment/Keterangan isi Kiriman :",0,1,L);

            //$pdf->SetFont('Arial','I',6.5);

            // $pdf->SetX(115);

            // $pdf->Cell(40,2,"",0,1,L);

            $pdf->SetFont('Arial','',8);

            $pdf->SetX(115);

            $pdf->SetTextColor(0,0,0);

            $pdf->Cell(40,4,$dataResi->Jenis_Barang,0,1,L);

            $pdf->SetTextColor(0,0,0);
             // $pdf->SetX(115);

            // $pdf->Cell(40,2,"",0,1,L);

            $pdf->SetFont('Arial','B',8);

            $pdf->SetX(115);

            $pdf->Cell(40,4,"Special Instruction/Instruksi Khusus :",0,1,L);

            $pdf->SetX(115);

            // $pdf->SetTextColor(0,0,0);
            $pdf->SetTextColor(255,0,0);

            $pdf->SetFont('Arial','',8);

            $pdf->MultiCell(89,3,$dataResi->Keterangan,0,L);//max 95 karakter, kalau lebih akan kecetak di kertas copy bawahnya

            $pdf->SetXY(115,$ye+5);


            
            $pdf->SetTextColor(0,0,0);
            $pdf->SetXY(115,$ye+23);
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(40,4,"Detail : ","",1,L);

            $pdf->SetX(115);

            // $pdf->SetFont('Arial','','');

            $pdf->Cell(10,4,'Koli : '.$dataResi->Koli." C","",1,L);

            
            // if($cek_dimensi->jml > 0){
            // foreach($db->fetch_custom("SELECT Volume,sum(Berat) as beratnya FROM log_dimensi WHERE Konid='$dataResi->Konid'") as $berat){
            //     $pdf->SetX(115);
            // $pdf->Cell(10,4,'Kilo : '.number_format($berat->beratnya,1)." Kg","",1,L);
            // $pdf->SetX(115);
            // $pdf->Cell(10,4,'Volume : '.ceil($berat->Volume)." Kg","",1,L);
            // }
            // }else{
                $pdf->SetX(115);
            $pdf->Cell(10,4,'Kilo : '.$dataResi->Kilo." Kg","",1,L); 
            $pdf->SetX(115);
            $pdf->Cell(10,4,'Volume : '.$dataResi->Volume." Kg","",1,L);
            // }
            
            $pdf->SetX(115);

            // $pdf->SetFont('Arial','','');

            

            $pdf->SetX(115);

            $yee=$pdf->GetY();

            $kilokoli="";

         $valome=$db->fetch_custom_single("SELECT * FROM em_konos_detail WHERE Konid='$dataResi->Konid'")->Volume;
             if($valome=='0.00'){
                        foreach($db->fetch_custom("SELECT * FROM log_dimensi WHERE Konid='$dataResi->Konid'") as $koli){
                        $kilokoli=$kilokoli."".floor($koli->Berat)."; ";
                        }

                        $pdf->MultiCell(50,3,$kilokoli,0,L);

                        $pdf->SetXY(115,$yee+10);
             }else{
                        //VOLUME
                        $pdf->SetX(115);
                        
                        $pdf->Cell(40,3,"Volume :",0,1,L);
                        foreach($db->fetch_custom("SELECT * FROM log_dimensi WHERE Konid='$dataResi->Konid'") as $koli){
                        $pdf->SetX(115);
                        if($koli->Volume!=0){
                       
                        $pdf->Cell(35,2,"(".$koli->Berat.")  ".floor($koli->Panjang)."x".floor($koli->Lebar)."x".floor($koli->Tinggi)."=".floor($koli->Volume)." Kg",0,2,L);
                         }else{

                         }
                        }
             }

         



            



          
            //=========================== D A T A  B I L L I N G ===================================

            //$pdf->SetXY(160,$ye+13);

            $pdf->SetXY(160,$ye+23);
            // $pdf->SetFont('Arial','','');

            //$pdf->Cell(15,4,"Pembayaran",0,0,L);

            $pdf->Cell(1,4,":",0,0,L);

            $pdf->SetFont('Arial','',7);

            //$pdf->Cell(35,4,$dataResi->billingType,0,1,L);

            // $pdf->SetFont('Arial','',6.5);

            $pdf->SetX(160);

            // if($dataResi->Jenis_Biaya==3){
                // $Tarif="-";
                // $Hargkg="-";
                //  $Biaya="-";
                // $Packing="-";
                // $Asuransi="-";
                // $Lain="-";
                // $Totbi="-";
            // }else{
                $Tarif=number_format($dataResi->Tarif);
                $Biaya=number_format($dataResi->Totbi-$dataResi->by_packing-$dataResi->by_lain-$dataResi->by_asuransi);
                $Hargkg=number_format($dataResi->Tarif);
                $Packing=number_format($dataResi->by_packing);
                $Asuransi=number_format($dataResi->by_asuransi);
                $Lain=number_format($dataResi->by_lain);
                $Discount=number_format($dataResi->discount);
                $Totbi=number_format($dataResi->Totbi);
            // }

            // $pdf->Cell(15,4,"x Rp. ".$Tarif,0,0,L);

            // $pdf->Cell(5,4,": Rp. ",0,0,L);

            // $pdf->Cell(25,4,$Biaya,0,1,R);


            if($dataResi->Jenis_Biaya==2){

            $pdf->SetX(155);
            $pdf->Cell(15,3,"Declare Value/Nilai Kiriman :",0,0,L);
            $pdf->Cell(15,3,"",0,0,L);

            $pdf->Cell(5,3,"",0,0,L);

            // if($x==1){

            $pdf->Cell(25,3,"",0,1,R);

            $pdf->SetX(155);


            $pdf->Cell(15,3,"Harga/Kg",0,0,L);

            $pdf->Cell(5,3,": Rp. ",0,0,L);

            // if($x==2){
            // if($dataResi->Jenis_Biaya==3 || $dataResi->Jenis_Biaya==4){
            //     $pdf->Cell(25,4,'0',0,1,R);
            // }else{
                $pdf->Cell(25,3,$Hargkg,0,1,R);
            // }
            

            // }else{

            // $pdf->Cell(25,4,'',0,1,R);  

            // }

            $pdf->SetX(155);

            $pdf->Cell(15,3,"Packing",0,0,L);

            $pdf->Cell(5,3,": Rp. ",0,0,L);

            // if($x==2){

            // if($dataResi->Jenis_Biaya==3 || $dataResi->Jenis_Biaya==4){
            //     $pdf->Cell(25,4,'0',0,1,R);
            // }else{
                $pdf->Cell(25,3,$Packing,0,1,R);
            // }

            // }else{

            // $pdf->Cell(25,4,'',0,1,R);  

            // }
            

            $pdf->SetX(155);

            $pdf->Cell(15,3,"Asuransi",0,0,L);

            $pdf->Cell(5,3,": Rp. ",0,0,L);

            // if($x==2){

            // $pdf->Cell(25,4,$Asuransi,0,1,R);
            // if($dataResi->Jenis_Biaya==3 || $dataResi->Jenis_Biaya==4){
            //     $pdf->Cell(25,4,'0',0,1,R);
            // }else{
                $pdf->Cell(25,3,$Asuransi,0,1,R);
            // }


            // }else{

            // $pdf->Cell(25,4,'',0,1,R);  

            // }
           

            $pdf->SetX(155);

            $pdf->Cell(15,3,"Lain-lain","",0,L);

            $pdf->Cell(5,3,": Rp. ","",0,L);

            // if($x==2){

            // $pdf->Cell(25,4,$Lain,"",1,R);
            // if($dataResi->Jenis_Biaya==3 || $dataResi->Jenis_Biaya==4){
            //     $pdf->Cell(25,4,'0',0,1,R);
            // }else{
                $pdf->Cell(25,3,$Lain,0,1,R);

            if($dataResi->discount!=0){
                $pdf->SetX(155);
                $pdf->Cell(15,3,"Discount","",0,L);
                $pdf->Cell(5,3,": ","",0,L);
                $pdf->Cell(25,3,$Discount.'%',0,1,R);
            }

            if($dataResi->ppn!=0){
                    $pdf->SetX(155);
                    //keterangan ppn
                    $pdf->Cell(15,3,"PPN ".$dataResi->ppn."%","",0,L);

                    $pdf->Cell(5,3,": Rp. ","",0,L);
                    $pdf->Cell(25,3,$dataResi->Tot_PPH,0,1,R);   
                }
        


            // }

            // }else{

            // $pdf->Cell(25,4,'',"",1,R);

            // }

            //nilai COD
            // if($dataResi->Jenis_Biaya==3){
            //     $pdf->SetX(155);

            //     $pdf->Cell(15,4,"Harga COD","",0,L);

            //     $pdf->Cell(5,4,": Rp. ","",0,L);
            //     $pdf->Cell(25,4,number_format($dataResi->nilaiCod),0,1,R);
            // }


            $pdf->Line(155 + $x_pos, 69.5 + $y_pos, 200 + $x_pos, 69.5 + $y_pos); // horizontal //

            $pdf->Text($x_pos+160,$y_pos+73,"Total");
            $pdf->Text($x_pos+171,$y_pos+73,": Rp. ");
            // if($x==1){

            // $pdf->setXY(175 + $x_pos,69.5 + $y_pos);
            // if($dataResi->Jenis_Biaya==3){
            //     $pdf->setXY(175 + $x_pos,69.5 + $y_pos);
            //     $pdf->Cell(30,5,'',0,0,"R");
            // }else
            if($dataResi->Jenis_Biaya==3){
                $pdf->setXY(170 + $x_pos,69.5 + $y_pos);
                $pdf->Cell(30,5,number_format($dataResi->nilaiCod),0,0,"R"); 
            }else{
                $pdf->setXY(170 + $x_pos,69.5 + $y_pos);
                $pdf->Cell(30,5,$Totbi,0,0,"R"); 
            }
            


            // }else{

            // $pdf->Cell(30,5,"",0,0,"R");
            // }

            // $pdf->Text(155,$y_pos+60,$Totbi);

            // $pdf->SetX(155);

            // $pdf->SetFont("Arial","B","");

            // $pdf->Cell(15,$y_pos+22,"Total",0,0,L);

            // $pdf->Cell(5,$y_pos+22,": Rp. ",0,0,L);


            // if($x==2){

            // $pdf->Cell(25,$y_pos+22,$Totbi,0,1,R);


            // }else{

            // $pdf->Cell(25,$y_pos+22,'',0,1,R);


            // }

            }else{
            $pdf->SetX(155);
            $pdf->Cell(15,3,"Declare Value/Nilai Kiriman :",0,0,L);
            
              $pdf->Cell(15,3,"",0,0,L);

            $pdf->Cell(5,3,"",0,0,L);

            // if($x==1){

            $pdf->Cell(25,3,"",0,1,R);
            
            $pdf->SetX(155);
            $pdf->Cell(15,3,"Harga/Kg",0,0,L);

            $pdf->Cell(5,3,": Rp. ",0,0,L);

            // if($x==1){

            // if($dataResi->Jenis_Biaya==3 || $dataResi->Jenis_Biaya==4){
            //     $pdf->Cell(25,4,'0',0,1,R);
            // }else{
                $pdf->Cell(25,3,$Hargkg,0,1,R);
            // }

            // }else{

            // $pdf->Cell(25,4,'',0,1,R);  

            // }


            $pdf->SetX(155);

            $pdf->Cell(15,3,"Packing",0,0,L);

            $pdf->Cell(5,3,": Rp. ",0,0,L);

            // if($x==1){

            // $pdf->Cell(25,4,$Packing,0,1,R);
            // if($dataResi->Jenis_Biaya==3 || $dataResi->Jenis_Biaya==4){
            //     $pdf->Cell(25,4,'0',0,1,R);
            // }else{
                $pdf->Cell(25,3,$Packing,0,1,R);
            // }

            // }else{

            // $pdf->Cell(25,4,'',0,1,R);  

            // }
            

            $pdf->SetX(155);

            $pdf->Cell(15,3,"Asuransi",0,0,L);

            $pdf->Cell(5,3,": Rp. ",0,0,L);

            // if($x==1){

            // $pdf->Cell(25,4,$Asuransi,0,1,R);
            // if($dataResi->Jenis_Biaya==3 || $dataResi->Jenis_Biaya==4){
            //     $pdf->Cell(25,4,'0',0,1,R);
            // }else{
                $pdf->Cell(25,3,$Asuransi,0,1,R);
            // }

            // }else{

            // $pdf->Cell(25,4,'',0,1,R);  

            // }
           

            $pdf->SetX(155);

            $pdf->Cell(15,3,"Lain-lain","",0,L);

            $pdf->Cell(5,3,": Rp. ","",0,L);

            // if($x==1){

            // $pdf->Cell(25,4,$Lain,"",1,R);
            // if($dataResi->Jenis_Biaya==3 || $dataResi->Jenis_Biaya==4){
            //     $pdf->Cell(25,4,'0',0,1,R);
            // }else{
                $pdf->Cell(25,3,$Lain,0,1,R);
            // }

if($dataResi->discount!=0){
                $pdf->SetX(155);
                $pdf->Cell(15,3,"Discount","",0,L);
                $pdf->Cell(5,3,": ","",0,L);
                $pdf->Cell(25,3,$Discount.'%',0,1,R);
            }

            // if($dataResi->ppn!=0){
            //         $pdf->SetX(155);
            //         //keterangan ppn
            //         $pdf->Cell(15,4,"PPN ".$dataResi->ppn."%","",0,L);

            //         $pdf->Cell(5,4,": Rp. ","",0,L);
            //         $pdf->Cell(25,4,$dataResi->Tot_PPH,0,1,R);   
            //     }

            //harga COD
            if($dataResi->Jenis_Biaya==3){
                // $pdf->SetX(155);

                // $pdf->Cell(15,4,"Harga COD","",0,L);

                // $pdf->Cell(5,4,": Rp. ","",0,L);
                // $pdf->Cell(25,4,number_format($dataResi->nilaiCod),0,1,R);

                
            }

            if($dataResi->ppn!=0){
                    $pdf->SetX(155);
                    //keterangan ppn
                    $pdf->Cell(15,3,"PPN ".$dataResi->ppn."%","",0,L);

                    $pdf->Cell(5,3,": Rp. ","",0,L);
                    $pdf->Cell(25,3,$dataResi->Tot_PPH,0,1,R);   
                }

            // }else{

            // $pdf->Cell(25,4,'',"",1,R);

            // }

            $pdf->Line(155 + $x_pos, 69.5 + $y_pos, 200 + $x_pos, 69.5 + $y_pos); // horizontal //

            $pdf->Text($x_pos+156,$y_pos+73,"Total");
            $pdf->Text($x_pos+171,$y_pos+73,": Rp. ");
            // if($x==1){

            // if($dataResi->Jenis_Biaya==3){
            //     $pdf->setXY(175 + $x_pos,69.5 + $y_pos);
            //     $pdf->Cell(30,5,'',0,0,"R");
            // }else
            // if($dataResi->Jenis_Biaya==3){
            //     $pdf->setXY(170 + $x_pos,69.5 + $y_pos);
            //     $pdf->Cell(30,5,number_format($dataResi->nilaiCod),0,0,"R");
            // }else{
                $pdf->setXY(170 + $x_pos,69.5 + $y_pos);
               $pdf->Cell(30,5,$Totbi,0,0,"R"); 
            // }


            // }else{

            // $pdf->Cell(30,5,"",0,0,"R");
            // }

            // $pdf->SetX(155);

            // $pdf->SetFont("Arial","B","");

            // $pdf->Cell(15,4,"Total",0,0,L);

            // $pdf->Cell(5,4,": Rp. ",0,0,L);


            // if($x==1){

            // $pdf->Cell(25,4,$Totbi,0,1,R);


            // }else{

            // $pdf->Cell(25,4,'',0,1,R);


            // }

            }

            

            
            




            //=========================== F O O T E R ===================================

            $pdf->SetXY($x_pos+150,$y_pos+68);

            $pdf->SetTextColor(0,0,0);

            $pdf->SetFont("Arial","B",6.4);

            // $pdf->Cell(85,2.5,"PASTIKAN BARANG KIRIMAN DIPACKING DENGAN BAIK DAN BENAR",0,1,C);

            $pdf->SetFont("Arial","",6);

            $pdf->SetX(42);
            $pdf->Cell(95,2.5,"PAKET EXPRESS",0,1,C);
            $pdf->SetX(42);
            $pdf->Cell(95,2.5,"Dengan menyerahkan kiriman,",0,1,C);
            $pdf->SetX(42);
            $pdf->Cell(95,2.5,"Anda setuju dengan ketentuan dan kondisi",0,1,C);
            $pdf->SetX(42);
            $pdf->Cell(95,2.5,"pada nota pengiriman ini tanpa syarat,",0,1,C);
            $pdf->SetX(42);
            $pdf->Cell(95,2.5,"termasuk ketentuan dan kondisi yang tertera pada",0,1,C);
            $pdf->SetX(42);
            $pdf->Cell(95,2.5,"halaman website ".$comp->website,0,1,C);

            $pdf->SetXY($x_pos+7,$y_pos+57.9);

            $pdf->SetTextColor(0,0,0);

            $pdf->SetFont("Arial","B",7);
            $pdf->Cell(25,25,"Shipper Sign",0,0,L);

            $pdf->Cell(25,25,"     Receiver Sign",0,0,L);

            // $pdf->Cell(40,2.5,"Terima Kasih Telah Menjadi Mitra Kami",0,1,L);

            $pdf->Cell(40,20,"",0,1,L);

            $pdf->SetX(7);

            $pdf->Cell(50,10,"",0,0,L);

            // $pdf->Cell(40,10,ucwords(strtolower($dataResi->first_name)),0,1,L);


            $pdf->ln(3.5);

            $pdf->SetX(7);

            $pdf->Cell(25,10,"Date : ".date("d/m/Y",strtotime($dataResi->tanggal)),0,0,L);

            $pdf->Cell(25,10,"     Date : ",0,0,L);
            $pdf->Cell(25,10,"           Pickup By/Diambil oleh : ".$dataResi->kurirName,0,0,L);

            $pdf->Cell(40,5,"",0,1,L);

            $pdf->SetX(7);

            $pdf->Cell(25,7,"Name & Stamp",0,0,L);

            $pdf->Cell(25,7,"     Name & Stamp",0,0,L);
            $pdf->Cell(25,7,"           Date/Time : ",0,0,L);
            
            $pdf->SetFont("Arial","",6);
            $pdf->Text($x_pos+130, $y_pos+95, 'Entry Date/Time : '.$dataResi->createDate.'    by : '.$dataResi->first_name.' '.$dataResi->last_name);
             //$pdf->Cell(40,2.5,$comp->website,0,1,L);
            if ($x!=3) {
                 $pdf->Text($x_pos+8, $y_pos+100, '---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');
            }
           


            if($dataResi->Satuan==1 || $dataResi->Satuan==3){

            // $pdf->Image('../logo.jpeg',169,$y_pos+63.4,20,'','','');//LOGO

            }else{

             // $pdf->Image('../logo.jpeg',168,$y_pos+62.4,20,'','','');//LOGO

            }

           



           
            // if($x==1){
            // $y_pos+=84;
            // }else if($x==2){
            // $y_pos+=84;
            // }else if($x==3){
            // $y_pos+=79;
            // }

            $y_pos+=95;

            $x++;
            
}        
        // $pdf->AutoPrint();

        $pdf->Output(); 


?>
