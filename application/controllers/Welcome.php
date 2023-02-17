<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->library('form_validation');
		$this->load->model('m_data');
		$this->load->helper('tanggal_helper');
	}

	public function index()
	{
		// 4 artikel terbaru
		$data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id ORDER BY artikel_id DESC LIMIT 3")->result();


		// 4 course terbaru
		$data['guru'] = $this->db->query("SELECT * FROM guru,pengguna,kategori WHERE guru_status='publish' AND guru_author=pengguna_id AND guru_kategori=kategori_id ORDER BY guru_id DESC LIMIT 4")->result();
		$data['mapel'] = $this->db->query("SELECT * FROM guru,pengguna,kategori WHERE guru_status='publish' AND guru_author=pengguna_id AND guru_kategori=kategori_id ORDER BY guru_id DESC LIMIT 3")->result();

		//Ambil Pengaturan
		$data['pengaturan'] = $this->db->query("SELECT * FROM pengaturan")->result();

		//Ambil Video
		$data['kata'] = $this->m_data->get_data('kata')->result();


		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// data pengaturan website
		$data['galeri'] = $this->db->query("SELECT * FROM galeri,kat_galeri WHERE galeri_kategori=kat_galeri_id")->result();

		// data pengaturan website
		$data['kat_galeri'] = $this->m_data->get_data('kat_galeri')->result();

		// data sambutan website
		$data['sambutan'] = $this->m_data->get_data('sambutan')->result();

		// data sambutan website
		$data['infoppdb'] = $this->m_data->get_data('infoppdb')->result();

		// data banner index
		$data['banner'] = $this->m_data->get_data('banner')->result();

		// data partner
		$data['partner'] = $this->m_data->get_data('partner')->result();

		// data faq
		$data['faq'] = $this->m_data->get_data('faq')->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_homepage', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	public function single($slug)
	{
		$data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id AND artikel_slug='$slug'")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		if (count($data['artikel']) > 0) {
			$data['meta_keyword'] = $data['artikel'][0]->artikel_judul;
			$data['meta_description'] = substr($data['artikel'][0]->artikel_konten, 0, 200);
		} else {
			$data['meta_keyword'] = $data['pengaturan']->nama;
			$data['meta_description'] = $data['pengaturan']->deskripsi;
		}

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_single', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	public function det_guru($slug)
	{
		$data['guru'] = $this->db->query("SELECT * FROM guru,pengguna,kategori WHERE guru_status='publish' AND guru_author=pengguna_id AND guru_kategori=kategori_id AND guru_slug='$slug'")->result();
		$data['popular'] = $this->db->query("SELECT * FROM guru,pengguna,kategori WHERE guru_status='publish' AND guru_author=pengguna_id AND guru_kategori=kategori_id ORDER BY guru_id DESC LIMIT 8")->result();

		//Ambil Pengaturan
		$data['pengaturan'] = $this->db->query("SELECT * FROM pengaturan")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		if (count($data['guru']) > 0) {
			$data['meta_keyword'] = $data['guru'][0]->guru_judul;
			$data['meta_description'] = substr($data['guru'][0]->guru_konten, 0, 200);
		} else {
			$data['meta_keyword'] = $data['pengaturan']->nama;
			$data['meta_description'] = $data['pengaturan']->deskripsi;
		}

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_det_guru', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	public function galeri()
	{

		// data pengaturan website
		$data['galeri'] = $this->db->query("SELECT * FROM galeri,kat_galeri WHERE galeri_kategori=kat_galeri_id")->result();
		$data['kat_galeri'] = $this->m_data->get_data('kat_galeri')->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_galeri', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	// CRUD DAFTAR

	public function daftar_aksi()
	{

		// data pengaturan website
		$data['pendidikan'] = $this->m_data->get_data('pendidikan')->result();
		// data pengaturan website
		$data['pekerjaan'] = $this->m_data->get_data('pekerjaan')->result();
		// data pengaturan website
		$data['jurusan'] = $this->m_data->get_data('jurusan')->result();
		// data pengaturan website
		$data['pendapatan'] = $this->m_data->get_data('pendapatan')->result();
		// data pengaturan website
		$data['provinsi'] = $this->m_data->get_data('provinsi')->result();
		// data pengaturan website
		$data['gender'] = $this->m_data->get_data('gender')->result();
		// data pengaturan website
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
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat! data anda telah kami terima untuk dilakukan verifikasi terlebih dahulu</div>');
			redirect(base_url() . 'welcome/daftar_aksi');
		}

		//Ambil Pengaturan
		// $data['pengaturan'] = $this->db->query("SELECT * FROM pengaturan")->result();
		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();
		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;



		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_pendaftaran');
		$this->load->view('frontend/v_footer', $data);
	}


	public function blog()
	{

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;


		// $this->load->database();
		$jumlah_data = $this->m_data->get_data('artikel')->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'blog/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 6;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class=""><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="" active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class=""><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class=""><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class=""><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class=""><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$from = $this->uri->segment(2);
		if ($from == "") {
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id ORDER BY artikel_id DESC LIMIT $config[per_page] OFFSET $from")->result();

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_blog', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	public function guru()
	{
		//Ambil Pengaturan
		$data['pengaturan'] = $this->db->query("SELECT * FROM pengaturan")->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;


		// $this->load->database();
		$jumlah_data = $this->m_data->get_data('guru')->num_rows();
		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'guru/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 6;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$from = $this->uri->segment(2);
		if ($from == "") {
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['guru'] = $this->db->query("SELECT * FROM guru,pengguna,kategori WHERE guru_status='publish' AND guru_author=pengguna_id AND guru_kategori=kategori_id ORDER BY guru_id DESC LIMIT $config[per_page] OFFSET $from")->result();

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_guru', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	public function page($slug)
	{

		$where = array(
			'halaman_slug' => $slug
		);

		$data['halaman'] = $this->m_data->edit_data($where, 'halaman')->result();

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_page', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	public function kategori($slug)
	{

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		$jumlah_artikel = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id AND kategori_slug='$slug'")->num_rows();
		$data['jum_kat'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id AND kategori_slug='$slug' ORDER BY artikel_id DESC LIMIT 1")->result();

		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'kategori/' . $slug;
		$config['total_rows'] = $jumlah_artikel;
		$config['per_page'] = 3;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$from = $this->uri->segment(3);
		if ($from == "") {
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id AND kategori_slug='$slug' ORDER BY artikel_id DESC LIMIT $config[per_page] OFFSET $from")->result();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_kategori', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	public function search()
	{
		//mengambil nilai keyword dari form pencarian
		$cari = htmlentities((trim($this->input->post('cari', true))) ? trim($this->input->post('cari', true)) : '');
		$blog = htmlentities((trim($this->input->post('cari', true))) ? trim($this->input->post('cari', true)) : '');

		//jika uri segmen 2 ada, maka nilai variabel $search akan diganti dengan nilai uri segmen 2
		$cari = ($this->uri->segment(2)) ? $this->uri->segment(2) : $cari;
		$blog = ($this->uri->segment(2)) ? $this->uri->segment(2) : $blog;

		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$jumlah_artikel = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id AND (artikel_judul LIKE '%$cari%' OR artikel_konten LIKE '%$cari%')")->num_rows();

		$this->load->library('pagination');
		$config['base_url'] = base_url() . 'search/' . $cari;
		$config['total_rows'] = $jumlah_artikel;
		$config['per_page'] = 3;

		$config['first_link']       = 'First';
		$config['last_link']        = 'Last';
		$config['next_link']        = 'Next';
		$config['prev_link']        = 'Prev';
		$config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
		$config['full_tag_close']   = '</ul></nav></div>';
		$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close']    = '</span></li>';
		$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close']  = '</span>Next</li>';
		$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';


		$from = $this->uri->segment(3);
		if ($from == "") {
			$from = 0;
		}
		$this->pagination->initialize($config);

		$data['artikel'] = $this->db->query("SELECT * FROM artikel,pengguna,kategori WHERE artikel_status='publish' AND artikel_author=pengguna_id AND artikel_kategori=kategori_id AND (artikel_judul LIKE '%$cari%' OR artikel_konten LIKE '%$cari%') ORDER BY artikel_id DESC LIMIT $config[per_page] OFFSET $from")->result();
		$data['cari'] = $cari;
		$data['blog'] = $blog;
		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_search', $data);
		$this->load->view('frontend/v_footer', $data);
	}

	public function notfound()
	{
		// data pengaturan website
		$data['pengaturan'] = $this->m_data->get_data('pengaturan')->row();

		// SEO META
		$data['meta_keyword'] = $data['pengaturan']->nama;
		$data['meta_description'] = $data['pengaturan']->deskripsi;

		$this->load->view('frontend/v_header', $data);
		$this->load->view('frontend/v_notfound', $data);
		$this->load->view('frontend/v_footer', $data);
	}
}
