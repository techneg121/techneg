const first = document.querySelector(".first");
const iframe = document.querySelector("iframe");
const btn = document.querySelector("button");

btn.addEventListener("click", () => {
  var html = first.textContent;
  iframe.src = "data:text/html;charset=utf-8," + encodeURI(html);
});


first.addEventListener('keyup',()=>{
  var html = first.textContent;
  iframe.src = "data:text/html;charset=utf-8," + encodeURI(html);
})

first.addEventListener("paste", function(e) {
        e.preventDefault();
        var text = e.clipboardData.getData("text/plain");
        document.execCommand("insertText", false, text);
    });
  
  
  
function mobileView(){
    document.getElementById("code").style.width = "320px";
   
};

function mobileViewTwo(){
    document.getElementById("code").style.width = "375px";
};

function desktopView(){
    document.getElementById("code").style.width = "100%";
};

function getIframeContent(){
document.getElementById('code').select();
document.execCommand('copy');
};

document.getElementById("html").placeholder = "HTML";
document.getElementById("css").placeholder = "CSS";
document.getElementById("js").placeholder = "JavaScript";
  
function refreshIframe(){
document.getElementById('code').contentDocument.location.reload(true);
};
