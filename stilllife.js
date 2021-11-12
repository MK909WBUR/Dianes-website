function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
  var myTopnav = document.getElementById("myTopnav").className;
  var active = document.getElementById("active");
  if (myTopnav == "topnav responsive") {
    document.getElementById("logo").style.display = "none";
    active.className = "none";
  } else {
    document.getElementById("logo").style.display = "initial";
    active.className = "active";
  }
}
