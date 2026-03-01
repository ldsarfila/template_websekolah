
# Template WordPress Sekolah Indonesia

## Deskripsi
Template WordPress profesional untuk website sekolah dengan fitur lengkap dan responsif.

## Fitur Utama

### Komponen:
- **Header & Navigation** - Menu navigasi sticky
- **Hero Section** - Banner selamat datang
- **Sambutan Kepala Sekolah** - Section untuk sambutan
- **Statistik Data** - Display jumlah guru, siswa, rombel
- **Agenda** - Daftar agenda kegiatan sekolah
- **Berita & Artikel** - Blog untuk berita sekolah
- **Guru** - Directory guru dengan detail lengkap
- **Fasilitas** - Showcase fasilitas sekolah
- **Ekstrakurikuler** - Daftar kegiatan ekstrakurikuler
- **Testimoni** - Testimonial dari alumni dan orang tua
- **Footer** - Footer dengan social media dan link penting

### Custom Post Types:
1. **Guru** - Untuk menampilkan data guru
2. **Fasilitas** - Untuk fasilitas sekolah
3. **Ekstrakurikuler** - Untuk kegiatan ekstrakurikuler
4. **Program Keahlian** - Untuk program keahlian (SMK)
5. **Agenda** - Untuk agenda kegiatan

### Fitur Teknis:
- ✅ Fully Responsive Design
- ✅ Mobile-First Approach
- ✅ SEO Optimized
- ✅ Widget Support
- ✅ Custom Logo Support
- ✅ Featured Images
- ✅ Comments Support
- ✅ Related Posts
- ✅ Pagination
- ✅ Search Functionality

## File Structure

```
sekolah-indonesia/
├── style.css              # CSS utama
├── functions.php          # Fungsi tema
├── header.php             # Header template
├── footer.php             # Footer template
├── index.php              # Template indeks
├── home.php               # Template homepage
├── single.php             # Template single post
├── archive.php            # Template archive
├── page.php               # Template page
├── single-guru.php        # Template single guru
├── single-fasilitas.php   # Template single fasilitas
├── single-ekskul.php      # Template single ekstrakurikuler
├── single-program.php     # Template single program
├── archive-guru.php       # Template archive guru
├── archive-agenda.php     # Template archive agenda
├── search.php             # Template search
├── 404.php                # Template 404
├── js/
│   └── main.js            # JavaScript utama
├── images/                # Folder untuk gambar
└── README.md              # File ini
```

## Instalasi

1. **Upload Template ke WordPress:**
   - Copy folder `sekolah-indonesia` ke `/wp-content/themes/`

2. **Aktifkan Template:**
   - Masuk ke WordPress Dashboard
   - Pilih **Appearance → Themes**
   - Cari **Sekolah Indonesia**
   - Klik **Activate**

3. **Konfigurasi Awal:**
   - Buat menu di **Appearance → Menus**
   - Assign menu ke **Primary Menu**
   - Upload logo di **Appearance → Customize → Site Identity**
   - Setup widgets di **Appearance → Widgets**

## Cara Menggunakan

### Menambah Content:

1. **Posts (Berita):**
   - Gunakan Posts biasa WordPress
   - Akan tampil di homepage section "Berita, Artikel & Informasi"

2. **Guru:**
   - Buat post baru tipe "Guru"
   - Isi judul, deskripsi, dan foto
   - Publish

3. **Fasilitas:**
   - Buat post baru tipe "Fasilitas"
   - Isi deskripsi dan foto fasilitas

4. **Ekstrakurikuler:**
   - Buat post baru tipe "Ekstrakurikuler"
   - Tambahkan deskripsi dan foto kegiatan

5. **Agenda:**
   - Buat post baru tipe "Agenda"
   - Isi tanggal dan detail kegiatan

6. **Pages:**
   - Gunakan untuk halaman statis seperti "Tentang Kami", "Kontak", dll

### Customize Homepage:

Homepage menampilkan semua section secara otomatis. Untuk edit konten:

1. Edit atau buat posts dengan title "Sambutan Kepala Sekolah"
2. Statistik bisa diupdate via code atau custom fields
3. Semua custom post types akan otomatis tampil

## Customization

### Mengubah Warna:
Edit variables di style.css:

```css
:root {
  --primary-color: #1e40af;      /* Warna utama biru */
  --secondary-color: #f59e0b;    /* Warna accent kuning */
  --text-dark: #1f2937;          /* Warna text gelap */
  --text-light: #6b7280;         /* Warna text terang */
}
```

### Menambah Widget Area:
Edit `functions.php` di function `sekolah_indonesia_widgets_init()`

### Menambah Menu:
Edit `header.php` untuk posisi menu baru

## Browser Support
- Chrome
- Firefox
- Safari
- Edge
- Mobile Browsers (iOS Safari, Chrome Mobile)

## Requirements
- WordPress 6.0+
- PHP 8.4+
- MySQL 8+

## Plugin Rekomendasi

### Plugin untuk Formulir Penerimaan Siswa Baru:

#### 1. **WPForms** ⭐ (Rekomendasi Utama)
- **Fitur:**
  - Drag-n-drop form builder
  - Conditional logic
  - Payment gateway integration
  - Email notification
  - Export to Excel/CSV
  - File upload support
  
- **Kelebihan:**
  - User-friendly
  - Lightweight
  - Mobile responsive
  - Good support
  
- **Link:** https://wpforms.com

#### 2. **Gravity Forms**
- **Fitur:**
  - Advanced form builder
  - Conditional routing
  - Payment integration
  - Post creation from form
  - Advanced calculations
  
- **Kelebihan:**
  - Sangat powerful
  - Banyak add-ons
  - Enterprise level
  
- **Link:** https://www.gravityforms.com

#### 3. **Forminator**
- **Fitur:**
  - Free version yang powerful
  - Google Sheets integration
  - Email notifications
  - Conditional logic
  - Signature field support
  
- **Kelebihan:**
  - Gratis dengan fitur lengkap
  - Made by Jetpack team
  - User-friendly
  
- **Link:** https://wordpress.org/plugins/forminator/

#### 4. **Contact Form 7** (Basic)
- **Fitur:**
  - Simple form builder
  - Email notifications
  - File attachment
  - CAPTCHA support
  
- **Kelebihan:**
  - Lightweight
  - Free
  - Simple to use
  
- **Link:** https://wordpress.org/plugins/contact-form-7/

### Rekomendasi Setup Formulir Penerimaan Siswa Baru

#### Pilih salah satu dari:

**Untuk Pemula:** 
```
Contact Form 7 (Gratis & Simple)
atau
Forminator (Gratis & Lebih Powerful)
```

**Untuk Professional:**
```
WPForms (Recommended - Balance fitur & kemudahan)
```

**Untuk Enterprise:**
```
Gravity Forms (Paling Powerful)
```

### Konten Form yang Disarankan

```
1. DATA PRIBADI SISWA:
   - Nama lengkap
   - Jenis kelamin
   - Tempat, tanggal lahir
   - No. Induk Siswa Lama (NISN)
   - Agama
   - Alamat lengkap

2. KONTAK:
   - No. Telepon
   - Email
   - Nama orang tua/wali
   - No. Telepon orang tua

3. DATA SEKOLAH:
   - Sekolah asal
   - Kelas tujuan
   - Program pilihan (jika ada)
   - Nilai rata-rata
   - Prestasi (jika ada)

4. FILE UPLOAD:
   - Scan nilai rapor
   - Foto 3x4
   - SKHU (Surat Keterangan Hasil Ujian)
   - Akta kelahiran

5. KONFIRMASI:
   - Checkbox persetujuan
   - CAPTCHA verification
```

### Integrasi dengan Google Sheets (Opsional)

Jika ingin otomatis menyimpan data ke Google Sheets:
- **WPForms** → Download add-on "Google Sheets"
- **Forminator** → Built-in Google Sheets integration
- **Gravity Forms** → Download add-on "Google Sheets"

### Email Notification Template

```
Halo [Nama Siswa],

Terima kasih telah mendaftar di [Nama Sekolah].

Data pendaftaran Anda:
- NISN: [NISN]
- Nama: [Nama]
- Sekolah Asal: [Sekolah Asal]
- Kelas Tujuan: [Kelas]

Tim kami akan menghubungi Anda dalam 3 hari kerja.

Salam,
[Nama Sekolah]
```

### Custom Post Type untuk Pendaftar (Optional)

Untuk tracking pendaftar lebih advanced, edit `functions.php`:

```php
register_post_type('pendaftar', array(
    'labels'       => array(
        'name'          => __('Pendaftar', 'sekolah-indonesia'),
        'singular_name' => __('Pendaftar', 'sekolah-indonesia')
    ),
    'public'       => false,
    'show_ui'      => true,
    'has_archive'  => false,
    'supports'     => array('title'),
    'menu_icon'    => 'dashicons-clipboard'
));
```

Kemudian setup form untuk automatically create post dari form submission.

## Support
Untuk pertanyaan atau issue, silakan hubungi developer.

## License
GPL v2 or later

---

**Happy Creating! 🎉**

