// html examples:
//   <img src="image.png" alt="Logo" data-link-href="index.php" data-link>
//   <a href="login.php" data-link>Login</a>
// html attribute usage:
//   data-link = use this in any html element when not directing to another website like <a>
//      provide a link with href="" OR data-link-href="" when using data-link
//   philomena-import = class for referencing import parts like it only loads that element and its children
let defaultPage = "index.php";

// prevent links from working if they have the "data-link" in their <>
document.addEventListener("DOMContentLoaded", () =>
{
    document.body.addEventListener("click", e =>
    {
        if (e.target.matches("[data-link]"))
        {
            e.preventDefault();
            link = e.target.href;
            if(e.target.matches("[data-link-href]"))
            {
                link = e.target.getAttribute("data-link-href");
            }
            changeWindow(link);
        }
        if (e.target.matches("[run-script]"))
        {
            // e.target.innerHTML = '<div class="load-icon"><div></div><div></div><div></div></div>';
            e.preventDefault();
            postForm(e.target.getAttribute("run-script"), e.target.closest('form'));
        }
    });
});

function postForm(script, formdata)
{
    $.ajax({
        type: "POST",
        url: 'php/'+script,
        data: $(formdata).serialize(),
        success: function(data) {
            // remove error messages to prevent doubles
            $(".form-error").empty();
            // if theres 0 errors do nothing
            if(data == ""){
                return;
            }
            data = JSON.parse(data);
            // set all error messages
            for (const property in data) {
                console.log(`${property}: ${data[property]}`);
                $(".form-error["+property+"]").append("<p>"+data[property]+"</p>");
            }
        },
        error: function(){
            console.log("fail");
        }
    });
}

// load default page
$(document).ready(function()
{
    const regex = /philomena|\/|\.php|\.html/g;
    urlPage = window.location.href.replace(regex, "").replace(window.location.hostname, "").replace(window.location.protocol, "");
    if(urlPage == "" || urlPage == "index")
    {
        changeWindow(defaultPage);
        document.title = "Philomena";
        return;
    }
    changeWindow(urlPage+".php");
});

// when going forward/backward change content
addEventListener('popstate', e =>
{
    const regex = /philomena|\/|\.php|\.html/g;
    urlPage = window.location.href.replace(regex, "").replace(window.location.hostname, "").replace(window.location.protocol, "");
    if(urlPage == "" || urlPage == "index")
    {
        changeWindow(window.location.href, true, false);
    } else {
        changeWindow(window.location.href+".php", true, false);
    }
});

// changes window title
function changeTitle(page)
{
    const regex = /philomena|\/|\.php|\.html/g;
    page = (page.replace(regex, "").replace("-", " ").replace(window.location.hostname, "").replace(window.location.protocol, ""));
    document.title = "Philomena - " + page.charAt(0).toUpperCase() + page.slice(1);
}

// changes window to linked window
function changeWindow(e, changetitle=true, changeurl=true)
{
    const regex = /philomena|\/|\.php|\.html/g;
    url = e.replace(regex, "").replace(window.location.hostname, "").replace(window.location.protocol, "");
    if(url == "index" || url == "")
    {
        $('.content').load(defaultPage+" .philomena-import").hide().fadeIn(500);
        if(changetitle)
        {
            document.title = "Philomena";
        }
        if(changeurl)
        {
            changeURL(window.location.protocol+"//"+window.location.hostname+"/philomena/");
        }
        return;
    }else{
        setURLonce = 0; //1==true 0==false
        $('.content').load(e+" .philomena-import", function(responseText, statusText, returnError)
        {
            if (statusText == "success")
            {
                setURLonce++;
                if(setURLonce == 1){
                    if(changeurl)
                    {
                        changeURL(e);
                    }
                    if(changetitle)
                    {
                        changeTitle(e);
                    }
                }
            } else {
                if(returnError.status == 404)
                {
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
function changeURL(x)
{
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