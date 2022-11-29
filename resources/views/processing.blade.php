swal({
	title: '',
	text: "Sedang memproses, harap menunggu...",
	{{-- imageUrl: '{{asset('image/loading.gif')}}', --}}
	html: '<div style="display: flex; justify-content: center; flex-direction: column; align-items: center;"><div class="loader-spinner"></div><div style="margin-top: 20px; font-size: 16px; color: #68666f;">Sedang Memproses, harap menunggu...</div><div>',
	showCancelButton: false,
	showConfirmButton: false,
	allowOutsideClick: false,
	showLoaderOnConfirm: false
});