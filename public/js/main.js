var url= 'https://prlaravel-production.up.railway.app';
window.addEventListener("load", function () {
	$('.btn-like').css('cursor', 'pointer');
	$('.btn-dislike').css('cursor', 'pointer');

	function like() {
		$('.btn-like').unbind('click').click(function () {
			$(this).addClass('btn-dislike').removeClass('btn-like');
			$(this).attr('src', url+'/img/heart-red.png');
			$.ajax({
				url: url+'/like/' + $(this).data('id'),
				type: 'GET',
				success: function(response){
					console.log(response)
				}
			});
			dislike();
		});
	}
	like();
	function dislike() {
		$('.btn-dislike').unbind('click').click(function () {
			$(this).addClass('btn-like').removeClass('btn-dislike');
			$(this).attr('src', url+'/img/heart-black.png');
			$.ajax({
				url: url+'/dislike/' + $(this).data('id'),
				type: 'GET',
				success: function(response){
					console.log(response)
				}
			});

			like();
		});
	}
	dislike();
});
