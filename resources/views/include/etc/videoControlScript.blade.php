window.onload = function() {

	var video = document.getElementById("video");

	var playButton = document.getElementById("play-pause");
	var muteButton = document.getElementById("mute");
	var stopButton =  document.getElementById("stop");
	var fullScreenButton = document.getElementById("full-screen");

	var seekBar = document.getElementById("seek-bar");
	var volumeBar = document.getElementById("volume-bar");
	var fastForward = document.getElementById("fast-forward");
	var toogle = false;
if (video!=null){
playButton.addEventListener("click", function() {
		if (video.paused == true) {
			video.play();
			playButton.innerHTML = '<i class="fa fa-pause"></i>';
		} else {
			video.pause();
			playButton.innerHTML = '<i class="fa fa-play"></i>';
		}
		  // alert("Seekable Start: " + video.seekable.start(0) + " Seekable End: "  + video.seekable.end(0)+" Seekable Length: "+video.length);
	});

stopButton.addEventListener("click", function() {
		video.pause();
		video.currentTime = 0;
		playButton.innerHTML = '<i class="fa fa-play-circle"></i>';
	});

	muteButton.addEventListener("click", function() {
		if (video.muted == false) {
			video.muted = true;
			muteButton.innerHTML = '<i class="fa fa-volume-off"></i>';
		} else {
			video.muted = false;
			muteButton.innerHTML = '<i class="fa fa-volume-up"></i>';
		}
	});

	fullScreenButton.addEventListener("click", function() {
		if (video.requestFullscreen) {
			video.requestFullscreen();
		} else if (video.mozRequestFullScreen) {
    video.mozRequestFullScreen(); // Firefox
  } else if (video.webkitRequestFullscreen) {
    video.webkitRequestFullscreen(); // Chrome and Safari
  }
});


	seekBar.addEventListener("change", function() {
		var time = video.duration * (seekBar.value / 100);
		video.currentTime = time;
		console.log(time);
		console.log(video.currentTime);
	});

	video.addEventListener("timeupdate", function() {
		var value = (100 / video.duration) * video.currentTime;
		seekBar.value = value;
		console.log(video.currentTime);
		
	});

	seekBar.addEventListener("mousedown", function() {
		video.pause();
	});

	seekBar.addEventListener("mouseup", function() {
		video.play();
	});

	volumeBar.addEventListener("change", function() {
		video.volume = volumeBar.value;
	});

	fastForward.addEventListener("click", function () {
		if (video.playbackRate != undefined) {
			if (toogle==false){
				// video.currentTime += 5;
				video.playbackRate = 5;
				fastForward.innerHTML = '<i class="fa fa-youtube-play"></i>';
				toogle = true;
			}
			else{
				video.playbackRate = 1;
				fastForward.innerHTML = '<i class="fa fa-forward"></i>';
				toogle=false;
			}
		}});
}
	
}
