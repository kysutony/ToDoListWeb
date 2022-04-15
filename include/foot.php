
</div>
<div style="padding-top: 200px;">

</div>

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
<script src="http://demos.codexworld.com/build-event-calendar-using-jquery-ajax-php/js/jquery.min.js"></script>
<script>

		function getCalendar(target_div, year, month){
			$.ajax({
				type:'POST',
				url:'https://2dolist.website/functions.php',
				data:'func=getCalender&year='+year+'&month='+month,
				success:function(html){
					$('#'+target_div).html(html);
				}
			});
		}
		
		function getEvents(date){
			$.ajax({
				type:'POST',
				url:'https://2dolist.website/functions.php',
				data:'func=getEvents&date='+date,
				success:function(html){
					$('#event_list').html(html);
				}
			});
		}
		
		$(document).ready(function(){
			$('.month-dropdown').on('change',function(){
				getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val());
			});
			$('.year-dropdown').on('change',function(){
				getCalendar('calendar_div', $('.year-dropdown').val(), $('.month-dropdown').val());
			});
		});
	</script>
  </body>
</html>
