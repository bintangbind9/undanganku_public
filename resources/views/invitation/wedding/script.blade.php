    <script src="{{asset('assets/stisla/sweetalert/dist/sweetalert.min.js')}}"></script>

	<script src="https://unpkg.com/wavesurfer.js"></script>

	@include('layouts.script_custom_format_date_time')

	<script type="text/javascript">
        var paginate = '{{Constant::MAX_GREETING_DISPLAYED}}';
		var page = 1;
        loadMoreData(paginate, page);

		$('#btn-load-more-greeting').click(function() {
			page++;
			loadMoreData(paginate, page);
		});

        function loadMoreData(paginate, page) {
            $.ajax({
                url: "{{route('greeting.get', [$template_category->id, $template_user->user_id, ''])}}" + '/' + paginate + '?page=' + page,
                type: 'get',
				// headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                datatype: 'json',
                beforeSend: function() {
					$('#btn-load-more-greeting').hide();
                    $('.loading').show();
                }
            })
            .done(function(data) {
				var jsonResult = JSON.parse(data['greeting']);
				var dataResult = jsonResult['data'];
                if(dataResult.length == 0) {
					$('#btn-load-more-greeting').hide();
					$('.loading').hide();
					$('#no-more-data').show();
                    return;
				} else {
					$('#btn-load-more-greeting').show();
                    $('.loading').hide();
					for (const i in dataResult) {
						$('#load_greeting').append(generate_greeting_item_html(dataResult[i].guest_name, dataResult[i].date, dataResult[i].greeting));
					}
				}
            })
			.fail(function(jqXHR, ajaxOptions, thrownError) {
				swal('Something went wrong.', {icon: 'error'});
			});
        }
    </script>

    <script>
		var player = WaveSurfer.create({
			container: '#player',
			backend: 'MediaElement', // Auto Play walaupun belum selesai draw wave-nya
			// waveColor: 'gray',
			// progressColor: '#6777ef',
			// height: 30,
			// cursorColor: '#6777ef',
			// responsive: true,
		});

		// Jika Pake WaveSurfer
		player.on('ready', function () {
			player.play();
			$('#music-rotate').css('animation-play-state','running');
		});

		player.on('finish', function () {
			player.play();
		});

		$('.music-console').click(function() {
			if ($('#music-rotate').css('animation-play-state') == 'running') {
				player.pause();
				$('#music-rotate').css('animation-play-state','paused');
			} else {
				player.play();
				$('#music-rotate').css('animation-play-state','running');
			}
		});

		$('.btn-update-presence').click(function() {
			// $('#guest_name').prop("disabled", false);
			$.ajax({
				url: "{{route('invitation.guest.update_presence',[$template_category->name,$template_user->user_url])}}",
				type: 'PUT',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {name: $('#guest_name').val(), presence: $('#guest_presence').val(), type: $(this).data('type')},
				success: function (data) {
					if (data['success'] || data['warning']) {
						if (data['success']) {
							swal(data['success'], {icon: 'success',});
						} else {
							swal(data['warning'], {icon: 'warning',});
						}
						$('#info-batal-atau-abaikan').text(data['info-batal-atau-abaikan']);
						$('#info-status-hadir').text(data['info-status-hadir']);
						$('#info-jumlah-hadir').text(data['info-jumlah-hadir']);
						if (data['info-jumlah-hadir'] > 0) {
							$('.info-jumlah-tamu-dan-tombol-batalkan').css('display', 'block');
							$('.btn-update-presence[data-type="UPDATE"]').text('Update kehadiran');
						} else {
							$('.info-jumlah-tamu-dan-tombol-batalkan').css('display', 'none');
							$('.btn-update-presence[data-type="UPDATE"]').text('Saya akan datang');
						}
						setDivInfoStatusHadir();
					} else if (data['error']) {
						swal(data['error'], {icon: 'error',});
					} else {
						swal('Whoops Something went wrong!!', {icon: 'warning',});
					}
				},
				error: function (data) {
					// swal(data.responseText);
					// swal('Whoops Something went wrong!!\n\n' + data.responseText);
					swal('Maaf, terjadi kesalahan!', {icon: 'error'});
					// location.reload();
				}
			});
		});

		$('#btn-create-greeting').click(function() {
			$('#modalGreeting').modal('show');
		});

		$('#btnSaveGreeting').click(function() {
			$.ajax({
				url: "{{route('invitation.guest.store_greeting',[$template_category->name,$template_user->user_url])}}",
				type: 'POST',
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				data: {name: $('#guest_name').val(), greeting: $('textarea[name="greeting"]').val()},
				success: function (data) {
					if (data['success']) {
						swal(data['success'], {icon: 'success',});
						$('textarea[name="greeting"]').val('');
						$('#modalGreeting').modal('hide');
					} else if (data['warning']) {
						swal(data['warning'], {icon: 'warning',});
					} else if (data['error']) {
						swal(data['error'], {icon: 'error',});
					} else {
						swal('Whoops Something went wrong!!', {icon: 'warning',});
					}
				},
				error: function (data) {
					swal('Maaf, terjadi kesalahan!', {icon: 'error'});
				}
			});
		});

		$('#btn-load-greeting').click(function() {
			$('#modalLoadGreeting').modal('show');
		});
	</script>