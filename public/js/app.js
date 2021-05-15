if ("serviceWorker" in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker
            .register('./sw.js')
            .then(serviceWorker => {
                console.log("Service Worker registered");
            })
            .catch(error => {
                console.error("Error registering the Service Worker: ", error);
            });
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

// setInterval(() => { Livewire.emitTo('menu', 'refresh') }, 120 * 1000)

window.addEventListener("load", menuView);
window.addEventListener("resize", menuView);
let _clicks = 0;
window.addEventListener("click", (e) => {
    if (_clicks == 5) {
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
            // console.log(files[i])
            var div = document.createElement('div');
            var img = document.createElement('img');
            var itag = document.createElement('i');
            div.classList.add('d-inline-block', 'text-center', );
            img.setAttribute('src', window.URL.createObjectURL(files[i]));
            img.setAttribute('class', 'uploaded-img animation-fade');
            img.setAttribute('width', '80');
            img.setAttribute('height', '80');
            img.setAttribute('id', 'img_' + files[i].size);
            itag.setAttribute('id', 'rem_' + files[i].size);
            itag.setAttribute('class', 'bi bi-x');
            itag.setAttribute('onclick', 'removeImageFromUploaded(' + files[i].size + ')');
            div.appendChild(img);
            div.appendChild(itag);
            gal.appendChild(div);
            gal.classList.add('mb-1', 'border', 'rounded', 'p-1');
        }
    }
}

function removeImageFromUploaded(id) {
    var del = document.querySelector('#img_' + id);
    var rem = document.querySelector('#rem_' + id);
    del.parentNode.removeChild(del);
    rem.parentNode.removeChild(rem);
}

function AddItem(event) {
    event.preventDefault();
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
            for (var j = 0; j < form[i].files.length; j++) {
                data.append(form[i].name, form[i].files[j])
            }
            continue;
        }
        data.append(form[i].name, form[i].value);
    }
    return data;
}

function sendData(url, method, data) {
    let token = document.querySelector('meta[name="csrf-token"]');
    let x;
    fetch(url, {
        method: method,
        body: data
    }).then(res => res.json()).then((res) => {
        resetForm();
        if (res.status == 200 || res.statusText == "OK") {
            Livewire.emit('changeBody', 'feeds');
            return notify("تم اضافة غرضك", 'g', 'حسنا');
        }
        notify(res.msg, 'r', ' حدث خطا ما');
    }).catch((err) => {
        console.log(err);
        notify("حدث خطا ما . حاول لاحقا", 'r', 'للاسف');
    });
}

function resetForm() {
    document.querySelector("#add-item-form").reset();
    resetItemLocation();
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
    let group = document.querySelector("#location-group")
    let input = document.querySelector("#location-input")
    let set = document.querySelector("#setLocation")
    let reset = document.querySelector("#resetLocation")
    set.classList.add("hidden")
    reset.classList.remove("hidden")
    input.classList.remove("hidden")
    input.value = loca
    group.classList.add("hidden")
    for (el of group.children) {
        el.setAttribute('disabled', 'true')
        el.value = ''
    }
}

function resetItemLocation() {
    let group = document.querySelector("#location-group")
    let input = document.querySelector("#location-input")
    let set = document.querySelector("#setLocation")
    let reset = document.querySelector("#resetLocation")
    set.classList.remove("hidden")
    reset.classList.add("hidden")
    input.classList.add("hidden")
    input.value = ''
    group.classList.remove("hidden")
    for (el of group.children) {
        el.removeAttribute('disabled')
    }
}