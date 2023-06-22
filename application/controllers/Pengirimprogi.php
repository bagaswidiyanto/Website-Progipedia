<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pengirimprogi extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_pengirim');
    }
    public function index()
    {
        $pengirim=$this->m_pengirim->showPengirim($this->session->userdata("userID"))->result();
        $this->data['pengirim'] = $pengirim;


        $this->web = 'content/progi/v_pengirim';
        $this->dashboard();
    }

    public function add()
    {
        $this->web = 'content/progi/v_pengirim_add';
        $this->dashboard();
    }

    public function actAdd()
    {
        $judul=$this->input->post("judul");
        $nama=$this->input->post("namaPengirim");
        $telp=$this->input->post("telp");
        $kecID=$this->input->post("kecamatanID");
        $alamat=$this->input->post("alamat");
        $status=$this->input->post("statusUtama");
        $userID=$this->session->userdata("userID");
        if (isset($status)) {
            $statusUtama='Y';
        }else{
            $statusUtama='N';
        }


        $data = array(
            'userID'=>$userID,
            'judul' =>$judul , 
            'namaPengirim' =>$nama , 
            'telp' =>$telp , 
            'kecamatanID' =>$kecID , 
            'alamat' =>$alamat , 
            'statusUtama' =>$statusUtama ,
            'createdUserID'=>$userID
        );

        if ($this->m_pengirim->addPengirim($data,$statusUtama,$userID)) {
            echo "good";
        }else{
            return false;
        }
    }

    public function showData()
    {
        $id=$this->input->post("id");
        $katalog=$this->m_pengirim->showDetail($id)->row();
        $data['judul']=$katalog->judul;
        $data['namaPengirim']=$katalog->namaPengirim;
        $data['telp']=$katalog->telp;
        $data['kecamatanID']=$katalog->kecamatanID;
        $data['alamat']=$katalog->alamat;
        $data['statusUtama']=$katalog->statusUtama;
        echo json_encode($data);
    }


    public function actEdit()
    {
        $id=$this->input->post("id");
        $judul=$this->input->post("judul");
        $nama=$this->input->post("namaPengirim");
        $telp=$this->input->post("telp");
        $kecID=$this->input->post("kecamatanID");
        $alamat=$this->input->post("alamat");
        $status=$this->input->post("statusUtama");
        $userID=$this->session->userdata("userID");
        if (isset($status)) {
            $statusUtama='Y';
        }else{
            $statusUtama='N';
        }
        $data = array(
            'judul' =>$judul , 
            'namaPengirim' =>$nama , 
            'telp' =>$telp ,
            'alamat' =>$alamat , 
            'statusUtama' =>$statusUtama ,
            'modifiedUserID'=>$userID
        );

        if ($kecID!="") {
         $kec=array("kecamatanID"=>$kecID);
         $data=array_merge($data,$kec);
        }
        

        if ($this->m_pengirim->upPengirim($data,$id,$statusUtama,$userID)) {
            echo "good";
        }else{
            return false;
        }
    }

    public function actDelete()
    {
        $id=$this->input->post("id");
        $userID=$this->session->userdata("userID");

        $data = array(
            'statusUtama'=>'Y',
            'modifiedUserID'=>$userID
        );

        if ($this->m_pengirim->upPengirim($data,$id,'Y',$userID)) {
            echo "good";
        }else{
            return false;
        }
    }
}