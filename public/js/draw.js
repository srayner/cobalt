var curX, curY;
var originX, originY;
var mousePos;
var downPos;
var isMouseDown = false;
var canvas = document.getElementById("myCanvas");
var context = canvas.getContext("2d");

canvas.style.width ='100%';
canvas.style.height="100%";
//canvas.width  = canvas.offsetWidth;
//canvas.height = canvas.offsetHeight;

originX = 100;
originY = 250;

var userImage = new Image();
userImage.onload = function(){
    redraw();
};
userImage.src = "/img/person-male.png";

var computerImage = new Image();
computerImage.onload = function(){
    redraw();
};
computerImage.src = "/img/laptop.png";

var departmentImage = new Image();
departmentImage.onload = function(){
    redraw();
};
departmentImage.src = "/img/group.png";



function getMousePos(event) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: event.clientX - rect.left,
        y: event.clientY - rect.top
    };
}

function drawCoords() {
    context.font = "12px Arial";
    context.textAlign="left";
    context.fillStyle = "#000000";
    if (undefined !== mousePos) {
        context.fillText("X: " + mousePos.x.toString(), canvas.width - 70, 15);
        context.fillText("Y: " + mousePos.y.toString(), canvas.width - 70, 30);
    }
    if (undefined !== downPos) {
        context.fillText("dX: " + downPos.x.toString(), canvas.width - 70, 45);
        context.fillText("dY: " + downPos.y.toString(), canvas.width - 70, 60);
    }
    context.fillText("Mouse: " + isMouseDown.toString(), canvas.width - 70, 75);
}

function drawEntity(x,y,txt,img)
{
    context.font = "14px Arial";
    context.textAlign="center";
    context.fillStyle = "#000000";
    context.fillText(txt,x,y+35);
    context.drawImage(img, x-32, y-32-10);    
}

function drawCross(x,y)
{
    context.strokeStyle = "#0000ff"; // blue
    
    context.beginPath();
    context.moveTo(x-5, y-5);
    context.lineTo(x+5,y+5);
    context.moveTo(x-5, y+5);
    context.lineTo(x+5, y-5);    
    context.stroke();
}

function drawArcRightUp(x,y,r)
{
    context.strokeStyle = "#aaaaaa";
    context.beginPath();
    context.arc(x,y-r,r,0,Math.PI/2);
    context.stroke();
    curX = curX + r;
    curY = curY - r;
}

function drawArcRightDown(x,y,r)
{
    context.strokeStyle = "#aaaaaa";
    context.beginPath();
    context.arc(x,y+r,r,Math.PI*1.5,Math.PI*2);
    context.stroke();
    curX = curX + r;
    curY = curY + r;
}

function drawArcUpRight(x,y,r)
{
    context.strokeStyle = "#aaaaaa";
    context.beginPath();
    context.arc(x+r,y,r,Math.PI,Math.PI*1.5);
    context.stroke();
    curX = curX + r;
    curY = curY - r;
}

function drawArcDownRight(x,y,r)
{
    context.strokeStyle = "#aaaaaa";
    context.beginPath();
    context.arc(x+r,y,r,Math.PI*0.5,Math.PI);
    context.stroke();
    curX = curX + r;
    curY = curY + r;
}

function drawLineRight(x,y,l, txt)
{
    context.strokeStyle = "#aaaaaa";
    context.beginPath();
    context.moveTo(x,y);
    context.lineTo(x+l, y);
    context.stroke();
    
    context.font = "14px Arial";
    context.textAlign="center";
    context.fillStyle = "#aaaaaa";
    context.fillText(txt,x+(l/2),y-6);
    
    curX = curX + l;
}

function drawLineUp(x,y,l)
{
    context.strokeStyle = "#aaaaaa";
    context.beginPath();
    context.moveTo(x,y);
    context.lineTo(x, y-l);
    context.stroke();
    curY = curY - l;
}

function drawLineDown(x,y,l)
{
    context.strokeStyle = "#aaaaaa";
    context.beginPath();
    context.moveTo(x,y);
    context.lineTo(x, y+l);
    context.stroke();
    curY = curY + l;
}

function redraw()
{
    context.clearRect(0, 0, canvas.width, canvas.height);
    //drawCoords();
    
    curX=originX;
    curY=originY;
    drawLineRight(curX,curY,100, "");
    drawEntity(curX - 100,curY,"Steve Bloggs", userImage);
    curX = curX + 100;
    
    curX=originX+100;
    curY=originY;
    drawArcRightUp(curX,curY,20);
    drawLineUp(curX, curY, 60);
    drawArcUpRight(curX,curY,20);
    drawLineRight(curX,curY,200, "Uses");
    drawEntity(curX, curY, "pc-7248", computerImage);
    
    curX=originX+100;
    curY=originY;
    drawLineRight(curX,curY,40, "");
    drawLineRight(curX,curY,200, "Reports to");
    drawEntity(curX,curY,"Bill Fence", userImage);
    
    curX=originX+100;
    curY=originY;
    drawArcRightDown(curX,curY,20);
    drawLineDown(curX, curY, 60);
    drawArcDownRight(curX,curY,20);
    drawLineRight(curX,curY,200, "Works in");
    drawEntity(curX, curY, "Research & Development", departmentImage);
}



canvas.addEventListener('mousedown', function(event) {
    isMouseDown = true;
    downPos = getMousePos(event);
}, false);

canvas.addEventListener('mouseup', function(event) {
    isMouseDown = false;
}, false);

canvas.addEventListener('mousemove', function(event) {
    mousePos = getMousePos(event);
    if (isMouseDown) {
        var dX = mousePos.x - downPos.x;
        var dY = mousePos.y - downPos.y;
        originX = originX + dX;
        originY = originY + dY;
        downPos.x = mousePos.x;
        downPos.y = mousePos.y;
        redraw();
    }
}, false);