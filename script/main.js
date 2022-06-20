// html examples:
//   <img src="image.png" alt="Logo" data-link-href="index.php" data-link>
//   <a href="login.php" data-link>Login</a>
// html attribute usage:
//   data-link = use this in any html element when not directing to another website like <a>
//      provide a link with href="" OR data-link-href="" when using data-link
//   philomena-import = class for referencing import parts like it only loads that element and its children
let defaultPage = "index.php";

// prevent links from working if they have the "data-link" in their <>
document.addEventListener("DOMContentLoaded", () => {
    document.body.addEventListener("click", e => {
        if (e.target.matches("[data-link]")) {
            e.preventDefault();
            link = e.target.href;
            if (e.target.matches("[data-link-href]")) {
                e.preventDefault();
                link = e.target.getAttribute("data-link-href");
            }
            changeWindow(link);
        }
        if(e.target.matches("input[type=submit]")){
            e.preventDefault();
            postForm(e.target);
        }
    });
});

function postForm(button) {
    $(button).prop('disabled', true);
    // do the loading overlay
    const regex = /philomena|\/|\.php|\.html/g;
    pageUrl = window.location.href.replace(regex, "").replace(window.location.hostname, "").replace(window.location.protocol, "");
    if(button.closest('form').action == window.location.protocol + "//" + window.location.hostname + "/philomena/" + "php/login.php" && pageUrl != 'login'){
        document.getElementById("login-redirect").setAttribute('value', pageUrl+".php");
    }
    $.ajax({
        type: "POST",
        url: button.closest('form').action,
        data: $(button.closest('form')).serialize(),
        success: function(data) {
            $(".form-error").empty();
            if (data == undefined) {
                return;
            }
            data = JSON.parse(data);
            if (data.redirect != undefined) {
                setTimeout(function() {
                    changeWindow(data.redirect);
                }, 2000);
            }
            // set all error messages
            for (const property in data) {
                if (property != "redirect" && property != "result") {
                    console.log(`${property}: ${data[property]}`);
                    $(".form-error[" + property + "]").append("<p>" + data[property] + "</p>");
                }
            }
            if (data.result != undefined) {
                // place result in button
                oldvalue = $(button).val();
                $(button).val(data.result);
                setInputValue(button, oldvalue);
            }
        },
        error: function() {
            oldvalue = $(button).val();
            $(button).val("fout opgetreden.");
            setInputValue(button, oldvalue);
            setTimeout(function() {
                $(button).prop('disabled', false);
            }, 3000);
        },
        complete: function() {
            // remove load overlay and enable form again
            setTimeout(function() {
                $(button).prop('disabled', false);
            }, 3000);
        }
    });
}

function setInputValue(button, value) {
    setTimeout(function() {
        $(button).val(value);
    }, 1000);
}

// load default page
$(document).ready(function() {
    const regex = /philomena|\/|\.php|\.html/g;
    urlPage = window.location.href.replace(regex, "").replace(window.location.hostname, "").replace(window.location.protocol, "");
    if (urlPage == "" || urlPage == "index") {
        changeWindow(defaultPage);
        document.title = "Philomena";
        return;
    }
    changeWindow(urlPage + ".php");
});

// when going forward/backward change content
addEventListener('popstate', e => {
    const regex = /philomena|\/|\.php|\.html/g;
    urlPage = window.location.href.replace(regex, "").replace(window.location.hostname, "").replace(window.location.protocol, "");
    if (urlPage == "" || urlPage == "index") {
        changeWindow(window.location.href, true, false);
    } else {
        changeWindow(window.location.href + ".php", true, false);
    }
});

// changes window title
function changeTitle(page) {
    const regex = /philomena|\/|\.php|\.html/g;
    page = (page.replace(regex, "").replace("-", " ").replace(window.location.hostname, "").replace(window.location.protocol, ""));
    document.title = "Philomena - " + page.charAt(0).toUpperCase() + page.slice(1);
}

// changes window to linked window
function changeWindow(e, changetitle = true, changeurl = true) {
    const regex = /philomena|\/|\.php|\.html/g;
    url = e.replace(regex, "").replace(window.location.hostname, "").replace(window.location.protocol, "");
    if (url == "index" || url == "") {
        $('.content').load(defaultPage + " .philomena-import").hide().fadeIn(500);
        if (changetitle) {
            document.title = "Philomena";
        }
        if (changeurl) {
            changeURL(window.location.protocol + "//" + window.location.hostname + "/philomena/");
        }
        return;
    } else {
        setURLonce = 0; //1==true 0==false
        $('.content').load(e + " .philomena-import", function(responseText, statusText, returnError) {
            if (statusText == "success") {
                setURLonce++;
                if (setURLonce == 1) {
                    if (changeurl) {
                        changeURL(e);
                    }
                    if (changetitle) {
                        changeTitle(e);
                    }
                }
            } else {
                if (returnError.status == 404) {
                    $('.content').load("404.php .philomena-import");
                    changeURL("404.php");
                    changeTitle("404");
                    return;
                }
            }
        }).hide().fadeIn(500);
    }
}

// adds url to browser history + changes url in window
function changeURL(x) {
    history.pushState(null, null, x.replace(".php", ""));
}

// its just a goof
console.error(
    "———————————No console errors?———————————\n",
    "⠀⣞⢽⢪⢣⢣⢣⢫⡺⡵⣝⡮⣗⢷⢽⢽⢽⣮⡷⡽⣜⣜⢮⢺⣜⢷⢽⢝⡽⣝\n",
    "⠸⡸⠜⠕⠕⠁⢁⢇⢏⢽⢺⣪⡳⡝⣎⣏⢯⢞⡿⣟⣷⣳⢯⡷⣽⢽⢯⣳⣫⠇\n",
    "⠀⠀⢀⢀⢄⢬⢪⡪⡎⣆⡈⠚⠜⠕⠇⠗⠝⢕⢯⢫⣞⣯⣿⣻⡽⣏⢗⣗⠏⠀\n",
    "⠀⠪⡪⡪⣪⢪⢺⢸⢢⢓⢆⢤⢀⠀⠀⠀⠀⠈⢊⢞⡾⣿⡯⣏⢮⠷⠁⠀⠀  \n",
    "⠀⠀⠀⠈⠊⠆⡃⠕⢕⢇⢇⢇⢇⢇⢏⢎⢎⢆⢄⠀⢑⣽⣿⢝⠲⠉⠀⠀⠀⠀\n",
    "⠀⠀⠀⠀⠀⡿⠂⠠⠀⡇⢇⠕⢈⣀⠀⠁⠡⠣⡣⡫⣂⣿⠯⢪⠰⠂⠀⠀⠀⠀\n",
    "⠀⠀⠀⠀⡦⡙⡂⢀⢤⢣⠣⡈⣾⡃⠠⠄⠀⡄⢱⣌⣶⢏⢊⠂⠀⠀⠀⠀⠀⠀\n",
    "⠀⠀⠀⠀⢝⡲⣜⡮⡏⢎⢌⢂⠙⠢⠐⢀⢘⢵⣽⣿⡿⠁⠁⠀⠀⠀⠀⠀⠀⠀\n",
    "⠀⠀⠀⠀⠨⣺⡺⡕⡕⡱⡑⡆⡕⡅⡕⡜⡼⢽⡻⠏⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀\n",
    "⠀⠀⠀⠀⣼⣳⣫⣾⣵⣗⡵⡱⡡⢣⢑⢕⢜⢕⡝⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀\n",
    "⠀⠀⠀⣴⣿⣾⣿⣿⣿⡿⡽⡑⢌⠪⡢⡣⣣⡟⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀\n",
    "⠀⠀⠀⡟⡾⣿⢿⢿⢵⣽⣾⣼⣘⢸⢸⣞⡟⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀\n",
    "⠀⠀⠀⠀⠁⠇⠡⠩⡫⢿⣝⡻⡮⣒⢽⠋⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀\n",
    "————————————————————————————————————————"
);