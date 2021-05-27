// sessionStorage.setItem('logAte', 0);
if ("serviceWorker" in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker
            .register('../sw.js')
            .then(serviceWorker => {
                console.log("SW registered", serviceWorker.scope);
            })
            .catch(error => {
                console.error("Error registering the Service Worker: ", error);
            });
    })
} else {
    console.log('wtf');
}

if (location.pathname == '/login') {
    let atemps = parseInt(localStorage.getItem('logAte'));
    window.addEventListener('load', (e) => {
        if (localStorage.getItem('user') != null && localStorage.getItem('pass') != null) {
            if (atemps < 2) {
                try {
                    document.querySelector("#remember_me").checked = true;
                    document.querySelector("#name").value = localStorage.getItem('user');
                    document.querySelector("#password").value = localStorage.getItem('pass');
                    document.querySelector("#loginBtn").click();
                } catch (error) {
                    console.log(error);
                }
                atemps = atemps + 1;
                localStorage.setItem('logAte', atemps);
            } else {
                localStorage.setItem('logAte', 0);
                alert('هناك مشكلة في تسجيل دخولك تحقق من صحة المعلومات و حاول لاحقا ,من الممكن ان يكون المخدم خارج عن الخدمة')
            }
        }
    })
}

// Livewire

Livewire.on('notifi', (e) => {
    notify(e[0], e[1], e[2]);
});

Livewire.on('copyUrl', (e) => {
    copyLink(e[0]);
});

Livewire.on('resizer', (e) => {
    menuView()
})

// livewire End

// listener

window.addEventListener('touchmove', (e) => {
    // console.log(e.target.classList);
    if (e.target.classList.contains('bi')) {
        e.target.classList.add('ani', 'ani_pulse')
    }
})

window.addEventListener('touchend', (e) => {
    // console.log(e.target.classList);
    if (e.target.classList.contains('bi') && e.target.classList.contains('ani')) {
        e.target.classList.remove('ani', 'ani_pulse')
    }
})



document.querySelector(".fullPage").addEventListener('click', (e) => {
    let sub = document.querySelector("#dataForm")
    if (sub.classList.contains('show') === true) {
        sub.parentNode.childNodes[1].classList.remove('show');
        sub.classList.remove('show')
        resetForm()
    }
    let nav = document.querySelector("#navMenu")
    if (nav.classList.contains("cir-perant") && nav.firstElementChild.classList.contains("hidden") === false) {
        nav.firstElementChild.classList.add("hidden")
        let icon = document.querySelector("#cir-icon")
        icon.classList.remove("rotate")
    }
})

window.addEventListener('hide.bs.dropdown', function(e) {
    // e.preventDefault() || e.target.parentNode.classList.contains('d-inline')
    if (e.target.parentNode.classList.contains('dataForm')) {
        e.preventDefault();
    }
})

// setInterval(() => { Livewire.emitTo('menu', 'refresh') }, 120 * 1000)

window.addEventListener("load", menuView);
window.addEventListener("resize", menuView);
let _clicks = 0;
window.addEventListener("touchstart", (e) => {
    _clicks++;
    if (_clicks == 50) {
        Livewire.emit('getFeeds')
        Livewire.emit('refresh')
        _clicks = 0
    }
});

window.addEventListener("click", (e) => {
    _clicks++;
    if (_clicks == 50) {
        Livewire.emit('getFeeds')
        Livewire.emit('refresh')
        _clicks = 0
    }
});

//end listener 

// PWA installment 

let deferredPrompt; // Allows to show the install prompt
const appInstall = document.getElementById("app_install");
const installButton = document.getElementById("install_btn");

window.addEventListener("beforeinstallprompt", e => {
    console.log("beforeinstallprompt fired");
    // Prevent Chrome 76 and earlier from automatically showing a prompt
    e.preventDefault();
    // Stash the event so it can be triggered later.
    if (deferredPrompt == 'rejected') {
        appInstall.hidden = true;
        installButton.hidden = true;
    } else {
        deferredPrompt = e;
        appInstall.hidden = false;
        installButton.hidden = false;
        installButton.addEventListener("click", installApp);
    }
    // Show the install button
});

function installApp() {
    // Show the prompt
    deferredPrompt.prompt();
    installButton.disabled = true;

    // Wait for the user to respond to the prompt
    deferredPrompt.userChoice.then(choiceResult => {
        if (choiceResult.outcome === "accepted") {
            console.log("PWA setup accepted");
            installButton.hidden = true;
        } else {
            console.log("PWA setup rejected");
            deferredPrompt = 'rejected';
            notify('ليش ما نزلت التطبيق ؟', 'r', 'اللللللله')
        }
    });
}

window.addEventListener("appinstalled", evt => {
    console.log("appinstalled fired", evt);
});

// END PWA installment 

// handel pull refresh btn

let _startY;
const inbox = document.querySelector('#feedsBody');

inbox.addEventListener('touchstart', e => {
    _startY = e.touches[0].pageY;
}, { passive: true });

inbox.addEventListener('touchmove', e => {
    const y = e.touches[0].pageY;
    // Activate custom pull-to-refresh effects when at the top of the container
    // and user is scrolling up.
    if (document.scrollingElement.scrollTop === 0 && y > _startY &&
        !document.body.classList.contains('refreshing')) {
        Livewire.emit('getFeeds');
        Livewire.emit('refresh');
        Livewire.emit('changeBody', 'feeds');
        console.log('erre');
    }
}, { passive: true });

// end handel bull reffresh ck btn

function notify(msg, status, head) {
    let notifi = document.querySelector("#notification");
    let id = Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
    if (notifi.classList.contains("hidden")) {
        notifi.classList.remove("hidden")
    }
    let div = document.createElement("div");
    let header = document.createElement("div");
    let body = document.createElement("div");
    let span = document.createElement("span");
    let i = document.createElement("i");
    i.classList.add('bi', 'bi-x', 'noti-close');
    i.setAttribute("onclick", 'removeNoti("' + id + '")')
    span.textContent = head;
    header.classList.add('noti-header', 'noti-h' + status);
    header.appendChild(span);
    header.appendChild(i);
    body.textContent = msg;
    div.classList.add('noti', 'noti-bo' + status, 'my-1', 'ani', 'ani_slideInLeft');
    div.setAttribute("id", "n" + id)
    div.appendChild(header);
    div.appendChild(body);
    notifi.classList.add('ani', 'ani_slideInLeft');
    notifi.appendChild(div);
    setTimeout(() => {
        removeNoti(id)
    }, 10000)
}

function removeNoti(id) {
    let notifi = document.querySelector("#notification");
    let div = notifi.querySelector("#n" + id);
    if (div != null) notifi.removeChild(div)
    if (notifi.children.length == 0) {
        notifi.classList.add("hidden")
    }
}

if (window.location.pathname != "") {

    let icon = document.querySelector("#cir-icon");
    var supportsPassive = false;
    // console.log(icon);
    try {
        var opts = Object.defineProperty({}, 'passive', {
            get: function() {
                supportsPassive = true;
            }
        });
        window.addEventListener("testPassive", null, opts);
        window.removeEventListener("testPassive", null, opts);
    } catch (e) {}
    if (/Mobi/.test(navigator.userAgent)) {
        icon.addEventListener("touchstart", toggleCirMenu, supportsPassive ? { passive: true } : false)
    } else {
        icon.addEventListener("click", toggleCirMenu, supportsPassive ? { passive: true } : false)
    }

    function toggleCirMenu() {
        document.querySelector("#navList").classList.toggle("hidden");
        icon.classList.toggle("rotate");
    }

}

function menuView() {
    var x = window.innerWidth || window.screenX

    let menu = document.querySelector("#navMenu");
    let list = document.querySelector("#navList");
    if (x < 720) {
        menu.classList.remove('ver-menu');
        menu.classList.add('cir-perant');
        list.classList.remove('ver-list');
        list.classList.add('cir-list', 'hidden');
    } else {
        menu.classList.add('ver-menu');
        menu.classList.remove('cir-perant');
        list.classList.add('ver-list');
        list.classList.remove('cir-list', 'hidden');
    }
}

function displayUploadedImages(ev) {
    let gal = document.querySelector("#imgs_collection");
    var itag = document.createElement('i');
    gal.removeAttribute('hidden');
    gal.classList.remove("hidden");
    if (gal.hasChildNodes) {
        while (gal.lastChild) {
            gal.removeChild(gal.lastChild);
        }
    };
    let files = ev.target.files;
    var count = files.length;
    if (count > 5) {
        files = [];
        notify("max 5 images", 'r', 'hold');
    } else {
        for (let i = 0; i < files.length; i++) {
            var div = document.createElement('div');
            var img = document.createElement('img');
            div.classList.add('d-inline-block', 'text-center', );
            img.setAttribute('src', window.URL.createObjectURL(files[i]));
            img.setAttribute('class', 'uploaded-img animation-fade mx-1');
            img.setAttribute('width', '85');
            img.setAttribute('height', '85');
            img.setAttribute('id', 'img_' + files[i].size);
            img.setAttribute('name', i);
            div.appendChild(img);
            gal.appendChild(div);
        }
        itag.setAttribute('class', 'bi bi-arrow-clockwise');
        itag.setAttribute('onclick', 'clearFilesInput()');
        gal.appendChild(itag);
        gal.classList.add('mb-1', 'border-dashed', 'rounded', 'p-1');
    }
}

function clearFilesInput() {
    let imgs = document.querySelector("input[name='item_imgs[]']")
    imgs.value = null;
    imgs.files = null;
    // console.log(imgs, imgs.files);
    let gal = document.querySelector("#imgs_collection");
    if (gal.hasChildNodes) {
        while (gal.lastChild) {
            gal.removeChild(gal.lastChild);
        }
    } else {
        gal.classList.add('hidden')
    };
}

function removeImageFromUploaded(id) {
    var del = document.querySelector('#img_' + id);
    var rem = document.querySelector('#rem_' + id);
    let par = document.querySelector("#imgs_collection");

    del.parentNode.removeChild(del);
    rem.parentNode.removeChild(rem);
    if (par.children.length <= 1) {
        par.classList.add('hidden');
    }
}

{
    let sbtn = document.getElementById("submit-form");
    let spiner = document.getElementById("formLoading");

    function AddItem(event) {
        event.preventDefault();
        sbtn.disabled = true;
        spiner.classList.toggle('hidden');

        let form = document.getElementById('add-item-form');
        let data = getData(form);
        if (data == 'isEmpty') {
            return notify('الرجاء ملئ الحقول المطلوبة ', 'danger');
        }
        let url = "/addItem";
        let method = 'POST';

        sendData(url, method, data);

    }

    function getData(form) {
        let data = new FormData();
        for (let i = 0; i < form.length; i++) {
            // if (form[i].value == '') {
            //     return data = 'isEmpty'
            // }
            if (form[i].name == 'submit_btn') {
                continue;
            }
            if (form[i].name == 'item_imgs[]') {
                // for (var j = 0; j < form[i].files.length; j++) {
                //     data.append(form[i].name, form[i].files[j])
                // }
                continue;
            }
            data.append(form[i].name, form[i].value);
        }
        return data;
    }

    function sendData(url, method, data) {
        let token = document.querySelector('meta[name="csrf-token"]');
        fetch(url, {
            method: method,
            body: data
        }).then(res => res.json()).then((res) => {
            resetForm();
            if (res.status == 200 || res.statusText == "OK") {
                Livewire.emit('changeBody', 'feeds');
                Livewire.emitTo('feeds', 'getFeeds');
                sbtn.disabled = false;
                spiner.classList.add('hidden');
                return notify("تم اضافة غرضك, تحقق من صفحة التطابقات", 'g', 'حسنا');
            } else {
                notify(res.msg, 'r', ' حدث خطا ما');
                sbtn.disabled = false;
                spiner.classList.add('hidden');
            }
        }).catch((err) => {
            console.log(err);
            sbtn.disabled = false;
            spiner.classList.add('hidden');
            return notify("حدث خطا ما . حاول لاحقا", 'r', 'للاسف');
        });

    }

}

function resetForm() {
    document.querySelector("#add-item-form").reset();
    // resetItemLocation();
    let gal = document.querySelector("#imgs_collection");
    if (gal.hasChildNodes) {
        while (gal.lastChild) {
            gal.removeChild(gal.lastChild);
        }
    };
    gal.classList.add("hidden")
}

function copyLink(id) {
    let rand = Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
    var urlInput = document.createElement('input');
    // var url = location.host + '/item/show/&' + id + '/&' + type;
    var url = location.host + '/item/show/&' + id + '&/HtybVertnXAsdR';
    document.body.appendChild(urlInput);
    urlInput.value = url;
    urlInput.select();
    var success = document.execCommand('copy');
    document.body.removeChild(urlInput);
    notify('تم نسخ الرابط', 'b', 'حسنا');
}

function setItemLocation(loca) {
    let setBtn = document.querySelector('#setLocation');
    let resetBtn = document.querySelector('#resetLocation');
    let group = document.querySelector("#location-group");
    // let bio = document.querySelector("#addLocationBio");


    // bio.classList.remove('hidden');
    setBtn.classList.add('hidden');
    resetBtn.classList.remove('hidden');
    group.classList.remove("hidden");
    for (el of group.children) {
        el.setAttribute('disabled', 'false');
        el.disabled = false;
    }
}

function resetItemLocation() {
    let setBtn = document.querySelector('#setLocation');
    let resetBtn = document.querySelector('#resetLocation');
    let group = document.querySelector("#location-group")
        // let bio = document.querySelector("#addLocationBio");


    // bio.classList.add('hidden');
    setBtn.classList.remove('hidden')
    resetBtn.classList.add('hidden')
    group.classList.add("hidden")
    for (el of group.children) {
        el.setAttribute('disabled', 'true')
        el.value = null
    }
}

function rememberMe() {
    let user = document.querySelector("#name").value;
    let pass = document.querySelector("#password").value;

    localStorage.setItem('user', user)
    localStorage.setItem('pass', pass)
}

{
    // var max_width = fileinput.getAttribute('data-maxwidth');
    // var max_height = fileinput.getAttribute('data-maxheight');
    var max_width = 1200;
    var max_height = 800;
    var preview = document.querySelector("#imgs_collection");
    var form = document.getElementById('add-item-form');

    function image_resizer(e) {
        if (!(window.File && window.FileReader && window.FileList && window.Blob)) {
            alert('The File APIs are not fully supported in this browser.');
            return false;
        }

        readfiles(e.target.files);
    }

    function readfiles(files) {

        // remove the existing canvases and hidden inputs if user re-selects new pics
        var existinginputs = document.getElementsByName('item_img[]');
        var existingcanvases = document.getElementsByTagName('canvas');
        while (existinginputs.length > 0 && existingcanvases > 0) { // it's a live list so removing the first element each time
            // DOMNode.prototype.remove = function() {this.parentNode.removeChild(this);}
            form.removeChild(existinginputs[0]);
            preview.removeChild(existingcanvases[0]);
        }

        if (files.length > 5) {
            return notify("max 5 images", 'r', 'hold');
        } else {
            for (var i = 0; i < files.length; i++) {
                processfile(files[i]); // process each file at once
            }
            files.value = "";
        } //remove the original files from fileinput
        // TODO remove the previous hidden inputs if user selects other files
    }

    function processfile(file) {

        if (!(/image/i).test(file.type)) {
            alert("File " + file.name + " is not an image.");
            return false;
        }

        // read the files
        var reader = new FileReader();
        reader.readAsArrayBuffer(file);

        reader.onload = function(event) {
            // blob stuff
            var blob = new Blob([event.target.result]); // create blob...
            window.URL = window.URL || window.webkitURL;
            var blobURL = window.URL.createObjectURL(blob); // and get it's URL

            // helper Image object
            var image = new Image();
            image.src = blobURL;
            //preview.appendChild(image); // preview commented out, I am using the canvas instead
            image.onload = function() {
                // have to wait till it's loaded
                var resized = resizeMe(image); // send it to canvas
                var newinput = document.createElement("input");
                newinput.type = 'hidden';
                newinput.name = 'item_img[]';
                newinput.value = resized; // put result from canvas into new hidden input
                form.appendChild(newinput);
            }
        };
    }

    // === RESIZE ====

    function resizeMe(img) {

        var canvas = document.createElement('canvas');

        var width = img.width;
        var height = img.height;

        // calculate the width and height, constraining the proportions
        if (width > height) {
            if (width > max_width) {
                //height *= max_width / width;
                height = Math.round(height *= max_width / width);
                width = max_width;
            }
        } else {
            if (height > max_height) {
                //width *= max_height / height;
                width = Math.round(width *= max_height / height);
                height = max_height;
            }
        }

        // resize the canvas and draw the image data into it
        canvas.width = width;
        canvas.height = height;
        canvas.classList.add('uploaded-img');
        canvas.style = "max-width:100px;max-height:100px;margin:.2rem;"
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, width, height);
        preview.classList.remove('hidden')
        preview.appendChild(canvas); // do the actual resized preview
        console.log();
        return canvas.toDataURL("image/jpeg", 0.8); // get the data from canvas as 70% JPG (can be also PNG, etc.)

    }
}