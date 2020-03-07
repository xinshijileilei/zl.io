var outer = document.getElementsByClassName("outer")[0];
var box = document.getElementsByClassName("box")[0];
var img = outer.getElementsByTagName("img");
var imgr = img[0].offsetWidth;
var a = null;
var b = null;
function spt(){
    a = setInterval(function(){
        box.scrollLeft++;
        if(box.scrollLeft>=box.clientWidth){
            box.scrollLeft = 0
        }
        if (box.scrollLeft % imgr == 0 ) {
            clear();
            b = setTimeout(spt, 1000)
        }
    },10)
}
spt();
function clear(){
    clearInterval(a)
    clearInterval(b)
}
var oSpan = document.getElementById("a");
  function tow(n) {
    return n >= 0 && n < 10 ? '0' + n : '' + n;
  }
  function getDate() {
    var oDate = new Date();
    var oldTime = oDate.getTime();
    var newDate = new Date('2020/1/1 00:00:00');
    var newTime = newDate.getTime();
    var second = Math.floor((newTime - oldTime) / 1000);
    var day = Math.floor(second / 86400);
    second = second % 86400;
    var hour = Math.floor(second / 3600);
    second %= 3600;
    var minute = Math.floor(second / 60);
    second %= 60;
    var str = tow(day) + '<span class="time">天</span>'
        + tow(hour) + '<span class="time">小时</span>'
        + tow(minute) + '<span class="time">分钟</span>'
        + tow(second) + '<span class="time">秒</span>';
    oSpan.innerHTML = str;
  }
  getDate();
  setInterval(getDate, 1000)
  var iphone_name_right = document.getElementsByClassName("iphone_name_right")[0];
  var tou = document.getElementsByClassName("tou")[0];
  var jian = document.getElementsByClassName("jian")[0];
  iphone_name_right.onmouseover = function(){
    iphone_name_right.style.color = "#ff7400";
    tou.style.background = "#ff7400";
    jian.style.background = "#ff7400"
  }
  iphone_name_right.onmouseout = function(){
    iphone_name_right.style.color = "#333333";
    tou.style.background = "#ccc";
    jian.style.background = "#ccc"
  }