<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class M_pilih extends CI_Model {
        public function get_provinsi()
        {
            $this->db->order_by('provinsi_nama', 'asc');
            return $this->db->get('provinsi')->result();
        }
        public function get_kota()
        {
            // kita joinkan tabel kota dengan provinsi
            $this->db->order_by('kota_nama', 'asc');
            $this->db->join('provinsi', 'kota.kota_provinsi = provinsi.provinsi_id');
            return $this->db->get('kota')->result();
        }
        // untuk edit ambil dari id level paling bawah
        public function get_selected_by_id_kecamatan($id_kecamatan)
        {
            $this->db->where('id_kecamatan', $id_kecamatan);
            $this->db->join('kota', 'kecamatan.id_kota_fk = kota.id_kota');
            $this->db->join('provinsi', 'kota.kota_provinsi = provinsi.provinsi_id');
            return $this->db->get('kecamatan')->row();
        }
    }