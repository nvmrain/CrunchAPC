//add clcik listener to submit button
setTimeout(function(){
	$('.btn#comfirm-select').on('click', function() {
		selectBuild();
	})
}, 0)

//attach image to picture box div
function selectBuild() {
	var id = $('#selectBuildID').val();
	$.ajax({
		type: "POST",
		url:  "/home/selectBuild/" + id,
		//data: {id : id},
		success:function(data) {
			console.log('hello');
			console.log(typeof(data));
			console.log(data);
			if (data == null || data == undefined || data == '') {
				console.log('there is no data');
			}
			$('.picture-box').html(data);
		}
	});
}

