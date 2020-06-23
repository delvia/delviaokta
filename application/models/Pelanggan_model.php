<?php

class Pelanggan_model extends CI_Model{

   
   public function __construct()
   {
       parent::__construct();
       //Do your magic here
       $this->load->database();
   }
   
   //listing all pelanggan
   public function listing()
   {
       $this->db->select('pelanggan.*,
                        users.email,
                        users.password');
       $this->db->from('pelanggan');
       $this->db->join('users', 'users.id_user = pelanggan.id_user', 'left');
       $this->db->group_by('pelanggan.id_pelanggan');
        $this->db->order_by('id_pelanggan', 'desc');
       $query = $this->db->get();
       return $query->result();
   }

    //login pelanggan
    public function login($email,$password)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        
        //end join
       
        $this->db->where(array ('email'     => $email,
                                'password'  => SHA1($password)
                            ));
         $this->db->order_by('id_pelanggan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }

    // sudahlogin
    public function sudah_login($email,$nama_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where(array ('email'           => $email,
                                'nama_pelanggan'  => $nama_pelanggan
                            ));
         $this->db->order_by('id_pelanggan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }
 
    //detail pelanggan
    public function detail($id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);
         $this->db->order_by('id_Pelanggan', 'desc');
        $query = $this->db->get();
        return $query->row();
    }


   //tambah
    public function tambah($data)

    {
        $this->db->insert('pelanggan', $data);
    }


    //delete

    public function delete($data)
    {
        $this->db->where('id_pelanggan', $data['id_pelanggan']);
        $this->db->delete('pelanggan', $data);
    }

    //edit
    public function edit($data)
    {
        $this->db->where('id_pelanggan', $data['id_pelanggan']);
        $this->db->update('pelanggan', $data);
    }






}