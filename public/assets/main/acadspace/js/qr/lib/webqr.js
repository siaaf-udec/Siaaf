var gCtx = null;
var gCanvas = null;
var c = 0;
var stype = 0;
var gUM = false;
var webkit = false;
var moz = false;
var v = null;
var canvasblade = '';
var videoblade = '';
var canvasgblade = '';

var dimensions = {
    height: 0,
    width: 0,
    start: 0,
    end: 0
}

var elements = {
    video: null,
    canvas: null,
    ctx: null,
    canvasg: null,
    ctxg: null
}

var config = {
    strokeColor: '#0cf404',
    start: 0.1,
    end: 0.9,
    
    threshold: 160,
    quality: 0.45,
    delay: 100

}

var imghtml = '<div id="qrfile"><canvas id="out-canvas" width="320" height="240"></canvas>' +
    '<div id="imghelp">drag and drop a QRCode here' +
    '<br>or select a file' +
    '<input type="file" onchange="handleFiles(this.files)"/>' +
    '</div>' +
    '</div>';

var vidhtml =  '<video id="v" autoplay></video><canvas id="barcodecanvasg"></canvas>';

function dragenter(e) {
    e.stopPropagation();
    e.preventDefault();
}

function dragover(e) {
    e.stopPropagation();
    e.preventDefault();
}

function drop(e) {
    e.stopPropagation();
    e.preventDefault();

    var dt = e.dataTransfer;
    var files = dt.files;
    if (files.length > 0) {
        handleFiles(files);
    } else
    if (dt.getData('URL')) {
        qrcode.decode(dt.getData('URL'));
    }
}

function handleFiles(f) {
    var o = [];

    for (var i = 0; i < f.length; i++) {
        var reader = new FileReader();
        reader.onload = (function (theFile) {
            return function (e) {
                gCtx.clearRect(0, 0, gCanvas.width, gCanvas.height);

                qrcode.decode(e.target.result);
            };
        })(f[i]);
        reader.readAsDataURL(f[i]);
    }
}


function initCanvas(w, h) {
    gCanvas = document.getElementById("qr-canvas");
    gCanvas.style.width = w + "px";
    gCanvas.style.height = h + "px";
    gCanvas.width = w;
    gCanvas.height = h;
    gCtx = gCanvas.getContext("2d");
    gCtx.clearRect(0, 0, w, h);
}

function captureToCanvas() {
    if (stype != 1)
        return;
    if (gUM) {
        try {
            gCtx.drawImage(v, 0, 0);
            try {
                qrcode.decode();
            } catch (e) {
                console.log(e);
                setTimeout(captureToCanvas, 20);
            };
        } catch (e) {
            console.log(e);
            setTimeout(captureToCanvas, 20);
        };
    }
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function read(a) {
    // var html="<br>";
    // // if(a.indexOf("http://") === 0 || a.indexOf("https://") === 0)
    // //     html+="<a target='_blank' href='"+a+"'>"+a+"</a><br>";
    // html+="<b>"+htmlEntities(a)+"</b><br><br>";
    var string = a,
        arr = string.split('|'),
        i;

    for (i in arr) {

        document.getElementById("mapo").innerHTML = "<b><u>Titulo:</u> " + arr[0] + "</b>";
        document.getElementById("mact").innerHTML = "<b><u>Contenido:</u> " + arr[1] + "</b>";
        document.getElementById("soluong").innerHTML = "<b><u>Pie:</u> " + arr[2] + "</b>";
        load();
        document.getElementById("mapo").innerHTML = "<b><u>Titulo:</u> " + arr[0] + "</b>";
        document.getElementById("mact").innerHTML = "<b><u>Contenido:</u> " + arr[1] + "</b>";
        document.getElementById("soluong").innerHTML = "<b><u>Pie:</u> " + arr[2] + "</b>";
    }
    var audio = new Audio('lib/beep.ogg');
    audio.play();


}

function isCanvasSupported() {
    var elem = document.createElement('canvas');
    return !!(elem.getContext && elem.getContext('2d'));
}
function success(stream) {

    v.srcObject = stream;
    v.play();

    gUM = true;
    setTimeout(captureToCanvas, 20);
}

function error(error) {
    gUM = false;
    return;
}

function load() {
    if (isCanvasSupported() && window.File && window.FileReader) {
        initCanvas(800, 600);
        qrcode.callback = read;
        document.getElementById("mainbody").style.display = "inline";
        setwebcam();
    } else {
        document.getElementById("mainbody").style.display = "inline";
        document.getElementById("mainbody").innerHTML = '<p id="mp1">QR code scanner for HTML5 capable browsers</p><br>' +
            '<br><p id="mp2">sorry your browser is not supported</p><br><br>' +
            '<p id="mp1">try <a href="http://www.mozilla.com/firefox"><img src="firefox.png"/></a> or <a href="http://chrome.google.com"><img src="chrome_logo.gif"/></a> or <a href="http://www.opera.com"><img src="Opera-logo.png"/></a></p>';
    }
}

function setwebcam() {

    var options = true;
    if (navigator.mediaDevices && navigator.mediaDevices.enumerateDevices) {
        try {
            navigator.mediaDevices.enumerateDevices()
                .then(function (devices) {
                    devices.forEach(function (device) {
                        if (device.kind === 'videoinput') {
                            if (device.label.toLowerCase().search("back") > -1)
                                options = {
                                    'deviceId': {
                                        'exact': device.deviceId
                                    },
                                    'facingMode': 'environment'
                                };
                        }
                        console.log(device.kind + ": " + device.label + " id = " + device.deviceId);
                    });
                    setwebcam2(options);
                });
        } catch (e) {
            console.log(e);
        }
    } else {
        console.log("no navigator.mediaDevices.enumerateDevices");
        setwebcam2(options);
    }

}

function setwebcam2(options) {
    console.log(options);
    //document.getElementById("result").innerHTML="- scanning -";
    if (stype == 1) {
        setTimeout(captureToCanvas, 20);
        return;
    }
    var n = navigator;
    document.getElementById("outdiv").innerHTML = vidhtml;
    v = document.getElementById("v");


    if (n.mediaDevices.getUserMedia) {
        n.mediaDevices.getUserMedia({
            video: options,
            audio: false
        }).
        then(function (stream) {
            success(stream);
        }).catch(function (error) {
            error(error)
        });
    } else
    if (n.getUserMedia) {
        webkit = true;
        n.getUserMedia({
            video: options,
            audio: false
        }, success, error);
    } else
    if (n.webkitGetUserMedia) {
        webkit = true;
        n.webkitGetUserMedia({
            video: options,
            audio: false
        }, success, error);
    }

    //PINTAR LINEAS
    elements.video = document.querySelector(videoblade);
    elements.canvas = document.querySelector(canvasblade);
    elements.ctx = elements.canvas.getContext('2d');
    elements.canvasg =  document.querySelector(canvasgblade);
    elements.ctxg = elements.canvasg.getContext('2d');
    elements.video.addEventListener('canplay', function (e) {

        console.log("ENTROOO AL PINTAR");

        dimensions.height = elements.video.videoHeight;
        console.log("HEIGHT : "+dimensions.height);
        dimensions.width = elements.video.videoWidth;
        console.log("WIDTH : "+dimensions.width);

        dimensions.start = dimensions.width * config.start;
        dimensions.end = dimensions.width * config.end;

        elements.canvas.width = dimensions.width;
        elements.canvas.height = dimensions.height;
        elements.canvasg.width = dimensions.width;
        elements.canvasg.height = dimensions.height;

        drawGraphics();
        drawGraphics2();
        drawGraphics3();
        drawGraphics4();
        // setInterval(function(){snapshot()}, config.delay);

    }, false);

    stype = 1;
    setTimeout(captureToCanvas, 20);
}

function drawGraphics() {
    elements.ctxg.strokeStyle = config.strokeColor;
    elements.ctxg.lineWidth = 6;
    elements.ctxg.beginPath();
    elements.ctxg.moveTo(dimensions.start+34, 60);
    elements.ctxg.lineTo(dimensions.end-28, 60);
    elements.ctxg.stroke();
    
}
function drawGraphics2() {
    elements.ctxg.strokeStyle = config.strokeColor;
    elements.ctxg.lineWidth = 6;
    elements.ctxg.beginPath();
    elements.ctxg.moveTo(dimensions.start+34, 420);
    elements.ctxg.lineTo(100, 60);
    elements.ctxg.stroke();

}
function drawGraphics3() {
    elements.ctxg.strokeStyle = config.strokeColor;
    elements.ctxg.lineWidth = 6;
    elements.ctxg.beginPath();
    elements.ctxg.moveTo(dimensions.end-30, 420);
    elements.ctxg.lineTo(dimensions.end-30, 60);
    elements.ctxg.stroke();

}
function drawGraphics4() {
    elements.ctxg.strokeStyle = config.strokeColor;
    elements.ctxg.lineWidth = 6;
    elements.ctxg.beginPath();
    elements.ctxg.moveTo(dimensions.end-30, 420);
    elements.ctxg.lineTo(dimensions.start+34, 420);
    elements.ctxg.stroke();

}