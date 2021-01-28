<?php
class Admin_model extends CI_model
{
    public function getAdmin()
    {
        return $this->db->get_where('user', [
                'username' => $this->session->userdata('username'),
                'role_id' => $this->session->userdata('role_id'),
                'id_user' => $this->session->userdata('id_user'),
            ])
            ->result_array();
    }
    

    public function getAllPesanan()
    {
        $this->db->select('*, SUM(jumlah_barang) jmlBarang');
        $this->db->from('pembayaran');
        $this->db->join('pemesanan', 'pembayaran.id_bayar = pemesanan.id_bayar');
        $this->db->join('kategori', 'pemesanan.id_kategori = kategori.id_kategori');
        $this->db->join('user', 'user.id_user = pemesanan.id_user');
        $this->db->where('pemesanan.id_bayar !=', 0);
        $this->db->group_by('pemesanan.id_bayar');
        return $this->db->get()->result_array();
    }

    public function getDetailPesanan($idbayar)
    {
        $this->db->select('*');
        $this->db->from('pemesanan');
        $this->db->join('kategori', 'pemesanan.id_kategori = kategori.id_kategori');
        $this->db->join('user', 'user.id_user = pemesanan.id_user');
        $this->db->where('pemesanan.id_bayar =', $idbayar);
        return $this->db->get()->result_array();
    }

    public function tolakatauterima($data, $id)
    {
        $this->db->where('id_bayar', $id);
        $this->db->update('pemesanan', $data);
    }

    public function getJmlKonsum()
    {
        $query = $this->db->query(
            'SELECT count(username) jml from user where role_id <> 5'
        );

        return $query->row();
    }

    public function getJmlVendor()
    {
        $query = $this->db->query("SELECT count(id_pesanan) jml from pemesanan where status_pesanan NOT IN ('dibatalkan', 'di dalam keranjang')");

        return $query->row();
    }

    public function getJmlBarang()
    {
        $query = $this->db->query('SELECT count(idbarang) jml from barang');

        return $query->row();
    }

    public function getAllKonsum()
    {
        return $this->db->get('konsumen')->result_array();
    }

    public function getAllVendor()
    {
        return $this->db->get('vendor')->result_array();
    }
    public function getAllBarang()
    {
        return $this->db->get('kategori')->result_array();
    }

    public function getAllDataBarang($idKategori)
    {
        $this->db->select('*');
        $this->db->from('pakaiian');
        $this->db->join('kategori', 'pakaiian.id_kategori = kategori.id_kategori');
        $this->db->where('pakaiian.id_kategori', $idKategori);
        return $this->db->get()->result_array();
    }

    public function getBarang($id)
    {
        $this->db->select('*');
        $this->db->from('pakaiian');
        $this->db->join('kategori', 'pakaiian.id_kategori = kategori.id_kategori');
        $this->db->where('id_pakaiian', $id);
        return $this->db->get()->row();
    }

    public function getAllKategori()
    {
        $this->db->select('*');
        $this->db->from('kategori');
        return $this->db->get()->result_array();
    }

    public function getNamaKategori($id)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->where('id_kategori =', $id);
        return $this->db->get()->result_array();
    }

    public function getAllNamaKategori()
    {
        $this->db->select('nama_kategori');
        $this->db->from('kategori');
        return $this->db->get()->result_array();
    }

    public function addKategori($data)
    {
        $this->db->insert('kategori', $data);
    }

    public function add_Barang($data)
    {
        $this->db->insert('pakaiian', $data);
    }

    public function update_Barang($id, $data)
    {
        $this->db->where('id_pakaiian', $id);
        $this->db->update('pakaiian', $data);
    }

    public function delete_barang($id)
    {
        $this->db->where('id_pakaiian', $id);
        $this->db->delete('pakaiian');
    }

    public function getPesanan($id)
    {
        $this->db->select('*');
        $this->db->from('pemesanan');
        $this->db->join('user', 'pemesanan.id_user = user.id_user');
        $this->db->join('kategori', 'pemesanan.id_kategori = kategori.id_kategori');
        $this->db->where('id_pesanan', $id);
        return $this->db->get()->result_array();
    }

    public function addTable($namaTable)
    {
        $query = $this->db->query(
            'CREATE TABLE ' .
                $namaTable .
                " (
				ID int NOT NULL AUTO_INCREMENT,
				ID_Kategori int(11),
				kualitas varchar(255),
				PRIMARY KEY (ID)
			)"
        );
    }
}