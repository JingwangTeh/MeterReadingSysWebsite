$(function() {
    var slides = $('#slider ul').children().length;
    var slideWidth = $('#slider').width();
    var min = 0;
    var max = -((slides - 1) * slideWidth);
	
	$("#slider ul").draggable({
		axis: 'x',
		start: function(event, ui) {
			// update values
			slideWidth = $('#slider').width();
			max = -((slides - 1) * slideWidth);
		},
		drag: function(event, ui) {
            if (ui.position.left > (min + (slideWidth * 0)) ) ui.position.left = min;
            if (ui.position.left < (max - (slideWidth * 0)) ) ui.position.left = max;
		},
		stop: function(event, ui) {
			if (ui.position.left % slideWidth != 0) {
				var finalSlideNum_beforeRounding = Math.abs(ui.position.left / slideWidth) + 1;
				var finalSlideNum = Math.round(finalSlideNum_beforeRounding);
				
				/* Change Slide Num depending on direction after slide */
				if (finalSlideNum_beforeRounding > finalSlideNum) finalSlideNum++;
				else if (finalSlideNum_beforeRounding < finalSlideNum) finalSlideNum--;
				
				var updatedPosition = -((finalSlideNum - 1) * slideWidth) + "px";
				$('#slider ul').css("left", updatedPosition);
				
				slideIndex = finalSlideNum;
				updateDots("team-navcircle");
			}
		}
	});
});




function updateSlide(sectionObject){
	
	var wrapper = document.getElementById(sectionObject.sectionWrapper);
	for (var i=0; i < wrapper.children.length; i++){
		wrapper.children[i].classList.remove(sectionObject.sectionActiveClassName);
	}
	
	var sectionToDisplay = document.getElementById(sectionObject.sectionArray[(++sectionObject.sectionArrayIndex)%sectionObject.sectionArray.length]);
	sectionToDisplay.classList.add(sectionObject.sectionActiveClassName);
	
}