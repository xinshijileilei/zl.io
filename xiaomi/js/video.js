function changeBg(index){
    var v_t_btn = document.getElementsByClassName("video_btn");
    v_t_btn[index].style.backgroundColor = "#FB6800";
    v_t_btn[index].style.borderColor = "#FB6800";
}
function change(index){
    var v_t_btn = document.getElementsByClassName("video_btn");
    v_t_btn[index].style.backgroundColor = "";
    v_t_btn[index].style.borderColor = "";
}
var video = document.getElementsByClassName("videos");
		var video_bg = document.getElementsByClassName("video_bg");
		for (var i = 0; i < video.length; i++) {
			video[i].onclick = function(){
				for (var j = 0; j < video_bg.length; j++) {
					if (this == video[j]) {
						video_bg[j].style.visibility = "visible";
					}
				}
			}
		}

		var close = document.getElementsByClassName("title_r");
		for (var i = 0; i < close.length; i++) {
			close[i].onclick = function(){
				for (var j = 0; j < video_bg.length; j++) {
					if (this == close[j]) {
						video_bg[j].style.visibility = "hidden";
					}
				}
			}
		}