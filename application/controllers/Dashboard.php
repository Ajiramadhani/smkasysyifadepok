<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('m_data');
		$this->load->library('form_validation');

		// cek session yang login, 
		// jika session status tidak sama dengan session telah_login, berarti pengguna belum login
		// maka halaman akan di alihkan kembali ke halaman login.
		if ($this->session->userdata('status') != "telah_login") {
			redirect(base_url() . 'login?alert=belum_login');
		}
	}

	public function index()
	{
		// hitung jumlah artikel
		$data['jumlah_artikel'] = $this->m_data->get_data('artikel')->num_rows();
		// hitung jumlah kategori
		$data['jumlah_kategori'] = $this->m_data->get_data('kategori')->num_rows();
		// hitung jumlah pengguna
		$data['jumlah_siswa'] = $this->m_data->get_data('pendaftaran')->num_rows();
		// hitung jumlah halaman
		$data['jumlah_halaman'] = $this->m_data->get_data('halaman')->num_rows();
		// hitung jumlah guru
		$data['jumlah_guru'] = $this->m_data->get_data('guru')->num_rows();

		$data['kategori'] = $this->m_data->get_data('kategori')->result();

		$this->load->view('dashboard/v_header', $data);
		$this->load->view('dashboard/v_index', $data);
		$this->load->view('dashboard/v_footer', $data);
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect('login?alert=logout');
	}

	public function ganti_password()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_ganti_password');
		$this->load->view('dashboard/v_footer');
	}

	public function ganti_password_aksi()
	{

		// form validasi
		$this->form_validation->set_rules('password_lama', 'Password Lama', 'required');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'required|min_length[8]');
		$this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password Baru', 'required|matches[password_baru]');

		// cek validasi
		if ($this->form_validation->run() != false) {

			// menangkap data dari form
			$password_lama = $this->input->post('password_lama');
			$password_baru = $this->input->post('password_baru');
			$konfirmasi_password = $this->input->post('konfirmasi_password');

			// cek kesesuaian password lama dengan id pengguna yang sedang login dan password lama
			$where = array(
				'pengguna_id' => $this->session->userdata('id'),
				'pengguna_password' => md5($password_lama)
			);
			$cek = $this->m_data->cek_login('pengguna', $where)->num_rows();

			// cek kesesuaikan password lama
			if ($cek > 0) {

				// update data password pengguna
				$w = array(
					'pengguna_id' => $this->session->userdata('id')
				);
				$data = array(
					'pengguna_password' => md5($password_baru)
				);
				$this->m_data->update_data($where, $data, 'pengguna');

				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=sukses');
			} else {
				// alihkan halaman kembali ke halaman ganti password
				redirect('dashboard/ganti_password?alert=gagal');
			}
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_ganti_password');
			$this->load->view('dashboard/v_footer');
		}
	}

	// CRUD KATEGORI
	public function kategori()
	{
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_aksi()
	{
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');

		if ($this->form_validation->run() != false) {

			$kategori = $this->input->post('kategori');

			$data = array(
				'kategori_nama' => $kategori,
				'kategori_slug' => strtolower(url_title($kategori))
			);

			$this->m_data->insert_data($data, 'kategori');

			redirect(base_url() . 'dashboard/kategori');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kategori_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kategori_edit($id)
	{
		$where = array(
			'kategori_id' => $id
		);
		$data['kategori'] = $this->m_data->edit_data($where, 'kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kategori_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kategori_update()
	{
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$kategori = $this->input->post('kategori');

			$where = array(
				'kategori_id' => $id
			);

			$data = array(
				'kategori_nama' => $kategori,
				'kategori_slug' => strtolower(url_title($kategori))
			);

			$this->m_data->update_data($where, $data, 'kategori');

			redirect(base_url() . 'dashboard/kategori');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'kategori_id' => $id
			);
			$data['kategori'] = $this->m_data->edit_data($where, 'kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kategori_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function kategori_hapus($id)
	{
		$where = array(
			'kategori_id' => $id
		);

		$this->m_data->delete_data($where, 'kategori');

		redirect(base_url() . 'dashboard/kategori');
	}
	// END CRUD KATEGORI

	// CRUD PROVINSI
	public function provinsi()
	{
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_provinsi', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function provinsi_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_provinsi_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function provinsi_aksi()
	{
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');

		if ($this->form_validation->run() != false) {

			$provinsi = $this->input->post('provinsi');

			$data = array(
				'provinsi_nama' => $provinsi,
			);

			$this->m_data->insert_data($data, 'provinsi');

			redirect(base_url() . 'dashboard/provinsi');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_provinsi_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function provinsi_edit($id)
	{
		$where = array(
			'provinsi_id' => $id
		);
		$data['provinsi'] = $this->m_data->edit_data($where, 'provinsi')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_provinsi_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function provinsi_update()
	{
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$provinsi = $this->input->post('provinsi');

			$where = array(
				'provinsi_id' => $id
			);

			$data = array(
				'provinsi_nama' => $provinsi,
			);

			$this->m_data->update_data($where, $data, 'provinsi');

			redirect(base_url() . 'dashboard/provinsi');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'provinsi_id' => $id
			);
			$data['provinsi'] = $this->m_data->edit_data($where, 'provinsi')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_provinsi_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function provinsi_hapus($id)
	{
		$where = array(
			'provinsi_id' => $id
		);

		$this->m_data->delete_data($where, 'provinsi');

		redirect(base_url() . 'dashboard/provinsi');
	}
	// END CRUD PROVINSI

	// CRUD KATEGORI GALERI
	public function kat_galeri()
	{
		$data['kat_galeri'] = $this->m_data->get_data('kat_galeri')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/galeri/v_kat_galeri', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kat_galeri_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/galeri/v_kat_galeri_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function kat_galeri_aksi()
	{
		$this->form_validation->set_rules('kat_galeri', 'Nama Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$kat_galeri = $this->input->post('kat_galeri');

			$data = array(
				'kat_galeri_nama' => $kat_galeri,
			);

			$this->m_data->insert_data($data, 'kat_galeri');

			redirect(base_url() . 'dashboard/kat_galeri');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/galeri/v_kat_galeri_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kat_galeri_edit($id)
	{
		$where = array(
			'kat_galeri_id' => $id
		);
		$data['kat_galeri'] = $this->m_data->edit_data($where, 'kat_galeri')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/galeri/v_kat_galeri_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kat_galeri_update()
	{
		$this->form_validation->set_rules('kat_galeri', 'Nama Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$kat_galeri = $this->input->post('kat_galeri');

			$where = array(
				'kat_galeri_id' => $id
			);

			$data = array(
				'kat_galeri_nama' => $kat_galeri,
			);

			$this->m_data->update_data($where, $data, 'kat_galeri');

			redirect(base_url() . 'dashboard/kat_galeri');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'kat_galeri_id' => $id
			);
			$data['kat_galeri'] = $this->m_data->edit_data($where, 'kat_galeri')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/galeri/v_kat_galeri_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function kat_galeri_hapus($id)
	{
		$where = array(
			'kat_galeri_id' => $id
		);

		$this->m_data->delete_data($where, 'kat_galeri');

		redirect(base_url() . 'dashboard/kat_galeri');
	}
	// END CRUD KATEGORI GALERI

	// CRUD JURUSAN
	public function jurusan()
	{
		$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_jurusan', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function jurusan_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_jurusan_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function jurusan_aksi()
	{
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

		if ($this->form_validation->run() != false) {

			$jurusan = $this->input->post('jurusan');

			$data = array(
				'jurusan_nama' => $jurusan,
			);

			$this->m_data->insert_data($data, 'jurusan');

			redirect(base_url() . 'dashboard/jurusan');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_jurusan_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function jurusan_edit($id)
	{
		$where = array(
			'jurusan_id' => $id
		);
		$data['jurusan'] = $this->m_data->edit_data($where, 'jurusan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_jurusan_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function jurusan_update()
	{
		$this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$jurusan = $this->input->post('jurusan');

			$where = array(
				'jurusan_id' => $id
			);

			$data = array(
				'jurusan_nama' => $jurusan,
			);

			$this->m_data->update_data($where, $data, 'jurusan');

			redirect(base_url() . 'dashboard/jurusan');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'jurusan_id' => $id
			);
			$data['jurusan'] = $this->m_data->edit_data($where, 'jurusan')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_jurusan_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function jurusan_hapus($id)
	{
		$where = array(
			'jurusan_id' => $id
		);

		$this->m_data->delete_data($where, 'jurusan');

		redirect(base_url() . 'dashboard/jurusan');
	}
	// END CRUD JURUSAN

	// CRUD PENDIDIKAN ORTU
	public function pendidikan()
	{
		$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_pendidikan', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pendidikan_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_pendidikan_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pendidikan_aksi()
	{
		$this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');

		if ($this->form_validation->run() != false) {

			$pendidikan = $this->input->post('pendidikan');

			$data = array(
				'pendidikan_nama' => $pendidikan,
			);

			$this->m_data->insert_data($data, 'pendidikan');

			redirect(base_url() . 'dashboard/pendidikan');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_pendidikan_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pendidikan_edit($id)
	{
		$where = array(
			'pendidikan_id' => $id
		);
		$data['pendidikan'] = $this->m_data->edit_data($where, 'pendidikan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_pendidikan_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pendidikan_update()
	{
		$this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$pendidikan = $this->input->post('pendidikan');

			$where = array(
				'pendidikan_id' => $id
			);

			$data = array(
				'pendidikan_nama' => $pendidikan,
			);

			$this->m_data->update_data($where, $data, 'pendidikan');

			redirect(base_url() . 'dashboard/pendidikan');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'pendidikan_id' => $id
			);
			$data['pendidikan'] = $this->m_data->edit_data($where, 'pendidikan')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_pendidikan_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function pendidikan_hapus($id)
	{
		$where = array(
			'pendidikan_id' => $id
		);

		$this->m_data->delete_data($where, 'pendidikan');

		redirect(base_url() . 'dashboard/pendidikan');
	}
	// END CRUD PENDIDIKAN ORTU

	// CRUD PENDAPATAN
	public function pendapatan()
	{
		$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_pendapatan', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pendapatan_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_pendapatan_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pendapatan_aksi()
	{
		$this->form_validation->set_rules('pendapatan', 'Pendapatan', 'required');

		if ($this->form_validation->run() != false) {

			$pendapatan = $this->input->post('pendapatan');

			$data = array(
				'pendapatan_nilai' => $pendapatan,
			);

			$this->m_data->insert_data($data, 'pendapatan');

			redirect(base_url() . 'dashboard/pendapatan');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_pendapatan_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pendapatan_edit($id)
	{
		$where = array(
			'pendapatan_id' => $id
		);
		$data['pendapatan'] = $this->m_data->edit_data($where, 'pendapatan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_pendapatan_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pendapatan_update()
	{
		$this->form_validation->set_rules('pendapatan', 'Pendapatan', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$pendapatan = $this->input->post('pendapatan');

			$where = array(
				'pendapatan_id' => $id
			);

			$data = array(
				'pendapatan_nilai' => $pendapatan,
			);

			$this->m_data->update_data($where, $data, 'pendapatan');

			redirect(base_url() . 'dashboard/pendapatan');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'pendapatan_id' => $id
			);
			$data['pendapatan'] = $this->m_data->edit_data($where, 'pendapatan')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_pendapatan_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function pendapatan_hapus($id)
	{
		$where = array(
			'pendapatan_id' => $id
		);

		$this->m_data->delete_data($where, 'pendapatan');

		redirect(base_url() . 'dashboard/pendapatan');
	}
	// END CRUD PENDAPATAN

	// CRUD PEKERJAAN
	public function pekerjaan()
	{
		$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_pekerjaan', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pekerjaan_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_pekerjaan_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pekerjaan_aksi()
	{

		$this->form_validation->set_rules('pekerjaan_nama', 'Nama Pekerjaan', 'required|is_unique[pekerjaan.pekerjaan_nama]', [
			'is_unique' => "Kategori Pekerjaan sudah tersedia !"
		]);

		if ($this->form_validation->run() != false) {

			$pekerjaan_nama = $this->input->post('pekerjaan_nama');

			$data = array(
				'pekerjaan_nama' => $pekerjaan_nama,
			);

			$this->m_data->insert_data($data, 'pekerjaan');

			redirect(base_url() . 'dashboard/pekerjaan');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_pekerjaan_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pekerjaan_edit($id)
	{
		$where = array(
			'pekerjaan_id' => $id
		);
		$data['pekerjaan'] = $this->m_data->edit_data($where, 'pekerjaan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_pekerjaan_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pekerjaan_update()
	{
		$this->form_validation->set_rules('pekerjaan_nama', 'Nama Pekerjaan', 'required|is_unique[pekerjaan.pekerjaan_nama]');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$pekerjaan_nama = $this->input->post('pekerjaan_nama');


			$where = array(
				'pekerjaan_id' => $id
			);

			$data = array(
				'pekerjaan_nama' => $pekerjaan_nama,
			);

			$this->m_data->update_data($where, $data, 'pekerjaan');

			redirect(base_url() . 'dashboard/pekerjaan');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'pekerjaan_id' => $id
			);
			$data['pekerjaan'] = $this->m_data->edit_data($where, 'pekerjaan')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_pekerjaan_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function pekerjaan_hapus($id)
	{
		$where = array(
			'pekerjaan_id' => $id
		);

		$this->m_data->delete_data($where, 'pekerjaan');

		redirect(base_url() . 'dashboard/pekerjaan');
	}
	// END CRUD PEKERJAAN

	// CRUD KOTA
	public function kota()
	{
		$data['kota'] = $this->db->query("SELECT * FROM kota,provinsi WHERE kota_provinsi=provinsi_id order by provinsi_nama ASC")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_kota', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kota_tambah()
	{
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_kota_tambah', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kota_aksi()
	{

		$this->form_validation->set_rules('kota', 'Kota', 'required');

		if ($this->form_validation->run() != false) {

			$kota = $this->input->post('kota');
			$provinsi = $this->input->post('provinsi');

			$data = array(
				'kota_nama' => $kota,
				'kota_provinsi' => $provinsi
			);

			$this->m_data->insert_data($data, 'kota');

			redirect(base_url() . 'dashboard/kota');
		} else {
			$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_kota_tambah', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kota_edit($id)
	{
		$where = array(
			'kota_id' => $id
		);
		$data['kota'] = $this->m_data->edit_data($where, 'kota')->result();
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/kategori/v_kota_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kota_update()
	{
		$this->form_validation->set_rules('kota', 'Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$kota = $this->input->post('kota');
			$provinsi = $this->input->post('provinsi');

			$where = array(
				'kota_id' => $id
			);

			$data = array(
				'kota_nama' => $kota,
				'kota_provinsi' => $provinsi,
			);

			$this->m_data->update_data($where, $data, 'kota');

			redirect(base_url() . 'dashboard/kota');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'kota_id' => $id
			);
			$data['kota'] = $this->m_data->edit_data($where, 'kota')->result();
			$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/kategori/v_kota_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function kota_hapus($id)
	{
		$where = array(
			'kota_id' => $id
		);

		$this->m_data->delete_data($where, 'kota');

		redirect(base_url() . 'dashboard/kota');
	}
	// END CRUD KOTA

	// CRUD PARTNER
	public function partner()
	{
		$data['partner'] = $this->m_data->get_data('partner')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_partner', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function partner_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_partner_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function partner_aksi()
	{
		$this->form_validation->set_rules('partner_nama', 'Nama Partner', 'required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['foto']['name'])) {
			$this->form_validation->set_rules('foto', 'Foto Partner', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/profil/';
			$config['allowed_types'] = 'jpeg|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$foto = $gambar['file_name'];
				$teks = $this->input->post('teks');
				$partner_nama = $this->input->post('partner_nama');

				$data = array(
					'partner_nama' => $partner_nama,
					'teks' => $teks,
					'foto' => $foto,
				);

				$this->m_data->insert_data($data, 'partner');

				redirect(base_url() . 'dashboard/partner');
			} else {

				$this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors());
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_partner_tambah');
				$this->load->view('dashboard/v_footer');
			}
		}
	}

	public function partner_edit($id)
	{
		$where = array(
			'partner_id' => $id
		);
		$data['partner'] = $this->m_data->edit_data($where, 'partner')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_partner_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function partner_update()
	{
		$this->form_validation->set_rules('partner_nama', 'Nama Partner', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$partner_nama = $this->input->post('partner_nama');
			$teks = $this->input->post('teks');

			$where = array(
				'partner_id' => $id
			);

			$data = array(
				'partner_nama' => $partner_nama,
				'teks' => $teks,
			);

			// update partner
			$this->m_data->update_data($where, $data, 'partner');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/profil/';
				$config['allowed_types'] = 'jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					// mengambil data tentang gambar foto yang diupload
					$gambar = $this->upload->data();

					$data = array(
						'foto' => $gambar['file_name'],
					);

					$this->m_data->update_data($where, $data, 'partner');

					redirect(base_url() . 'dashboard/partner');
				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'partner_id' => $id
					);
					$data['partner'] = $this->m_data->edit_data($where, 'partner')->result();
					$data['kategori'] = $this->m_data->get_data('kategori')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_partner_edit', $data);
					$this->load->view('dashboard/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/partner');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'partner_id' => $id
			);
			$data['partner'] = $this->m_data->edit_data($where, 'partner')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_partner_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function partner_hapus($id)
	{
		$where = array(
			'partner_id' => $id
		);

		$this->m_data->delete_data($where, 'partner');

		redirect(base_url() . 'dashboard/partner');
	}
	// END CRUD PARTNER

	// CRUD SISWA
	public function datasiswa()
	{
		// $data['siswa'] = $this->db->query("SELECT * FROM pendaftaran,gender,jurusan,provinsi,kota WHERE daftar_jurusan=jurusan_id and daftar_kelamin=gender_id and daftar_provinsi=provinsi_id and daftar_kota=kota_id order by daftar_id  asc")->result();		
		$data['siswa'] = $this->db->query("SELECT * FROM pendaftaran,gender,jurusan,provinsi,kota,agama WHERE daftar_jurusan=jurusan_id and daftar_kelamin=gender_id and daftar_provinsi=provinsi_id and daftar_kota=kota_id and daftar_agama=agama_id order by daftar_id  asc")->result();

		$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
		$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
		$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
		$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$data['kota'] = $this->m_data->get_data('kota')->result();
		$data['gender'] = $this->m_data->get_data('gender')->result();
		$data['pendaftaran'] = $this->m_data->get_data('pendaftaran')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_daftar_siswa', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function siswa_tambah()
	{

		$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
		$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
		$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
		$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$data['gender'] = $this->m_data->get_data('gender')->result();
		$data['agama'] = $this->m_data->get_data('agama')->result();

		// join kota
		$data['kota'] = $this->db->query("SELECT * FROM provinsi,kota WHERE provinsi_id=kota_provinsi order by kota_id")->result();

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong !']);
		$this->form_validation->set_rules('nisn', 'NISN ', 'required|trim|is_unique[pendaftaran.nisn]|exact_length[10]', ['required' => 'NISN tidak boleh kosong !', 'is_unique' => 'NISN ini sudah terdaftar! Silahkan periksa kembali', 'exact_length' => 'NISN tidak valid!']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pendaftaran.email]', ['is_unique' => 'Email ini sudah terdaftar', 'required' => 'Email tidak boleh kosong !']);
		$this->form_validation->set_rules('agama', 'Agama ', 'required', ['required' => 'Agama tidak boleh kosong !']);
		$this->form_validation->set_rules('jurusan', 'Program Keahlian ', 'required', ['required' => 'Program Keahlian tidak boleh kosong !']);
		$this->form_validation->set_rules('gender', 'Jenis Kelamin ', 'required', ['required' => 'Jenis Kelamin tidak boleh kosong !']);
		$this->form_validation->set_rules('ijazah', 'Nomor Ijazah ', 'required|is_unique[pendaftaran.ijazah]', ['required' => 'Nomor Ijazah tidak boleh kosong !', 'is_unique' => 'Ijazah ini sudah pernah terdaftar']);
		$this->form_validation->set_rules('skhun', 'Nomor SKHUN ', 'required|trim|is_unique[pendaftaran.skhun]', ['required' => 'Nomor SKHUN tidak boleh kosong !', 'is_unique' => 'SKHUN ini sudah pernah terdaftar']);
		$this->form_validation->set_rules('un', 'Nomor Ujian Nasional ', 'required|is_unique[pendaftaran.un]', ['required' => 'Nomor Ujian Nasional tidak boleh kosong !', 'is_unique' => 'Nomor Ujian ini sudah pernah terdaftar']);
		$this->form_validation->set_rules('nik', 'Nomor Induk Kependudukan ', 'required|is_unique[pendaftaran.nik]|exact_length[16]', ['required' => 'Nomor Induk Kependudukan tidak boleh kosong !', 'is_unique' => 'NIK ini sudah terdaftar! Silahkan periksa kembali', 'exact_length' => 'NIK tidak valid!']);
		$this->form_validation->set_rules('npsn', 'Nomor Pokok Sekolah Nasional ', 'required|exact_length[8]', ['required' => 'Nomor Pokok Sekolah Nasional tidak boleh kosong !', 'exact_length' => 'NPSN tidak valid!']);
		$this->form_validation->set_rules('sekolah', 'Sekolah Asal ', 'required|trim', ['required' => 'Sekolah Asal tidak boleh kosong !']);
		$this->form_validation->set_rules('tempat', 'Tempat Lahir ', 'required', ['required' => 'Tempat Lahir tidak boleh kosong !']);
		$this->form_validation->set_rules('ttl', 'Tanggal Lahir ', 'required', ['required' => 'Tanggal Lahir tidak boleh kosong !']);
		$this->form_validation->set_rules('provinsi', 'Provinsi ', 'required', ['required' => 'Provinsi tidak boleh kosong !']);
		$this->form_validation->set_rules('kota', 'Kota ', 'required', ['required' => 'Kota tidak boleh kosong !']);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat tdak boleh kosong !']);
		$this->form_validation->set_rules('ayah', 'Nama Ayah', 'required|trim', ['required' => 'Nama Ayah tidak boleh kosong !']);
		$this->form_validation->set_rules('nik_ayah', 'Nomor Induk Kependudukan ', 'required|is_unique[pendaftaran.nik_ayah]|exact_length[16]', ['required' => 'Nomor Induk Kependudukan tidak boleh kosong !', 'is_unique' => 'NIK ini sudah terdaftar! Silahkan periksa kembali', 'exact_length' => 'NIK tidak valid!']);
		$this->form_validation->set_rules('pekerjaanayah', 'Pekerjaan Ayah', 'required', ['required' => 'Pekerjaan Ayah tidak boleh kosong !']);
		$this->form_validation->set_rules('pendidikanayah', 'Pendidikan Ayah', 'required', ['required' => 'Pendidikan Ayah tidak boleh kosong !']);
		$this->form_validation->set_rules('penghasilanayah', 'Penghasilan Ayah', 'required', ['required' => 'Penghasilan Ayah tidak boleh kosong !']);
		$this->form_validation->set_rules('ibu', 'Nama Ibu', 'required|trim', ['required' => 'Nama Ibu tidak boleh kosong !']);
		$this->form_validation->set_rules('nik_ibu', 'Nomor Induk Kependudukan ', 'required|exact_length[16]', ['required' => 'Nomor Induk Kependudukan tidak boleh kosong !', 'exact_length' => 'NIK tidak valid!']);
		$this->form_validation->set_rules('pekerjaanibu', 'Pekerjaan Ibu', 'required', ['required' => 'Pekerjaan Ibu tidak boleh kosong !']);
		$this->form_validation->set_rules('pendidikanibu', 'Pendidikan Ibu', 'required', ['required' => 'Pendidikan Ibu tidak boleh kosong !']);
		$this->form_validation->set_rules('penghasilanibu', 'Penghasilan Ibu', 'required', ['required' => 'Penghasilan Ibu tidak boleh kosong !']);
		$this->form_validation->set_rules('tinggi', 'Tinggi', 'required|trim|is_natural_no_zero', ['required' => 'Tinggi tidak boleh kosong !', 'is_natural_no_zero' => 'Tinggi tidak mungkin 0Kg !']);
		$this->form_validation->set_rules('berat', 'Berat', 'required|trim|is_natural_no_zero', ['required' => 'Berat tidak boleh kosong !', 'is_natural_no_zero' => 'Berat tidak mungkin 0Cm !']);
		$this->form_validation->set_rules('jarak', 'Jarak', 'required|trim|is_natural_no_zero', ['required' => 'Jarak tidak boleh kosong !', 'is_natural_no_zero' => 'Jarak tidak mungkin 0Km !']);
		$this->form_validation->set_rules('saudara', 'Saudara', 'required|trim', ['required' => 'Jumlah Saudara tidak boleh kosong !']);

		if ($this->form_validation->run() != false) {

			$nama = htmlspecialchars($this->input->post('nama', true));
			$nisn = htmlspecialchars($this->input->post('nisn', true));
			$email = $this->input->post('email');
			$daftar_agama = $this->input->post('agama');
			$daftar_jurusan = $this->input->post('jurusan');
			$daftar_kelamin = $this->input->post('gender');
			$ijazah = $this->input->post('ijazah');
			$skhun = $this->input->post('skhun');
			$un = $this->input->post('un');
			$nik = $this->input->post('nik');
			$npsn = $this->input->post('npsn');
			$sekolah = $this->input->post('sekolah');
			$tempat = $this->input->post('tempat');
			$ttl = $this->input->post('ttl');
			$daftar_provinsi = $this->input->post('provinsi');
			$daftar_kota = $this->input->post('kota');
			$alamat = $this->input->post('alamat');
			$nama_ayah = $this->input->post('ayah');
			$nik_ayah = $this->input->post('nik_ayah');
			$pekerjaanayah = $this->input->post('pekerjaanayah');
			$pendidikanayah = $this->input->post('pendidikanayah');
			$penghasilanayah = $this->input->post('penghasilanayah');
			$nama_ibu = $this->input->post('ibu');
			$nik_ibu = $this->input->post('nik_ibu');
			$pekerjaanibu = $this->input->post('pekerjaanibu');
			$pendidikanibu = $this->input->post('pendidikanibu');
			$penghasilanibu = $this->input->post('penghasilanibu');
			$tinggi = $this->input->post('tinggi');
			$berat = $this->input->post('berat');
			$jarak = $this->input->post('jarak');
			$saudara = $this->input->post('saudara');

			$data = array(
				'nama' => $nama,
				'nisn' => $nisn,
				'email' => $email,
				'daftar_agama' => $daftar_agama,
				'daftar_jurusan' => $daftar_jurusan,
				'daftar_kelamin' => $daftar_kelamin,
				'ijazah' => $ijazah,
				'skhun' => $skhun,
				'un' => $un,
				'nik' => $nik,
				'npsn' => $npsn,
				'sekolah' => $sekolah,
				'tempat_lahir' => $tempat,
				'ttl' => $ttl,
				'daftar_provinsi' => $daftar_provinsi,
				'daftar_kota' => $daftar_kota,
				'alamat' => $alamat,
				'nama_ayah' => $nama_ayah,
				'nik_ayah' => $nik_ayah,
				'pekerjaanayah' => $pekerjaanayah,
				'pendidikanayah' => $pendidikanayah,
				'penghasilanayah' => $penghasilanayah,
				'nama_ibu' => $nama_ibu,
				'nik_ibu' => $nik_ibu,
				'pekerjaanibu' => $pekerjaanibu,
				'pendidikanibu' => $pendidikanibu,
				'penghasilanibu' => $penghasilanibu,
				'tinggi' => $tinggi,
				'berat' => $berat,
				'jarak' => $jarak,
				'saudara' => $saudara
			);

			$this->m_data->insert_data($data, 'pendaftaran');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! data anda telah berhasil ditambahkan</div>');
			redirect(base_url() . 'dashboard/datasiswa');
		}
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_siswa_tambah', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function siswa_edit($id)
	{
		$where = array(
			'daftar_id' => $id
		);

		$data['pendaftaran'] = $this->m_data->edit_data($where, 'pendaftaran')->result();
		$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
		$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
		$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
		$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$data['kota'] = $this->m_data->get_data('kota')->result();
		$data['gender'] = $this->m_data->get_data('gender')->result();
		$data['agama'] = $this->m_data->get_data('agama')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_siswa_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function siswa_update()
	{

		// join kota
		$data['kota'] = $this->db->query("SELECT * FROM provinsi,kota WHERE provinsi_id=kota_provinsi order by kota_id")->result();

		$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong !']);
		$this->form_validation->set_rules('nisn', 'NISN ', 'required|trim|exact_length[10]', ['required' => 'NISN tidak boleh kosong !', 'exact_length' => 'NISN tidak valid!']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', ['required' => 'Email tidak boleh kosong !']);
		$this->form_validation->set_rules('agama', 'Agama ', 'required', ['required' => 'Agama tidak boleh kosong !']);
		$this->form_validation->set_rules('jurusan', 'Program Keahlian ', 'required', ['required' => 'Program Keahlian tidak boleh kosong !']);
		$this->form_validation->set_rules('gender', 'Jenis Kelamin ', 'required', ['required' => 'Jenis Kelamin tidak boleh kosong !']);
		$this->form_validation->set_rules('ijazah', 'Nomor Ijazah ', 'required', ['required' => 'Nomor Ijazah tidak boleh kosong !', 'is_unique' => 'Ijazah ini sudah pernah terdaftar']);
		$this->form_validation->set_rules('skhun', 'Nomor SKHUN ', 'required|trim', ['required' => 'Nomor SKHUN tidak boleh kosong !', 'is_unique' => 'SKHUN ini sudah pernah terdaftar']);
		$this->form_validation->set_rules('un', 'Nomor Ujian Nasional ', 'required', ['required' => 'Nomor Ujian Nasional tidak boleh kosong !', 'is_unique' => 'Nomor Ujian ini sudah pernah terdaftar']);
		$this->form_validation->set_rules('nik', 'Nomor Induk Kependudukan ', 'required|exact_length[16]', ['required' => 'Nomor Induk Kependudukan tidak boleh kosong !', 'is_unique' => 'NIK ini sudah terdaftar! Silahkan periksa kembali', 'exact_length' => 'NIK tidak valid!']);
		$this->form_validation->set_rules('npsn', 'Nomor Pokok Sekolah Nasional ', 'required|exact_length[8]', ['required' => 'Nomor Pokok Sekolah Nasional tidak boleh kosong !', 'exact_length' => 'NPSN tidak valid!']);
		$this->form_validation->set_rules('sekolah', 'Sekolah Asal ', 'required|trim', ['required' => 'Sekolah Asal tidak boleh kosong !']);
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir ', 'required', ['required' => 'Tempat Lahir tidak boleh kosong !']);
		$this->form_validation->set_rules('ttl', 'Tanggal Lahir ', 'required', ['required' => 'Tanggal Lahir tidak boleh kosong !']);
		$this->form_validation->set_rules('provinsi', 'Provinsi ', 'required', ['required' => 'Provinsi tidak boleh kosong !']);
		$this->form_validation->set_rules('kota', 'Kota ', 'required', ['required' => 'Kota tidak boleh kosong !']);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => 'Alamat tdak boleh kosong !']);
		$this->form_validation->set_rules('ayah', 'Nama Ayah', 'required|trim', ['required' => 'Nama Ayah tidak boleh kosong !']);
		$this->form_validation->set_rules('nik_ayah', 'Nomor Induk Kependudukan ', 'required|exact_length[16]', ['required' => 'Nomor Induk Kependudukan tidak boleh kosong !', 'is_unique' => 'NIK ini sudah terdaftar! Silahkan periksa kembali', 'exact_length' => 'NIK tidak valid!']);
		$this->form_validation->set_rules('pekerjaanayah', 'Pekerjaan Ayah', 'required', ['required' => 'Pekerjaan Ayah tidak boleh kosong !']);
		$this->form_validation->set_rules('pendidikanayah', 'Pendidikan Ayah', 'required', ['required' => 'Pendidikan Ayah tidak boleh kosong !']);
		$this->form_validation->set_rules('penghasilanayah', 'Penghasilan Ayah', 'required', ['required' => 'Penghasilan Ayah tidak boleh kosong !']);
		$this->form_validation->set_rules('ibu', 'Nama Ibu', 'required|trim', ['required' => 'Nama Ibu tidak boleh kosong !']);
		$this->form_validation->set_rules('nik_ibu', 'Nomor Induk Kependudukan ', 'required|exact_length[16]', ['required' => 'Nomor Induk Kependudukan tidak boleh kosong !', 'exact_length' => 'NIK tidak valid!']);
		$this->form_validation->set_rules('pekerjaanibu', 'Pekerjaan Ibu', 'required', ['required' => 'Pekerjaan Ibu tidak boleh kosong !']);
		$this->form_validation->set_rules('pendidikanibu', 'Pendidikan Ibu', 'required', ['required' => 'Pendidikan Ibu tidak boleh kosong !']);
		$this->form_validation->set_rules('penghasilanibu', 'Penghasilan Ibu', 'required', ['required' => 'Penghasilan Ibu tidak boleh kosong !']);
		$this->form_validation->set_rules('tinggi', 'Tinggi', 'required|trim|is_natural_no_zero', ['required' => 'Tinggi tidak boleh kosong !', 'is_natural_no_zero' => 'Tinggi tidak mungkin 0Kg !']);
		$this->form_validation->set_rules('berat', 'Berat', 'required|trim|is_natural_no_zero', ['required' => 'Berat tidak boleh kosong !', 'is_natural_no_zero' => 'Berat tidak mungkin 0Cm !']);
		$this->form_validation->set_rules('jarak', 'Jarak', 'required|trim|is_natural_no_zero', ['required' => 'Jarak tidak boleh kosong !', 'is_natural_no_zero' => 'Jarak tidak mungkin 0Km !']);
		$this->form_validation->set_rules('saudara', 'Saudara', 'required|trim', ['required' => 'Jumlah Saudara tidak boleh kosong !']);

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$nama = htmlspecialchars($this->input->post('nama', true));
			$nisn = htmlspecialchars($this->input->post('nisn', true));
			$email = $this->input->post('email');
			$daftar_agama = $this->input->post('agama');
			$daftar_jurusan = $this->input->post('jurusan');
			$daftar_kelamin = $this->input->post('gender');
			$ijazah = $this->input->post('ijazah');
			$skhun = $this->input->post('skhun');
			$un = $this->input->post('un');
			$nik = $this->input->post('nik');
			$npsn = $this->input->post('npsn');
			$sekolah = $this->input->post('sekolah');
			$tempat_lahir = $this->input->post('tempat_lahir');
			$ttl = $this->input->post('ttl');
			$daftar_provinsi = $this->input->post('provinsi');
			$daftar_kota = $this->input->post('kota');
			$alamat = $this->input->post('alamat');
			$nama_ayah = $this->input->post('ayah');
			$nik_ayah = $this->input->post('nik_ayah');
			$pekerjaanayah = $this->input->post('pekerjaanayah');
			$pendidikanayah = $this->input->post('pendidikanayah');
			$penghasilanayah = $this->input->post('penghasilanayah');
			$nama_ibu = $this->input->post('ibu');
			$nik_ibu = $this->input->post('nik_ibu');
			$pekerjaanibu = $this->input->post('pekerjaanibu');
			$pendidikanibu = $this->input->post('pendidikanibu');
			$penghasilanibu = $this->input->post('penghasilanibu');
			$tinggi = $this->input->post('tinggi');
			$berat = $this->input->post('berat');
			$jarak = $this->input->post('jarak');
			$saudara = $this->input->post('saudara');

			$where = array(
				'daftar_id' => $id
			);

			$data = array(
				'nama' => $nama,
				'nisn' => $nisn,
				'email' => $email,
				'daftar_agama' => $daftar_agama,
				'daftar_jurusan' => $daftar_jurusan,
				'daftar_kelamin' => $daftar_kelamin,
				'ijazah' => $ijazah,
				'skhun' => $skhun,
				'un' => $un,
				'nik' => $nik,
				'npsn' => $npsn,
				'sekolah' => $sekolah,
				'tempat_lahir' => $tempat_lahir,
				'ttl' => $ttl,
				'daftar_provinsi' => $daftar_provinsi,
				'daftar_kota' => $daftar_kota,
				'alamat' => $alamat,
				'nama_ayah' => $nama_ayah,
				'nik_ayah' => $nik_ayah,
				'pekerjaanayah' => $pekerjaanayah,
				'pendidikanayah' => $pendidikanayah,
				'penghasilanayah' => $penghasilanayah,
				'nama_ibu' => $nama_ibu,
				'nik_ibu' => $nik_ibu,
				'pekerjaanibu' => $pekerjaanibu,
				'pendidikanibu' => $pendidikanibu,
				'penghasilanibu' => $penghasilanibu,
				'tinggi' => $tinggi,
				'berat' => $berat,
				'jarak' => $jarak,
				'saudara' => $saudara
			);

			// update data siswa
			$this->m_data->update_data($where, $data, 'pendaftaran');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! data anda telah berhasil mengubah data</div>');
			redirect(base_url() . 'dashboard/datasiswa');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'daftar_id' => $id
			);
			$data['pendaftaran'] = $this->m_data->edit_data($where, 'pendaftaran')->result();
			$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
			$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
			$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
			$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
			$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
			$data['gender'] = $this->m_data->get_data('gender')->result();
			$data['agama'] = $this->m_data->get_data('agama')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_siswa_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function print()
	{
		$data['siswa'] = $this->db->query("SELECT * FROM pendaftaran,gender,jurusan,provinsi,kota,agama WHERE daftar_jurusan=jurusan_id and daftar_kelamin=gender_id and daftar_provinsi=provinsi_id and daftar_kota=kota_id and daftar_agama=agama_id order by daftar_id  asc")->result();
		$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
		$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
		$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
		$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$data['kota'] = $this->m_data->get_data('kota')->result();
		$data['gender'] = $this->m_data->get_data('gender')->result();
		$data['pendaftaran'] = $this->m_data->get_data('pendaftaran')->result();

		$this->load->view('dashboard/cetak/v_print.php', $data);
	}

	public function pdf()
	{

		$this->load->library('Dompdf_gen');

		$data['siswa'] = $this->db->query("SELECT * FROM pendaftaran,gender,jurusan,provinsi,kota,agama WHERE daftar_jurusan=jurusan_id and daftar_kelamin=gender_id and daftar_provinsi=provinsi_id and daftar_kota=kota_id and daftar_agama=agama_id order by daftar_id  asc")->result();
		$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
		$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
		$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
		$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$data['kota'] = $this->m_data->get_data('kota')->result();
		$data['gender'] = $this->m_data->get_data('gender')->result();
		$data['pendaftaran'] = $this->m_data->get_data('pendaftaran')->result();

		$this->load->view('dashboard/cetak/v_pdf', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Data_siswa.pdf", array('Attachment' => 0));
	}

	public function excel()
	{

		$data['siswa'] = $this->db->query("SELECT * FROM pendaftaran,gender,jurusan,provinsi,kota,agama WHERE daftar_jurusan=jurusan_id and daftar_kelamin=gender_id and daftar_provinsi=provinsi_id and daftar_kota=kota_id and daftar_agama=agama_id order by daftar_id  asc")->result();
		$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
		$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
		$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
		$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$data['kota'] = $this->m_data->get_data('kota')->result();
		$data['gender'] = $this->m_data->get_data('gender')->result();
		$data['pendaftaran'] = $this->m_data->get_data('pendaftaran')->result();

		require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setCreator("Admin Website");
		$object->getProperties()->setLastModifiedBy("Admin Website");
		$object->getProperties()->setTitle("Daftar Mahasiswa");

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'Nomor');
		$object->getActiveSheet()->setCellValue('B1', 'Nama Siswa');
		$object->getActiveSheet()->setCellValue('C1', 'NISN');
		$object->getActiveSheet()->setCellValue('D1', 'Email');
		$object->getActiveSheet()->setCellValue('E1', 'Program Keahlian');
		$object->getActiveSheet()->setCellValue('F1', 'JK');
		$object->getActiveSheet()->setCellValue('G1', 'No. Ijazah');
		$object->getActiveSheet()->setCellValue('H1', 'No. SKHUN');
		$object->getActiveSheet()->setCellValue('I1', 'No. Ujian Nasional');
		$object->getActiveSheet()->setCellValue('J1', 'NIK Siswa');
		$object->getActiveSheet()->setCellValue('K1', 'NPSN');
		$object->getActiveSheet()->setCellValue('L1', 'Asal Sekolah');
		$object->getActiveSheet()->setCellValue('M1', 'Tempat Lahir');
		$object->getActiveSheet()->setCellValue('N1', 'Tanggal Lahir');
		$object->getActiveSheet()->setCellValue('O1', 'Alamat');
		$object->getActiveSheet()->setCellValue('P1', 'Berat');
		$object->getActiveSheet()->setCellValue('Q1', 'Tinggi');
		$object->getActiveSheet()->setCellValue('R1', 'Jarak Rumah');

		$baris = 2;
		$no = 1;

		foreach ($data['siswa'] as $a) {
			$object->getActiveSheet()->setCellValue('A' . $baris, $no++);
			$object->getActiveSheet()->setCellValue('B' . $baris, $a->nama);
			$object->getActiveSheet()->setCellValue('C' . $baris, $a->nisn);
			$object->getActiveSheet()->setCellValue('D' . $baris, $a->email);
			$object->getActiveSheet()->setCellValue('E' . $baris, $a->jurusan_nama);
			$object->getActiveSheet()->setCellValue('F' . $baris, $a->gender_jenis);
			$object->getActiveSheet()->setCellValue('G' . $baris, $a->ijazah);
			$object->getActiveSheet()->setCellValue('H' . $baris, $a->skhun);
			$object->getActiveSheet()->setCellValue('I' . $baris, $a->un);
			$object->getActiveSheet()->setCellValue('J' . $baris, $a->nik);
			$object->getActiveSheet()->setCellValue('K' . $baris, $a->npsn);
			$object->getActiveSheet()->setCellValue('L' . $baris, $a->sekolah);
			$object->getActiveSheet()->setCellValue('M' . $baris, $a->tempat_lahir);
			$object->getActiveSheet()->setCellValue('N' . $baris, $a->ttl);
			$object->getActiveSheet()->setCellValue('O' . $baris, $a->alamat, $a->kota_nama, $a->provinsi_nama);
			$object->getActiveSheet()->setCellValue('P' . $baris, $a->berat);
			$object->getActiveSheet()->setCellValue('Q' . $baris, $a->tinggi);
			$object->getActiveSheet()->setCellValue('R' . $baris, $a->jarak);

			$baris++;
		}

		$filename = "Data_Siswa" . '.xlsx';
		$object->getActiveSheet()->setTitle("Data Siswa");

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Contect-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		$writer->save('php://output');

		exit;
	}
	// END CRUD SISWA

	// CRUD ORTU
	public function dataortu()
	{
		$data['ortu'] = $this->db->query("SELECT * FROM pendaftaran,pendidikan,pekerjaan,pendapatan,kota,provinsi,jurusan,gender WHERE pendidikanayah=pendidikan_id and pekerjaanayah=pekerjaan_id and penghasilanayah=pendapatan_id  and daftar_kota=kota_id and daftar_provinsi=provinsi_id and daftar_jurusan=jurusan_id and daftar_kelamin=gender_id order by daftar_id asc")->result();

		$data['pendaftaran'] = $this->m_data->get_data('pendaftaran')->result();
		$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
		$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		$data['kota'] = $this->m_data->get_data('kota')->result();
		$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
		$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_daftar_ortu', $data);
		$this->load->view('dashboard/v_footer');
	}
	// END CRUD SISWA

	// CRUD BANNER
	public function banner()
	{
		$data['banner'] = $this->m_data->get_data('banner')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_banner', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function banner_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_banner_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function banner_aksi()
	{
		$this->form_validation->set_rules('banner_nama', 'Judul Banner', 'required');
		$this->form_validation->set_rules('teks', 'Isi Konten ', 'required');
		$this->form_validation->set_rules('banner_urut', 'Urutan Banner ', 'required|is_unique[banner.banner_urut]');

		// Membuat gambar wajib di isi
		if (empty($_FILES['foto']['name'])) {
			$this->form_validation->set_rules('foto', 'Foto Partner', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/banner/';
			$config['allowed_types'] = 'jpeg|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$foto = $gambar['file_name'];
				$teks = $this->input->post('teks');
				$banner_nama = $this->input->post('banner_nama');
				$banner_urut = $this->input->post('banner_urut');

				$data = array(
					'banner_nama' => $banner_nama,
					'banner_urut' => $banner_urut,
					'teks' => $teks,
					'foto' => $foto,
				);

				$this->m_data->insert_data($data, 'banner');

				redirect(base_url() . 'dashboard/banner/?alert=sukses');
			} else {
				redirect(base_url() . 'dashboard/banner_tambah/?alert=gagal');
				$this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors());
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_banner_tambah');
				$this->load->view('dashboard/v_footer');
			}
		}
	}

	public function banner_edit($id)
	{
		$where = array(
			'banner_id' => $id
		);
		$data['banner'] = $this->m_data->edit_data($where, 'banner')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_banner_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function banner_update()
	{
		$this->form_validation->set_rules('banner_nama', 'Judul Banner', 'required');
		$this->form_validation->set_rules('teks', 'Isi Konten ', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$banner_nama = $this->input->post('banner_nama');
			$teks = $this->input->post('teks');
			$banner_urut = $this->input->post('banner_urut');

			$where = array(
				'banner_id' => $id
			);

			$data = array(
				'banner_nama' => $banner_nama,
				'banner_urut' => $banner_urut,
				'teks' => $teks,
			);

			// update banner
			$this->m_data->update_data($where, $data, 'banner');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/banner/';
				$config['allowed_types'] = 'jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					// mengambil data tentang gambar foto yang diupload
					$gambar = $this->upload->data();

					$data = array(
						'foto' => $gambar['file_name'],
					);

					$this->m_data->update_data($where, $data, 'banner');

					redirect(base_url() . 'dashboard/banner');
				} else {
					$this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'banner_id' => $id
					);
					$data['banner'] = $this->m_data->edit_data($where, 'banner')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_banner_edit', $data);
					$this->load->view('dashboard/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/banner');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'banner_id' => $id
			);
			$data['banner'] = $this->m_data->edit_data($where, 'banner')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_banner_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function banner_hapus($id)
	{
		$where = array(
			'banner_id' => $id
		);

		$this->m_data->delete_data($where, 'banner');

		redirect(base_url() . 'dashboard/banner');
	}
	// END CRUD PAKET

	// CRUD KATA
	public function kata()
	{
		$data['kata'] = $this->m_data->get_data('kata')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kata', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kata_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kata_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function kata_aksi()
	{
		$this->form_validation->set_rules('kata_nama', 'Narasi Video', 'required');
		$this->form_validation->set_rules('kata_slug', 'Link', 'required');
		$this->form_validation->set_rules('kata_width', 'Width', 'required');
		$this->form_validation->set_rules('kata_height', 'Heigth', 'required');

		if ($this->form_validation->run() != false) {

			$kata_nama = $this->input->post('kata_nama');
			$kata_slug = $this->input->post('kata_slug');
			$kata_width = $this->input->post('kata_width');
			$kata_height = $this->input->post('kata_height');


			$data = array(
				'kata_nama' => $kata_nama,
				'kata_slug' => $kata_slug,
				'kata_width' => $kata_width,
				'kata_height' => $kata_height

			);

			$this->m_data->insert_data($data, 'kata');

			redirect(base_url() . 'dashboard/kata');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kata_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function kata_edit($id)
	{
		$where = array(
			'kata_id' => $id
		);
		$data['kata'] = $this->m_data->edit_data($where, 'kata')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_kata_edit', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function kata_update()
	{
		$this->form_validation->set_rules('kata_nama', 'Narasi Video', 'required');
		$this->form_validation->set_rules('kata_slug', 'Link', 'required');
		$this->form_validation->set_rules('kata_width', 'Width', 'required');
		$this->form_validation->set_rules('kata_height', 'Heigth', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$kata_nama = $this->input->post('kata_nama');
			$kata_slug = $this->input->post('kata_slug');
			$kata_width = $this->input->post('kata_width');
			$kata_height = $this->input->post('kata_height');

			$where = array(
				'kata_id' => $id
			);

			$data = array(
				'kata_nama' => $kata_nama,
				'kata_slug' => $kata_slug,
				'kata_width' => $kata_width,
				'kata_height' => $kata_height
			);

			$this->m_data->update_data($where, $data, 'kata');

			redirect(base_url() . 'dashboard/kata');
		} else {

			$id = $this->input->post('id');
			$where = array(
				'kata_id' => $id
			);
			$data['kata'] = $this->m_data->edit_data($where, 'kata')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_kata_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function kata_hapus($id)
	{
		$where = array(
			'kata_id' => $id
		);

		$this->m_data->delete_data($where, 'kata');

		redirect(base_url() . 'dashboard/kata');
	}
	// END CRUD KATA

	// CRUD ARTIKEL	
	public function artikel()
	{
		$data['artikel'] = $this->db->query("SELECT * FROM artikel,kategori,pengguna WHERE artikel_kategori=kategori_id and artikel_author=pengguna_id order by artikel_id desc")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function artikel_tambah()
	{
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel_tambah', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function artikel_aksi()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[artikel.artikel_judul]');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['sampul']['name'])) {
			$this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/artikel/';
			$config['allowed_types'] = 'jpeg|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('sampul')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$tanggal = date('Y-m-d H:i:s');
				$judul = $this->input->post('judul');
				$slug = strtolower(url_title($judul));
				$konten = $this->input->post('konten');
				$sampul = $gambar['file_name'];
				$author = $this->session->userdata('id');
				$kategori = $this->input->post('kategori');
				$status = $this->input->post('status');

				$data = array(
					'artikel_tanggal' => $tanggal,
					'artikel_judul' => $judul,
					'artikel_slug' => $slug,
					'artikel_konten' => $konten,
					'artikel_sampul' => $sampul,
					'artikel_author' => $author,
					'artikel_kategori' => $kategori,
					'artikel_status' => $status,
				);

				$this->m_data->insert_data($data, 'artikel');

				redirect(base_url() . 'dashboard/artikel');
			} else {

				$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

				$data['kategori'] = $this->m_data->get_data('kategori')->result();
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_artikel_tambah', $data);
				$this->load->view('dashboard/v_footer');
			}
		} else {
			$data['kategori'] = $this->m_data->get_data('kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_artikel_tambah', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function artikel_edit($id)
	{
		$where = array(
			'artikel_id' => $id
		);
		$data['artikel'] = $this->m_data->edit_data($where, 'artikel')->result();
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_artikel_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function artikel_update()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');
			$kategori = $this->input->post('kategori');
			$status = $this->input->post('status');

			$where = array(
				'artikel_id' => $id
			);

			$data = array(
				'artikel_judul' => $judul,
				'artikel_slug' => $slug,
				'artikel_konten' => $konten,
				'artikel_kategori' => $kategori,
				'artikel_status' => $status,
			);

			$this->m_data->update_data($where, $data, 'artikel');


			if (!empty($_FILES['sampul']['name'])) {
				$config['upload_path']   = './gambar/artikel/';
				$config['allowed_types'] = 'gif|jpg|png';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {

					// mengambil data tentang gambar
					$gambar = $this->upload->data();

					$data = array(
						'artikel_sampul' => $gambar['file_name'],
					);

					$this->m_data->update_data($where, $data, 'artikel');

					redirect(base_url() . 'dashboard/artikel');
				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'artikel_id' => $id
					);
					$data['artikel'] = $this->m_data->edit_data($where, 'artikel')->result();
					$data['kategori'] = $this->m_data->get_data('kategori')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_artikel_edit', $data);
					$this->load->view('dashboard/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/artikel');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'artikel_id' => $id
			);
			$data['artikel'] = $this->m_data->edit_data($where, 'artikel')->result();
			$data['kategori'] = $this->m_data->get_data('kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_artikel_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function artikel_hapus($id)
	{
		$where = array(
			'artikel_id' => $id
		);

		$this->m_data->delete_data($where, 'artikel');

		redirect(base_url() . 'dashboard/artikel');
	}
	// end crud artikel


	// CRUD GURU
	public function guru()
	{
		$data['guru'] = $this->db->query("SELECT * FROM guru,kategori,pengguna WHERE guru_kategori=kategori_id  and guru_author=pengguna_id order by guru_id asc")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_guru', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function guru_tambah()
	{
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_guru_tambah', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function guru_aksi()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul', 'Nama', 'required');
		$this->form_validation->set_rules('konten', 'Profil', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['sampul']['name'])) {
			$this->form_validation->set_rules('sampul', 'Gambar Sampul', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/guru/';
			$config['allowed_types'] = 'jpeg|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('sampul')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$tanggal = date('Y-m-d H:i:s');
				$judul = $this->input->post('judul');
				$slug = strtolower(url_title($judul));
				$konten = $this->input->post('konten');
				$sampul = $gambar['file_name'];
				$author = $this->session->userdata('id');
				$kategori = $this->input->post('kategori');
				$status = $this->input->post('status');

				$data = array(
					'guru_tanggal' => $tanggal,
					'guru_judul' => $judul,
					'guru_slug' => $slug,
					'guru_konten' => $konten,
					'guru_sampul' => $sampul,
					'guru_author' => $author,
					'guru_kategori' => $kategori,
					'guru_status' => $status,
				);

				$this->m_data->insert_data($data, 'guru');

				redirect(base_url() . 'dashboard/guru');
			} else {

				$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

				$data['kategori'] = $this->m_data->get_data('kategori')->result();
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_guru_tambah', $data);
				$this->load->view('dashboard/v_footer');
			}
		} else {
			$data['kategori'] = $this->m_data->get_data('kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_guru_tambah', $data);
			$this->load->view('dashboard/v_footer');
		}
	}


	public function guru_edit($id)
	{
		$where = array(
			'guru_id' => $id
		);
		$data['guru'] = $this->m_data->edit_data($where, 'guru')->result();
		$data['kategori'] = $this->m_data->get_data('kategori')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_guru_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function guru_update()
	{
		// Wajib isi judul,konten dan kategori
		$this->form_validation->set_rules('judul', 'Nama', 'required');
		$this->form_validation->set_rules('konten', 'Profil', 'required');
		$this->form_validation->set_rules('kategori', 'Kategori', 'required');


		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');
			$kategori = $this->input->post('kategori');
			$status = $this->input->post('status');

			$where = array(
				'guru_id' => $id
			);

			$data = array(
				'guru_judul' => $judul,
				'guru_slug' => $slug,
				'guru_konten' => $konten,
				'guru_kategori' => $kategori,
				'guru_status' => $status,
			);

			$this->m_data->update_data($where, $data, 'guru');


			if (!empty($_FILES['sampul']['name'])) {
				$config['upload_path']   = './gambar/guru/';
				$config['allowed_types'] = 'jpeg|jpg|png';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sampul')) {

					// mengambil data tentang gambar
					$gambar = $this->upload->data();

					$data = array(
						'guru_sampul' => $gambar['file_name'],
					);

					$this->m_data->update_data($where, $data, 'guru');

					redirect(base_url() . 'dashboard/guru');
				} else {
					$this->form_validation->set_message('sampul', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'guru_id' => $id
					);
					$data['guru'] = $this->m_data->edit_data($where, 'guru')->result();
					$data['kategori'] = $this->m_data->get_data('kategori')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_guru_edit', $data);
					$this->load->view('dashboard/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/guru');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'guru_id' => $id
			);
			$data['guru'] = $this->m_data->edit_data($where, 'guru')->result();
			$data['kategori'] = $this->m_data->get_data('kategori')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_guru_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function guru_hapus($id)
	{
		$where = array(
			'guru_id' => $id
		);

		$this->m_data->delete_data($where, 'guru');

		redirect(base_url() . 'dashboard/guru');
	}
	// END CRUD GURU

	// CRUD PAGES
	public function pages()
	{
		$data['halaman'] = $this->m_data->get_data('halaman')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pages_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pages_aksi()
	{
		// Wajib isi judul,konten
		$this->form_validation->set_rules('judul', 'Judul', 'required|is_unique[halaman.halaman_judul]');
		$this->form_validation->set_rules('konten', 'Konten', 'required');

		if ($this->form_validation->run() != false) {

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');

			$data = array(
				'halaman_judul' => $judul,
				'halaman_slug' => $slug,
				'halaman_konten' => $konten
			);

			$this->m_data->insert_data($data, 'halaman');

			// alihkan kembali ke method pages
			redirect(base_url() . 'dashboard/pages');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pages_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pages_edit($id)
	{
		$where = array(
			'halaman_id' => $id
		);
		$data['halaman'] = $this->m_data->edit_data($where, 'halaman')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pages_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function pages_update()
	{
		// Wajib isi judul,konten 
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$slug = strtolower(url_title($judul));
			$konten = $this->input->post('konten');

			$where = array(
				'halaman_id' => $id
			);

			$data = array(
				'halaman_judul' => $judul,
				'halaman_slug' => $slug,
				'halaman_konten' => $konten
			);

			$this->m_data->update_data($where, $data, 'halaman');

			redirect(base_url() . 'dashboard/pages');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'halaman_id' => $id
			);
			$data['halaman'] = $this->m_data->edit_data($where, 'halaman')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pages_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pages_hapus($id)
	{
		$where = array(
			'halaman_id' => $id
		);

		$this->m_data->delete_data($where, 'halaman');

		redirect(base_url() . 'dashboard/pages');
	}
	// end crud pages

	// CRUD FAQ
	public function faq()
	{
		$data['faq'] = $this->m_data->get_data('faq')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_faq', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function faq_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_faq_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function faq_aksi()
	{
		// Wajib isi judul,konten
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('jawab', 'Jawab', 'required');

		if ($this->form_validation->run() != false) {

			$judul = $this->input->post('judul');
			$jawab = $this->input->post('jawab');

			$data = array(
				'faq_judul' => $judul,
				'faq_jawab' => $jawab

			);

			$this->m_data->insert_data($data, 'faq');

			// alihkan kembali ke method faq
			redirect(base_url() . 'dashboard/faq');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_faq_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function faq_edit($id)
	{
		$where = array(
			'faq_id' => $id
		);
		$data['faq'] = $this->m_data->edit_data($where, 'faq')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_faq_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function faq_update()
	{
		// Wajib isi judul,konten 
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('jawab', 'Jawab', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$judul = $this->input->post('judul');
			$jawab = $this->input->post('jawab');

			$where = array(
				'faq_id' => $id
			);

			$data = array(
				'faq_judul' => $judul,
				'faq_jawab' => $jawab
			);

			$this->m_data->update_data($where, $data, 'faq');

			redirect(base_url() . 'dashboard/faq');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'faq_id' => $id
			);
			$data['faq'] = $this->m_data->edit_data($where, 'faq')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_faq_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function faq_hapus($id)
	{
		$where = array(
			'faq_id' => $id
		);

		$this->m_data->delete_data($where, 'faq');

		redirect(base_url() . 'dashboard/faq');
	}
	// background FAQ / bgfaq
	public function bg_faq()
	{
		$data['bg_faq'] = $this->m_data->get_data('bg_faq')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_bg_faq', $data);
		$this->load->view('dashboard/v_footer');
	}

	// public function bg_faq_tambah()
	// {
	// 	$this->load->view('dashboard/v_header');
	// 	$this->load->view('dashboard/v_bg_faq_tambah');
	// 	$this->load->view('dashboard/v_footer');
	// }

	public function bg_faq_aksi()
	{
		$this->form_validation->set_rules('bgfaq_kategori', 'Kategori Background', 'required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['foto']['name'])) {
			$this->form_validation->set_rules('foto', 'Foto Background', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/bgfaq/';
			$config['allowed_types'] = 'jpeg|jpg|png|gif';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$foto = $gambar['file_name'];
				$bgfaq_kategori = $this->input->post('bgfaq_kategori');

				$data = array(
					'bgfaq_kategori' => $bgfaq_kategori,
					'foto' => $foto,
				);

				$this->m_data->insert_data($data, 'bg_faq');

				redirect(base_url() . 'dashboard/bg_faq/?alert=sukses');
			} else {
				redirect(base_url() . 'dashboard/bg_faq_tambah/?alert=gagal');
				$this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors());
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/v_bg_faq_tambah');
				$this->load->view('dashboard/v_footer');
			}
		}
	}

	public function bg_faq_edit($id)
	{
		$where = array(
			'bgfaq_id' => $id
		);
		$data['bg_faq'] = $this->m_data->edit_data($where, 'bg_faq')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_bg_faq_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function bg_faq_update()
	{
		$this->form_validation->set_rules('bgfaq_kategori', 'Kategori Background ', 'trim');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$bgfaq_kategori = $this->input->post('bgfaq_kategori');

			$where = array(
				'bgfaq_id' => $id
			);

			$data = array(
				// 'bgfaq_kategori' => set_value('bgfaq_kategori', $bgfaq_kategori),
				'bgfaq_kategori' => $bgfaq_kategori
			);

			// update background
			$this->m_data->update_data($where, $data, 'bg_faq');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/bgfaq/';
				$config['allowed_types'] = 'jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					// mengambil data tentang gambar foto yang diupload
					$gambar = $this->upload->data();

					$data = array(
						'foto' => $gambar['file_name'],
					);

					$this->m_data->update_data($where, $data, 'bg_faq');

					redirect(base_url() . 'dashboard/bg_faq');
				} else {
					$this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'bgfaq_id' => $id
					);
					$data['bg_faq'] = $this->m_data->edit_data($where, 'bg_faq')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/v_faq_edit_edit', $data);
					$this->load->view('dashboard/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/guru');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'bgfaq_id' => $id
			);
			$data['bg_faq'] = $this->m_data->edit_data($where, 'bg_faq')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_faq_edit_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}
	// end crud FAQ

	// CRUD BACKGROUND
	public function background()
	{
		$data['background'] = $this->m_data->get_data('background')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/background/v_background', $data);
		$this->load->view('dashboard/v_footer');
	}

	// Aktifkan Function dibawah jika ingin menambahkan background dengan kategori baru

	// public function background_tambah()
	// {
	// 	$this->load->view('dashboard/v_header');
	// 	$this->load->view('dashboard/background/v_background_tambah');
	// 	$this->load->view('dashboard/v_footer');
	// }

	public function background_aksi()
	{
		$this->form_validation->set_rules('background_kategori', 'Kategori Background', 'required');

		// Membuat gambar wajib di isi
		if (empty($_FILES['foto']['name'])) {
			$this->form_validation->set_rules('foto', 'Foto Background', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/background/';
			$config['allowed_types'] = 'jpeg|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$foto = $gambar['file_name'];
				$background_kategori = $this->input->post('background_kategori');

				$data = array(
					'background_kategori' => $background_kategori,
					'foto' => $foto,
				);

				$this->m_data->insert_data($data, 'background');

				redirect(base_url() . 'dashboard/background/?alert=sukses');
			} else {
				redirect(base_url() . 'dashboard/background_tambah/?alert=gagal');
				$this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors());
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/background/v_background_tambah');
				$this->load->view('dashboard/v_footer');
			}
		}
	}

	public function background_edit($id)
	{
		$where = array(
			'background_id' => $id
		);
		$data['background'] = $this->m_data->edit_data($where, 'background')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/background/v_background_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function background_update()
	{
		$this->form_validation->set_rules('background_kategori', 'Kategori Background ', 'trim');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$background_kategori = $this->input->post('background_kategori');

			$where = array(
				'background_id' => $id
			);

			$data = array(
				// 'background_kategori' => set_value('background_kategori', $background_kategori),
				'background_kategori' => $background_kategori
			);

			// update background
			$this->m_data->update_data($where, $data, 'background');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/background/';
				$config['allowed_types'] = 'jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					// mengambil data tentang gambar foto yang diupload
					$gambar = $this->upload->data();

					$data = array(
						'foto' => $gambar['file_name'],
					);

					$this->m_data->update_data($where, $data, 'background');

					redirect(base_url() . 'dashboard/background');
				} else {
					$this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'background_id' => $id
					);
					$data['background'] = $this->m_data->edit_data($where, 'background')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/background/v_background_edit', $data);
					$this->load->view('dashboard/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/background');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'background_id' => $id
			);
			$data['background'] = $this->m_data->edit_data($where, 'background')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/background/v_background_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	// Aktifkan Function dibawah apabila ingin menghapus sebuah background kategori
	// public function background_hapus($id)
	// {
	// 	$where = array(
	// 		'background_id' => $id
	// 	);

	// 	$this->m_data->delete_data($where,'background');

	// 	redirect(base_url().'dashboard/background');
	// }
	// END CRUD BACKGROUND


	// CRUD GALERI
	public function galeri()
	{
		$data['galeri'] = $this->db->query("SELECT * FROM galeri,kat_galeri WHERE galeri_kategori=kat_galeri_id order by galeri_kategori  asc")->result();
		// $data['urutan'] = $this->db->query("SELECT * FROM galeri,kat_galeri WHERE galeri_kategori=kat_galeri_id order by galeri_kategori  asc")->result();		
		// $data['galeri'] = $this->m_data->get_data('galeri')->result();	
		$data['kat_galeri'] = $this->m_data->get_data('kat_galeri')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/galeri/v_galeri', $data);
		$this->load->view('dashboard/v_footer');
	}

	// Aktifkan Function dibawah jika ingin menambahkan galeri dengan kategori baru

	public function galeri_tambah()
	{
		$data['kat_galeri'] = $this->m_data->get_data('kat_galeri')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/galeri/v_galeri_tambah', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function galeri_aksi()
	{
		$this->form_validation->set_rules('galeri_judul', 'Judul Foto', 'required|trim');
		$this->form_validation->set_rules('kat_galeri', 'Kategori Galeri', 'required|trim');


		// Membuat gambar wajib di isi
		if (empty($_FILES['foto']['name'])) {
			$this->form_validation->set_rules('foto', 'Foto Background', 'required');
		}

		if ($this->form_validation->run() != false) {

			$config['upload_path']   = './gambar/galeri/';
			$config['allowed_types'] = 'jpeg|jpg|png';

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {

				// mengambil data tentang gambar
				$gambar = $this->upload->data();

				$foto = $gambar['file_name'];
				$galeri_judul = $this->input->post('galeri_judul');
				$galeri_kategori = $this->input->post('kat_galeri');

				$data = array(
					'galeri_judul' => $galeri_judul,
					'foto' => $foto,
					'galeri_kategori' => $galeri_kategori,
				);

				$this->m_data->insert_data($data, 'galeri');

				redirect(base_url() . 'dashboard/galeri/?alert=sukses');
			} else {
				redirect(base_url() . 'dashboard/galeri_tambah/?alert=gagal');
				$this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors());
				$this->load->view('dashboard/v_header');
				$this->load->view('dashboard/galeri/v_galeri_tambah');
				$this->load->view('dashboard/v_footer');
			}
		}
	}

	public function galeri_edit($id)
	{
		$where = array(
			'galeri_id' => $id
		);
		$data['galeri'] = $this->m_data->edit_data($where, 'galeri')->result();
		$data['kat_galeri'] = $this->m_data->get_data('kat_galeri')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/galeri/v_galeri_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function galeri_update()
	{
		$this->form_validation->set_rules('galeri_judul', 'Judul Foto ', 'required|trim');
		$this->form_validation->set_rules('kat_galeri', 'Kategori Galeri ', 'required|trim');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');
			$galeri_judul = $this->input->post('galeri_judul');
			$galeri_kategori = $this->input->post('kat_galeri');

			$where = array(
				'galeri_id' => $id
			);

			$data = array(
				// 'galeri_judul' => set_value('galeri_judul', $galeri_judul),
				'galeri_judul' => $galeri_judul,
				'galeri_kategori' => $galeri_kategori,
			);

			// update galeri
			$this->m_data->update_data($where, $data, 'galeri');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/galeri/';
				$config['allowed_types'] = 'jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					// mengambil data tentang gambar foto yang diupload
					$gambar = $this->upload->data();

					$data = array(
						'foto' => $gambar['file_name'],
					);

					$this->m_data->update_data($where, $data, 'galeri');

					redirect(base_url() . 'dashboard/galeri');
				} else {
					$this->form_validation->set_message('foto', $data['gambar_error'] = $this->upload->display_errors());

					$where = array(
						'galeri_id' => $id
					);
					$data['galeri'] = $this->m_data->edit_data($where, 'galeri')->result();
					$data['kat_galeri'] = $this->m_data->get_data('kat_galeri')->result();
					$this->load->view('dashboard/v_header');
					$this->load->view('dashboard/galeri/v_galeri_edit', $data);
					$this->load->view('dashboard/v_footer');
				}
			} else {
				redirect(base_url() . 'dashboard/galeri/?alert=update');
			}
		} else {
			$id = $this->input->post('id');
			$where = array(
				'galeri_id' => $id
			);
			$data['galeri'] = $this->m_data->edit_data($where, 'galeri')->result();
			$data['kat_galeri'] = $this->m_data->get_data('kat_galeri')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/galeri/v_galeri_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	// Aktifkan Function dibawah apabila ingin menghapus sebuah galeri kategori
	public function galeri_hapus($id)
	{
		$where = array(
			'galeri_id' => $id
		);

		$this->m_data->delete_data($where, 'galeri');

		redirect(base_url() . 'dashboard/galeri');
	}
	// END CRUD GALERI

	// CRUD Profil
	public function profil()
	{
		// id pengguna yang sedang login
		$id_pengguna = $this->session->userdata('id');

		$where = array(
			'pengguna_id' => $id_pengguna
		);

		$data['profil'] = $this->m_data->edit_data($where, 'pengguna')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_profil', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function profil_update()
	{
		// Wajib isi nama dan email
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->session->userdata('id');

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$deskripsi = $this->input->post('deskripsi');
			$foto	= $_FILES['foto'];
			if ($foto = '') {
			} else {
				$config['upload_path']		= './gambar/profil/pengguna';
				$config['allowed_types']	= 'jpg|png|jpeg';
				$config['overwrite'] 		= true;

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('foto')) {
					redirect('dashboard/profil?alert=gagal');
				} else {
					$foto = $this->upload->data('file_name');
				}
			}

			$where = array(
				'pengguna_id' => $id
			);

			$data = array(
				'pengguna_nama' => $nama,
				'pengguna_email' => $email,
				'deskripsi' => $deskripsi,
				'foto' => $foto
			);

			// update pengguna
			$this->m_data->update_data($where, $data, 'pengguna');
			redirect('dashboard/profil?alert=sukses');


			$this->load->view('dashboard/v_header', $data);
			$this->load->view('dashboard/v_profil', $data);
			$this->load->view('dashboard/v_footer', $data);
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_profil', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	// CRUD PENGATURAN

	public function pengaturan()
	{
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengaturan', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function pengaturan_update()
	{
		// Wajib isi nama dan deskripsi website
		$this->form_validation->set_rules('nama', 'Nama Website', 'required');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi Website', 'required');
		$this->form_validation->set_rules('telpon', 'Telpon', 'required');

		if ($this->form_validation->run() != false) {

			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$link_facebook = $this->input->post('link_facebook');
			$link_twitter = $this->input->post('link_twitter');
			$link_instagram = $this->input->post('link_instagram');
			$link_youtube = $this->input->post('link_youtube');
			$link_alamat = $this->input->post('link_alamat');
			$pesan_wa = $this->input->post('pesan_wa');
			$telpon = $this->input->post('telpon');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');

			$where = array();


			$data = array(
				'nama' => $nama,
				'deskripsi' => $deskripsi,
				'link_facebook' => $link_facebook,
				'link_twitter' => $link_twitter,
				'link_instagram' => $link_instagram,
				'link_youtube' => $link_youtube,
				'link_alamat' => $link_alamat,
				'pesan_wa' => $pesan_wa,
				'telpon' => $telpon,
				'alamat' => $alamat,
				'email' => $email
			);

			// update pengaturan
			$this->m_data->update_data($where, $data, 'pengaturan');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['logo']['name'])) {

				$config['upload_path']   = './gambar/website/';
				$config['allowed_types'] = 'jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('logo')) {
					// mengambil data tentang gambar logo yang diupload
					$gambar = $this->upload->data();

					$logo = $gambar['file_name'];

					$this->db->query("UPDATE pengaturan SET logo='$logo'");
				}
			}

			redirect(base_url() . 'dashboard/pengaturan/?alert=sukses');
		} else {
			$data['pengaturan'] = $this->m_data->get_data('pengaturan')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengaturan', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	// CRUD PENGGUNA
	public function pengguna()
	{
		$data['pengguna'] = $this->m_data->get_data('pengguna')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pengguna_tambah()
	{
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna_tambah');
		$this->load->view('dashboard/v_footer');
	}

	public function pengguna_aksi()
	{
		// Wajib isi
		$this->form_validation->set_rules('nama', 'Nama Pengguna', 'required|trim');
		$this->form_validation->set_rules('email', 'Email Pengguna', 'required|trim|valid_email|is_unique[pengguna.pengguna_email]');
		$this->form_validation->set_rules('username', 'Username Pengguna', 'required|trim|is_unique[pengguna.pengguna_username]');
		$this->form_validation->set_rules('deskripsi', 'Quote', 'required|trim');
		$this->form_validation->set_rules('password', 'Password Pengguna', 'required|min_length[8]');
		$this->form_validation->set_rules('level', 'Level Pengguna', 'required');
		$this->form_validation->set_rules('status', 'Status Pengguna', 'required');

		if ($this->form_validation->run() != false) {

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$level = $this->input->post('level');
			$status = $this->input->post('status');
			$deskripsi = $this->input->post('deskripsi');

			$data = array(
				'pengguna_nama' => $nama,
				'pengguna_email' => $email,
				'pengguna_username' => $username,
				'pengguna_password' => $password,
				'pengguna_level' => $level,
				'pengguna_status' => $status,
				'deskripsi' => $deskripsi
			);


			$this->m_data->insert_data($data, 'pengguna');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! data has been added</div>');

			redirect(base_url() . 'dashboard/pengguna');
		} else {
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengguna_tambah');
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pengguna_edit($id)
	{
		$where = array(
			'pengguna_id' => $id
		);
		$data['pengguna'] = $this->m_data->edit_data($where, 'pengguna')->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna_edit', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function pengguna_update()
	{
		// Wajib isi
		$this->form_validation->set_rules('nama', 'Nama Pengguna', 'required');
		$this->form_validation->set_rules('email', 'Email Pengguna', 'required');
		$this->form_validation->set_rules('username', 'Username Pengguna', 'required');
		$this->form_validation->set_rules('level', 'Level Pengguna', 'required');
		$this->form_validation->set_rules('status', 'Status Pengguna', 'required');

		if ($this->form_validation->run() != false) {

			$id = $this->input->post('id');

			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$level = $this->input->post('level');
			$status = $this->input->post('status');
			$deskripsi = $this->input->post('deskripsi');

			if ($this->input->post('password') == "") {
				$data = array(
					'pengguna_nama' => $nama,
					'pengguna_email' => $email,
					'pengguna_username' => $username,
					'pengguna_level' => $level,
					'pengguna_status' => $status,
					'deskripsi' => $deskripsi
				);
			} else {
				$data = array(
					'pengguna_nama' => $nama,
					'pengguna_email' => $email,
					'pengguna_username' => $username,
					'pengguna_password' => $password,
					'pengguna_level' => $level,
					'pengguna_status' => $status,
					'deskripsi' => $deskripsi
				);
			}

			$where = array(
				'pengguna_id' => $id
			);

			$this->m_data->update_data($where, $data, 'pengguna');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! data has been Updated</div>');

			redirect(base_url() . 'dashboard/pengguna');
		} else {
			$id = $this->input->post('id');
			$where = array(
				'pengguna_id' => $id
			);
			$data['pengguna'] = $this->m_data->edit_data($where, 'pengguna')->result();
			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_pengguna_edit', $data);
			$this->load->view('dashboard/v_footer');
		}
	}

	public function pengguna_hapus($id)
	{
		$where = array(
			'pengguna_id' => $id
		);
		$data['pengguna_hapus'] = $this->m_data->edit_data($where, 'pengguna')->row();
		$data['pengguna_lain'] = $this->db->query("SELECT * FROM pengguna WHERE pengguna_id != $id")->result();
		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_pengguna_hapus', $data);
		$this->load->view('dashboard/v_footer');
	}

	public function pengguna_hapus_aksi()
	{
		$pengguna_hapus = $this->input->post('pengguna_hapus');
		$pengguna_tujuan = $this->input->post('pengguna_tujuan');

		// hapus pengguna
		$where = array(
			'pengguna_id' => $pengguna_hapus
		);

		$this->m_data->delete_data($where, 'pengguna');

		// pindahkan semua artikel pengguna yang dihapus ke pengguna yang dipilih
		$w = array(
			'artikel_author' => $pengguna_hapus
		);

		$d = array(
			'artikel_author' => $pengguna_tujuan
		);
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Congratulation! data has been Droped</div>');
		$this->m_data->update_data($w, $d, 'artikel');

		$this->m_data->update_data($w, $d, 'guru');

		redirect(base_url() . 'dashboard/pengguna');
	}
	// END CRUD PENGGUNA

	// CRUD SAMBUTAN

	public function sambutan()
	{
		$data['sambutan'] = $this->m_data->get_data('sambutan')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_sambutan', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function sambutan_update()
	{
		// Wajib isi nama dan deskripsi website
		$this->form_validation->set_rules('nama', 'Nama Kepala', 'required');
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('konten', 'Konten', 'required');

		if ($this->form_validation->run() != false) {

			$nama = $this->input->post('nama');
			$konten = $this->input->post('konten');
			$judul = $this->input->post('judul');

			$where = array();


			$data = array(
				'nama' => $nama,
				'konten' => $konten,
				'judul' => $judul
			);

			// update sambutan
			$this->m_data->update_data($where, $data, 'sambutan');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['foto']['name'])) {

				$config['upload_path']   = './gambar/website/';
				$config['allowed_types'] = 'jpg|png|jpeg';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('foto')) {
					// mengambil data tentang gambar foto yang diupload
					$gambar = $this->upload->data();

					$foto = $gambar['file_name'];

					$this->db->query("UPDATE sambutan SET foto='$foto'");
				}
			}

			redirect(base_url() . 'dashboard/sambutan/?alert=sukses');
		} else {
			redirect(base_url() . 'dashboard/sambutan/?alert=gagal');
			$data['sambutan'] = $this->m_data->get_data('sambutan')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_sambutan', $data);
			$this->load->view('dashboard/v_footer');
		}
	}
	// END CRUD SAMBUTAN

	// CRUD PPDB

	public function infoppdb()
	{
		$data['infoppdb'] = $this->m_data->get_data('infoppdb')->result();

		$this->load->view('dashboard/v_header');
		$this->load->view('dashboard/v_infoppdb', $data);
		$this->load->view('dashboard/v_footer');
	}


	public function infoppdb_update()
	{
		// Wajib isi nama dan deskripsi website
		$this->form_validation->set_rules('nama', 'Heading', 'required');
		$this->form_validation->set_rules('judul', 'Judul', 'required');

		if ($this->form_validation->run() != false) {

			$nama = $this->input->post('nama');
			$konten = $this->input->post('konten');
			$judul = $this->input->post('judul');

			$where = array();


			$data = array(
				'nama' => $nama,
				'konten' => $konten,
				'judul' => $judul
			);

			// update infoppdb
			$this->m_data->update_data($where, $data, 'infoppdb');

			// Periksa apakah ada gambar logo yang diupload
			if (!empty($_FILES['picture']['name'])) {

				$config['upload_path']   = './gambar/info/';
				$config['allowed_types'] = 'jpg|png|jpeg|gif';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('picture')) {
					// mengambil data tentang gambar picture yang diupload
					$gambar = $this->upload->data();

					$picture = $gambar['file_name'];

					$this->db->query("UPDATE infoppdb SET picture='$picture'");
				}
			}

			redirect(base_url() . 'dashboard/infoppdb/?alert=sukses');
		} else {
			$data['infoppdb'] = $this->m_data->get_data('infoppdb')->result();

			$this->load->view('dashboard/v_header');
			$this->load->view('dashboard/v_infoppdb', $data);
			$this->load->view('dashboard/v_footer');
		}
	}
}
