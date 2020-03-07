var swite = document.getElementById("swite");
var img = document.getElementById("img");
var tr = document.getElementById("tr")
swite.onmouseover = function(){
	img.style.display = "block";
	tr.style.display= "block"
}
swite.onmouseout = function(){
	img.style.display = "none";
	tr.style.display = "none"
}
var shopping = document.getElementsByClassName("shopping")[0];
var shopping_shop = document.getElementById("shopping_shop")
shopping.onmouseover = function(){
	shopping_shop.style.display = "block"
}
shopping.onmouseout = function(){
	shopping_shop.style.display = "none"
}

var scroll_img = new Array();
    scroll_img[0] =  "images/d.webp";
    scroll_img[1] = "images/b.webp";
    scroll_img[2] = "images/c.webp";
    scroll_img[3] = "images/a.jpg";
    scroll_img[4] = "images/e.webp";
    var now = 1;
    var time = setInterval("fork()",2000);
    function fork(a){
        if(Number(a)){
            now = a;
        }
        var img = document.getElementById("ping");
        var lis = document.getElementById("pic").getElementsByTagName("li");
        for (var i = 1; i <= scroll_img.length; i++) {
            if(i == now){
                img.src = scroll_img[i-1];
                lis[i-1].style.background="#ff7400";
            }else{
                lis[i-1].style.background="white";
            }
        }
        if(now == scroll_img.length){
            now = 1;
        }else{
            now++;
        }
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[0];
    var zxc = document.getElementsByClassName("banner_list")[0];
    asdli.onmouseover = function(){
        zxc.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[1];
    var zxc1 = document.getElementsByClassName("banner_list1")[0];
    asdli.onmouseover = function(){
        zxc1.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc1.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[2];
    var zxc2 = document.getElementsByClassName("banner_list2")[0];
    asdli.onmouseover = function(){
        zxc2.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc2.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[3];
    var zxc = document.getElementsByClassName("banner_list")[0];
    asdli.onmouseover = function(){
        zxc.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[4];
    var zxc1 = document.getElementsByClassName("banner_list1")[0];
    asdli.onmouseover = function(){
        zxc1.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc1.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[5];
    var zxc2 = document.getElementsByClassName("banner_list2")[0];
    asdli.onmouseover = function(){
        zxc2.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc2.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[6];
    var zxc = document.getElementsByClassName("banner_list")[0];
    asdli.onmouseover = function(){
        zxc.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[7];
    var zxc1 = document.getElementsByClassName("banner_list1")[0];
    asdli.onmouseover = function(){
        zxc1.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc1.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[8];
    var zxc2 = document.getElementsByClassName("banner_list2")[0];
    asdli.onmouseover = function(){
        zxc2.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc2.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[9];
    var zxc2 = document.getElementsByClassName("banner_list2")[0];
    asdli.onmouseover = function(){
        zxc2.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc2.style.display = "none"
    }
    var asdli = document.getElementsByClassName("meau")[0].getElementsByTagName("li")[10];
    var zxc = document.getElementsByClassName("banner_list")[0];
    asdli.onmouseover = function(){
        zxc.style.display = "block"
    }
    asdli.onmouseout = function(){
        zxc.style.display = "none"
    }