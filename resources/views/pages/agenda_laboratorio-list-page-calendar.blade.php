	<div class="card-4 mb-3" >
		@section('plugins')
			<link rel="stylesheet" href="{{ asset('css/fullcalendar-main.min.css') }}" />
			<script type="text/javascript" src="{{ asset('js/fullcalendar-main.min.js') }}"></script>
			<script type="text/javascript" src="{{ asset('js/pt-br.js') }}"></script>
		@endsection
		<?php
			$events = [];
		if(!empty($records)){
			foreach ($records as $data) {
				$id = $data['id'];
				$title = $data['titulo'];
				$start = ($data['data_inicio'] ? $data['data_inicio'] : date_now());
				if($data['hora_inicio']){
					$start .= " " . $data['hora_inicio'];
				}
		$end = ($data['data_termino'] ? $data['data_termino'] : date_now());
				if($data['']){
					$end .= " " . $data[''];
				}
		$color = ($data['confirmacao'] ? $data['confirmacao'] : null);
				$events[] = [
					'id' => $id,
					'title' => $title,
					'start' => $start,
					'end' => $end, 
					'color' => $color, 
					'textColor' => '',
					'className' => 'p-1 cursor-pointer',
				];
			}
		}
		?>
		<script>
			var calendar;
			document.addEventListener('DOMContentLoaded', function() {
				var calendarEl = document.getElementById('calendar');
				calendar = new FullCalendar.Calendar(calendarEl, {
					initialView: 'dayGridMonth',
					locale: 'pt-br',
					headerToolbar: {
						center: 'timeGridWeek,dayGridMonth,listWeek',
						right: 'today,prev,next',
					},
					height: "80vh",
					selectable: true,
					events: <?php echo json_encode($events); ?>,
					eventClick: function(info) {
						var pageUrl = "<?php print_link("agenda_laboratorio/view/") ?>/" + info.event.id;
						var modal = $('#main-page-modal');
						modal.modal({show:true});
						modal.find('.modal-body').html(loadingIndicator).load(pageUrl, function(responseText, status, req){
							if(status == 'error'){
								$(this).html(responseText);
							}
							initPlugins();
						});
					},
				});
				calendar.render();
			});
		</script>
		<div id="calendar"></div>
	</div>
