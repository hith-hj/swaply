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

window.addEventListener("DOMContentLoaded", (e) => {
    let theme = localStorage.getItem('theme')
    toggleTheme(theme, 'off')
});

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


window.addEventListener("load", menuView);
window.addEventListener("resize", menuView);
let _clicks = 0;

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
    e.preventDefault();
    if (deferredPrompt == 'rejected') {
        appInstall.hidden = true;
        installButton.hidden = true;
    } else {
        deferredPrompt = e;
        appInstall.hidden = false;
        installButton.hidden = false;
        installButton.addEventListener("click", installApp);
    }
});

function installApp() {
    deferredPrompt.prompt();
    installButton.disabled = true;

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
            if (form[i].name == 'submit_btn' || form[i].name == 'item_imgs[]') {
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

        var existinginputs = document.getElementsByName('item_img[]');
        var existingcanvases = document.getElementsByTagName('canvas');
        while (existinginputs.length > 0 && existingcanvases > 0) {
            form.removeChild(existinginputs[0]);
            preview.removeChild(existingcanvases[0]);
        }

        if (files.length > 5) {
            return notify("max 5 images", 'r', 'hold');
        } else {
            for (var i = 0; i < files.length; i++) {
                processfile(files[i]);
            }
            files.value = "";
        }
    }

    function processfile(file) {

        if (!(/image/i).test(file.type)) {
            alert("File " + file.name + " is not an image.");
            return false;
        }

        var reader = new FileReader();
        reader.readAsArrayBuffer(file);

        reader.onload = function(event) {
            var blob = new Blob([event.target.result]);
            window.URL = window.URL || window.webkitURL;
            var blobURL = window.URL.createObjectURL(blob);

            var image = new Image();
            image.src = blobURL;
            image.onload = function() {
                var resized = resizeMe(image);
                var newinput = document.createElement("input");
                newinput.type = 'hidden';
                newinput.name = 'item_img[]';
                newinput.value = resized;
                form.appendChild(newinput);
            }
        };
    }

    function resizeMe(img) {

        var canvas = document.createElement('canvas');

        var width = img.width;
        var height = img.height;

        if (width > height) {
            if (width > max_width) {
                height = Math.round(height *= max_width / width);
                width = max_width;
            }
        } else {
            if (height > max_height) {
                width = Math.round(width *= max_height / height);
                height = max_height;
            }
        }

        canvas.width = width;
        canvas.height = height;
        canvas.classList.add('uploaded-img');
        canvas.style = "max-width:100px;max-height:100px;margin:.2rem;"
        var ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, width, height);
        preview.classList.remove('hidden')
        preview.appendChild(canvas);
        console.log();
        return canvas.toDataURL("image/jpeg", 0.8);

    }
}

function toggleTheme(theme, stat = 'on') {
    if (theme == 'dark') {
        let head = document.querySelector('head')
        if (head.querySelector("#darkThemeStyle") == null) {
            let link = document.createElement('link')
            link.setAttribute('href', 'css/dark.css')
            link.setAttribute('rel', 'stylesheet')
            link.setAttribute('id', 'darkThemeStyle')
            head.appendChild(link)
        }
        if (stat == 'on') {
            notify('تم تفعيل الوضع الليلي', 'b', 'حسنا')
        }
        localStorage.setItem('theme', theme)

    } else if (theme != null && theme == 'light') {
        let head = document.querySelector('head')
        let link = document.querySelector("#darkThemeStyle")
        if (link != null) head.removeChild(link)
        localStorage.setItem('theme', theme)
        if (stat == 'on') {
            notify('تم الغاء الوضع الليلي', 'b', 'حسنا')
        }
    }
    if (theme != null) {
        Livewire.emit('changeTheme', theme)
    }
}

// handel pull refresh btn

if (location.pathname == '/home') {
    let _startY;
    const inbox = document.querySelector('#feedsBody');

    inbox.addEventListener('touchstart', e => {
        _startY = e.touches[0].pageY;
    }, { passive: true });

    inbox.addEventListener('touchmove', e => {
        const y = e.touches[0].pageY;
        if (document.scrollingElement.scrollTop === 0 && y / 2 > _startY &&
            !document.body.classList.contains('refreshing')) {
            Livewire.emit('getFeeds');
            Livewire.emit('refresh');
            Livewire.emit('changeBody', 'feeds');
            console.log('erre');
        }
    }, { passive: true });
}

// end handel bull reffresh ck btn