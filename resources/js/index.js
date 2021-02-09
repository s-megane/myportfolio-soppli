jQuery(function() {
		$.each($(".ability"), function(i, val) {
			if($(val).text() === "S"){
				$(val).css('color','#ffc0cb');
			}else if($(val).text() === "A"){
				$(val).css('color','#ff1493');
			}else if($(val).text() === "B"){
				$(val).css('color','#ff0000')
			}else if($(val).text() === "C"){
				$(val).css('color','#ffa500')
			}else if($(val).text() === "D"){
				$(val).css('color','#ffff00')
			}else if($(val).text() === "E"){
				$(val).css('color','#32cd32')
			}else if($(val).text() === "F"){
				$(val).css('color','#0000cd')
			}else{
				$(val).css('color','#8b008b')
			}
		});
		$.each($(".rank"), function(i,val) {
			//console.log(val);
			if($(val).text() ==='1位'){
				//$(val).text('1位');
				$(val).css('color','#ffd700');
				$(val).css('font-weight', '700');
				
			}else if($(val).text() ==='2位'){
				//$(val).text('2位');
				$(val).css('color','#c0c0c0');
				$(val).css('font-weight', '600');
				
			}else if($(val).text() === '3位'){
				//$(val).text('3位');
				$(val).css('color','#a52a2a');
				$(val).css('font-weight', '500');
			}
		});
		
		
		
		
		
		// $.each($(".ave"), function(i, val) {
		// 	if(i === 0){
		// 		//$(val).css('color','#AA0000');
		// 		$(val).css('font-weight', '700');
		// 		console.log('true',i,val);
		// 	}
		// });
		// $.each($(".hr"), function(i, val) {
		// 	if(i === 0){
		// 		//$(val).css('color','#AA0000');
		// 		$(val).css('font-weight', '700');
		// 		console.log('true',i,val);
		// 	}
		// });
		// $.each($(".rbi"), function(i, val) {
		// 	if(i === 0){
		// 		//$(val).css('color','#AA0000');
		// 		$(val).css('font-weight', '700');
		// 		console.log('true',i,val);
		// 	}
		// });
		
		
		$('.games').css('font-size' , '30px');
		$(".fade").css({
    		left:"-100px",
    		opacity:"0.0"
		}).animate({
    		left:"100px",
    		opacity:"1.0"
		},3200);
	

}(jQuery));