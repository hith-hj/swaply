window.addEventListener('offline', network_offline);
window.addEventListener('online', network_online);

function network_offline() {
    let net = document.querySelector("#network_connection");
    net.classList.remove('network_green');
    net.classList.remove('hidden');
    net.classList.add('network_red');
    net.innerHTML = '  No Internet Connection  <i class="bi bi-wifi-off" style="color:white !important" ></i>';
}

function network_online() {
    let net = document.querySelector("#network_connection");
    net.classList.remove('network_red');
    net.classList.add('network_green');
    net.innerHTML = '  Back Online  <i class="bi bi-wifi" style="color:white !important" ></i>';
    setTimeout(() => {
        net.classList.add('hidden');
    }, 1500);
}
window.onload = () => {
    if (navigator.onLine == false) {
        network_offline();
    }
}

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
            appInstall.hidden = true;
            installButton.hidden = true;
        } else {
            deferredPrompt = 'rejected';
            notify('ليش ما نزلت التطبيق ؟', 'r', 'اللللللله')
        }
    });
}

window.addEventListener("appinstalled", evt => {
    let url = `/increaseDownloads`
    let token = document.querySelector("meta[name=csrf-token]").content
    fetch(url, {
        method: 'POST',
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-Token": token
        },
        credentials: "same-origin",
    }).then(res => res.json()).then((res) => {
        if (res.status == 200 || res.statusText == "OK") {
            console.log('downloads increased');
        } else {
            console.log('something not right');
        }
    }).catch((err) => {
        console.log(err);
        console.log("حدث خطا ما");
    });
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
    i.classList.add('bi', 'bi-x', 'noti-close', 'fs-2');
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
    }, 7500)
}

function removeNoti(id) {
    let notifi = document.querySelector("#notification");
    let div = notifi.querySelector("#n" + id);
    if (div != null) notifi.removeChild(div)
    if (notifi.children.length == 0) {
        notifi.classList.add("hidden")
    }
}

function toggleCirMenu() {
    document.querySelector("#navList").classList.toggle('hidden');
}

function menuView() {
    var x = window.innerWidth || window.screenX
    let menu = document.querySelector("#navMenu");
    let list = document.querySelector("#navList");
    if (menu != null && list != null) {
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
}

{
    let sbtn;
    let spiner;
    let url;
    let form;

    function AddNew(event, type) {
        event.preventDefault();
        if (type == 'item') {
            sbtn = document.getElementById("submit-form");
            spiner = document.getElementById("formLoading");
            form = document.getElementById('add-item-form');
            url = "/addNew/item";
        } else if (type == 'pekia') {
            sbtn = document.getElementById("submit-pekia-form");
            spiner = document.getElementById("pekiaFormLoading");
            form = document.getElementById('add-pekia-form');
            // url = "/addPekia";
            url = "/addNew/pekia";
        } else {
            return;
        }

        sbtn.disabled = true;
        spiner.classList.toggle('hidden');

        let data = getData(form);
        if (data == 'isEmpty') {
            sbtn.disabled = false;
            spiner.classList.toggle('hidden');
            return notify('الرجاء ملئ الحقول المطلوبة ', 'r', 'خطأ');
        }
        let method = 'POST';

        sendData(url, method, data);
    }

    function getData(form) {
        let data = new FormData();
        for (let i = 0; i < form.length; i++) {
            if (form[i].name == 'user_exact_location') {
                if (form[i].value == 'null' || form[i].value == '') {
                    notify('قم بأضافة الموقع', 'r', 'خطا');
                    return data = 'isEmpty';
                }
            }
            if ((form[i].name == 'item_imgs[]' && form[i].value == '') || (form[i].name == 'pekia_imgs[]' && form[i].value == '')) {
                notify('قم بأضافة الصور', 'r', 'خطا');
                return data = 'isEmpty';
            }
            if (form[i].name == 'submit_btn' || form[i].name == 'item_imgs[]' || form[i].name == 'pekia_imgs[]' || form[i].name == 'pekia_submit_btn') {
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
            resetPekiaForm();
            if (res.status == 'done') {
                if (res.msg == 'pekia') {
                    Livewire.emitTo('feeds', 'getFeeds');
                    Livewire.emit('changeBody', 'pekias');
                    notify("تم ارسال طلب سوابيكيا", 'g', 'حسنا');
                } else if (res.msg == 'item') {
                    Livewire.emit('changeBody', 'items');
                    Livewire.emitTo('feeds', 'getFeeds');
                    notify("تم اضافة غرضك بنجاح", 'g', 'حسنا');
                }
            } else {
                notify(res.msg, 'r', 'خطأ');
            }
            sbtn.disabled = false;
            spiner.classList.add('hidden');
        }).catch((err) => {
            console.log(err);
            sbtn.disabled = false;
            spiner.classList.add('hidden');
            notify(err.msg, 'r', 'حدث خطا ما');
        });
    }
}

function resetForm() {
    document.querySelector("#add-item-form").reset();
    let percent = document.querySelector("#percent");
    if (percent != null) {
        let parent = percent.parentNode;
        parent.removeChild(percent);
    }
    // resetItemLocation();
    let gal = document.querySelector("#imgs_collection");
    if (gal.hasChildNodes) {
        while (gal.lastChild) {
            gal.removeChild(gal.lastChild);
        }
    };
    gal.classList.add("hidden")
}

function resetPekiaForm() {
    let pekiaForm = document.querySelector("#add-pekia-form");
    pekiaForm.reset();
    let map = pekiaForm.querySelector("#mapholder")
    if (map.hasChildNodes) {
        if (map.lastChild != null) {
            map.removeChild(map.lastChild)
        }
    }
    let gal = document.querySelector("#pekia_collection");
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
    var preview;
    var form;
    let formType = 'item';

    function image_resizer(e, type) {
        if (!(window.File && window.FileReader && window.FileList && window.Blob)) {
            alert('The File APIs are not fully supported in this browser.');
            return false;
        }
        formType = type;
        readfiles(e.target.files);
    }

    function readfiles(files) {

        if (formType == 'item') {
            preview = document.querySelector("#imgs_collection");
            form = document.getElementById('add-item-form');
            var existinginputs = document.getElementsByName('item_img[]');
        } else {
            preview = document.querySelector("#pekia_collection");
            form = document.getElementById('add-pekia-form');
            var existinginputs = document.getElementsByName('pekia_img[]');
        }


        var existingcanvases = document.getElementsByTagName('canvas');

        while (existinginputs.length > 0 && existingcanvases.length > 0) {
            form.removeChild(existinginputs[0]);
            preview.removeChild(existingcanvases[0]);
        }

        if (files.length > 5) {
            return notify("upload 5 images only", 'r', 'Error');
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
                newinput.value = resized;
                if (formType == 'item') {
                    newinput.name = 'item_img[]';
                } else {
                    newinput.name = 'pekia_img[]';
                }
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

function rateFeed(event, id) {
    let star = event.target.id;
    let val = star.split("_")
    for (let i = 1; i <= 5; i++) {
        document.querySelector("#star_" + i + "_" + id).classList.remove('bi-star-fill');
        document.querySelector("#star_" + i + "_" + id).classList.add('bi-star');
    }

    if (val[1] > 0) {
        for (let i = 1; i <= val[1]; i++) {
            document.querySelector("#star_" + i + "_" + id).classList.remove('bi-star');
            document.querySelector("#star_" + i + "_" + id).classList.add('bi-star-fill');
        }
    }
}

function sharePost(id, text) {
    if (navigator.share) {
        navigator.share({
            title: 'انضم لسوابلي | خلي الكل يستفيد',
            // text: text,
            url: '/item/show/&' + id + '&/HtybVertnXAsdR',
        }).then(() => {
            console.log('Thanks for sharing!');
        }).catch(console.error);
    } else {
        document.querySelector(`#share${id}`).classList.toggle('hidden');
    }
}

{
    let geoInfo;

    function getLocation() {
        geoInfo = document.querySelector("#geoInfo");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                showPosition,
                showError,
                // Options. See MDN for details.
                {
                    enableHighAccuracy: true,
                    timeout: 5000,
                    maximumAge: 0
                });
        } else {
            geoInfo.textContent = "معلومات الموقع غير متاحة على هذا المتصفح";
        }
    }

    function showPosition(position) {
        geoInfo.textContent = "تم الحصول على الموقع";
        let input = document.querySelector("#user_exact_location");
        input.value = [position.coords.longitude, position.coords.latitude];

        var latlon = position.coords.longitude + "," + position.coords.latitude;
        var img_url = "https://static-maps.yandex.ru/1.x/?lang=en_US&l=map&pt=" + latlon + "&size=500,350&z=16";
        document.getElementById("mapholder").innerHTML = "<iframe class='glow border px-1' src='" + img_url + "' width='100%' alt='yandex-Map' ></iframe>";
    }

    function showError(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                geoInfo.textContent = "تم رفض صلاحية الوصول الي الموقع"
                break;
            case error.POSITION_UNAVAILABLE:
                geoInfo.textContent = "لايمكن اتمام العملية, معلومات الموقع غير متاحة تأكد من اتصالك بالانترنت "
                break;
            case error.TIMEOUT:
                geoInfo.textContent = "انتهاء مهلة الحصول على الموقع اعد المحاولة"
                break;
            case error.UNKNOWN_ERROR:
                geoInfo.textContent = "حدث خطا ما اثناء العملية"
                break;
        }
    }
}

function getLocationImage(location, pid) {
    let show = document.querySelector("#showPekiaLocation" + pid);
    let hide = document.querySelector("#hidePekiaLocation" + pid);
    show.hidden = true;
    hide.hidden = false;
    var img_url = "https://static-maps.yandex.ru/1.x/?lang=en_US&l=map&pt=" + location + "&size=500,350&z=16";
    document.getElementById("pekiaLocation" + pid).innerHTML = "<iframe class='border' src='" + img_url + "' width='100%' alt='yandex-Map' ></iframe>";
}

function removeLocationImage(pid) {
    let show = document.querySelector("#showPekiaLocation" + pid);
    let hide = document.querySelector("#hidePekiaLocation" + pid);
    show.hidden = false;
    hide.hidden = true;
    document.getElementById("pekiaLocation" + pid).innerHTML = '';
}


// handel pull refresh btn

if (location.pathname == '/home') {
    document.querySelector("#pagesBody").addEventListener('click', (e) => {
        let sub = document.querySelector("#navList");
        if (sub.classList.contains('hidden') === false && sub.parentElement.classList.contains('cir-perant')) {
            sub.classList.add('hidden');
        }
    });

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