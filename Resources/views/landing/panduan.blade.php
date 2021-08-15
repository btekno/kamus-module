@extends('qamus::landing.layouts.app')
@section('title', 'Panduan')
@section('mPanduan', 'active')

@section('content')

	<div class="kx-judul mb-5">
		<h2 class="text-3xl font-bold">Panduan Kontribusi</h2>
		<p class="font-medium text-gray-500 leading-5">
			Berikut tata cara buat kamu yang pengen berkontribusi.
		</p>
	</div>

<ol>
	<li><p>Masukkan kata yang ingin kamu <b>tambahkan</b> melalui kolom pencarian.</p>
<img src="https://kamus.btekno.id/assets/kamus/images/kontribusi-1.png" width="100%" class="mb-3"></li><li><p>Tentukan Bahasa dari kata yang ingin kamu input.</p>
<img src="https://kamus.btekno.id/assets/kamus/images/kontribusi-2.png" width="200px" class="mb-3"></li><li><p>Selanjutnya temukan kata <b>Klik di sini untuk berkontribusi</b> pada panel <b>Frasa</b></p>
<img src="https://kamus.btekno.id/assets/kamus/images/kontribusi-3.png" width="100%" class="mb-3"></li><li><p>Lengkapi form isian yang disediakan:</p><ul><li class="text-muted"><small>• Kamu bisa mengupload suara kamu tentang bagaimana cara penyebutan katanya melalui <b>Audio (Pelafalan)</b></small></li><li class="text-muted"><small>• Kamu juga bisa mengupload <b>Gambar</b> yang mencerminkan dari kata yang kamu input.</small></li></ul>
<img src="https://kamus.btekno.id/assets/kamus/images/kontribusi-4.png" width="100%" class="mb-3"></li><li><p>Kata yang kamu kontribusikan akan masuk dalam list <b>Terjemahan yang disarankan</b> dan akan di patenkan menjadi terjemahan asli setelah di konfirmasi oleh pihak <b>Pengelola</b>.</p>
<img src="https://kamus.btekno.id/assets/kamus/images/kontribusi-5.png" width="100%" class="mb-3"></li><li><p>Selesai dan Terima kasih.</p></li>
</ol>
@endsection