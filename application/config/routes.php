<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'welcome';

// route login
$route['login'] = 'login';

// route dashboard
$route['dashboard'] = 'dashboard';

// route untuk halaman blog
$route['blog'] = 'welcome/blog';
$route['blog/(:num)'] = 'welcome/blog/$1';

// route untuk halaman guru
$route['guru'] = 'welcome/guru';
$route['guru/(:num)'] = 'welcome/guru/$1';

// route untuk halaman event
$route['course'] = 'welcome/course';
$route['course/(:num)'] = 'welcome/course/$1';

// route untuk halaman kategori artikel
$route['kategori/(:any)'] = 'welcome/kategori/$1';
$route['kategori/(:any)/(:num)'] = 'welcome/kategori/$1/$s2';

// route untuk halaman cari artikel
$route['search'] = 'welcome/search';
$route['search/(:any)'] = 'welcome/search/$1';
$route['search/(:any)/(:num)'] = 'welcome/search/$1/$2';

// route untuk halaman page
$route['page/(:any)'] = 'welcome/page/$1';

// route URL SEO untuk artikel
$route['(:any)'] = 'welcome/single/$1';

// route URL SEO untuk event
$route['det_guru'] = 'welcome/det_guru';

// membuat single baru
$route['det_guru/(:any)'] = 'welcome/det_guru/$1';

// route URL SEO untuk daftar
$route['daftar_aksi'] = 'welcome/daftar_aksi';

// route untuk galeri
$route['galeri'] = 'welcome/galeri';

$route['404_override'] = 'welcome/notfound';
$route['translate_uri_dashes'] = FALSE;
