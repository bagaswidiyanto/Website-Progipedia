<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Katalogbarangprogi extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_katalog');
    }
    public function index()
    {
        $katalog=$this->m_katalog->showData($this->session->userdata("userID"))->result();
        $this->data['katalog'] = $katalog;


        $this->web = 'content/progi/v_katalog_barang';
        $this->dashboard();
    }

    public function add()
    {
        $this->web = 'content/progi/v_katalog_barang_add';
        $this->dashboard();
    }

    public function actAdd()
    {
        $nama=$this->input->post("namaBarang");
        $jenis=$this->input->post("jenisBarang");
        $ket=$this->input->post("keterangan");
        $berat=$this->input->post("berat");
        $jml=$this->input->post("jumlahBarang");
        $nilai=$this->input->post("nilaiBarang");
        $panjang=$this->input->post("panjang");
        $lebar=$this->input->post("lebar");
        $tinggi=$this->input->post("tinggi");
        $userID=$this->session->userdata("userID");

        $data = array(
            'userID'=>$userID,
            'namaBarang' =>$nama , 
            'jenisBarang' =>$jenis , 
            'keterangan' =>$ket , 
            'berat' =>$berat , 
            'jumlahBarang' =>$jml , 
            'nilaiBarang' =>$nilai , 
            'panjang' =>$panjang , 
            'lebar' =>$lebar , 
            'tinggi' =>$tinggi,
            'status'=>'Y',
            'createdUserID'=>$userID
        );

        if ($this->m_katalog->addKatalog($data)) {
            echo "good";
        }else{
            return false;
        }
    }

    public function showData()
    {
        $id=$this->input->post("id");
        $katalog=$this->m_katalog->showDetail($id)->row();
        $data['namaBarang']=$katalog->namaBarang;
        $data['jenisBarang']=$katalog->jenisBarang;
        $data['keterangan']=$katalog->keterangan;
        $data['berat']=$katalog->berat;
        $data['jumlahBarang']=$katalog->jumlahBarang;
        $data['nilaiBarang2']=number_format($katalog->nilaiBarang);
        $data['nilaiBarang']=$katalog->nilaiBarang;
        $data['panjang']=$katalog->panjang;
        $data['lebar']=$katalog->lebar;
        $data['tinggi']=$katalog->tinggi;
        echo json_encode($data);
    }


    public function actEdit()
    {
        $nama=$this->input->post("namaBarang");
        $jenis=$this->input->post("jenisBarang");
        $ket=$this->input->post("keterangan");
        $berat=$this->input->post("berat");
        $jml=$this->input->post("jumlahBarang");
        $nilai=$this->input->post("nilaiBarang");
        $panjang=$this->input->post("panjang");
        $lebar=$this->input->post("lebar");
        $tinggi=$this->input->post("tinggi");
        $id=$this->input->post("id");
        $userID=$this->session->userdata("userID");

        $data = array(
            'namaBarang' =>$nama , 
            'jenisBarang' =>$jenis , 
            'keterangan' =>$ket , 
            'berat' =>$berat , 
            'jumlahBarang' =>$jml , 
            'nilaiBarang' =>$nilai , 
            'panjang' =>$panjang , 
            'lebar' =>$lebar , 
            'tinggi' =>$tinggi,
            'status'=>'Y',
            'modifiedUserID'=>$userID
        );

        if ($this->m_katalog->upKatalog($data,$id)) {
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
            'status'=>'N',
            'modifiedUserID'=>$userID
        );

        if ($this->m_katalog->upKatalog($data,$id)) {
            echo "good";
        }else{
            return false;
        }
    }
}