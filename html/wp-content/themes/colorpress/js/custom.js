$(document).ready(function(){
	
	$("#myController3").jFlow({
		slides: "#mySlides3",
		controller: ".jFlowControl3", // must be class, use . sign
		slideWrapper : "#jFlowSlide3", // must be id, use # sign
		selectedWrapper: "jFlowSelected3",  // just pure text, no sign
		easing: "swing",
		duration: 400,
		height: "260px",
		prev: ".jFlowPrev3", // must be class, use . sign
		next: ".jFlowNext3" // must be class, use . sign
	});
	

	$('.menu a').hover(function() { //mouse in
		$(this).animate({ paddingLeft: '30px' }, 200);
	}, function() { //mouse out
		$(this).animate({ paddingLeft:'20px' }, 200); });
	
		$('div.jFlowPrev3').hover(function() { //mouse in
		$(this).animate({ left: '10px' }, 200);
	}, function() { //mouse out
		$(this).animate({ left:'20px' }, 200); });
		
		$('div.jFlowNext3').hover(function() { //mouse in
		$(this).animate({ right: '10px' }, 200);
	}, function() { //mouse out
		$(this).animate({ right:'20px' }, 200); });

	$("#accordion").accordion();

	$('ul.superfish').superfish({ 
		delay:       150,                            // one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
		speed:       'fast',                          // faster animation speed 
		autoArrows:  true,                           // disable generation of arrow mark-up 
		dropShadows: false                            // disable drop shadows 
	}); 
	
	$('ul#catnav').superfish({ 
		delay:       150,                            // one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
		speed:       'fast',                          // faster animation speed 
		autoArrows:  true,                           // disable generation of arrow mark-up 
		dropShadows: false                            // disable drop shadows 
	}); 
	
});