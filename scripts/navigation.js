const path = 'http://localhost'

function hideMainTags() {
    let tags = document.getElementById('main')
 
    for (const key in tags.children) {
        if(tags.children[key].style != undefined) {
            tags.children[key].style.display = 'none'
        }
    }
}
 
function showTag(tag) {
    tag.style.display = 'inline-block'
}
 
function showHomePage() {
    hideMainTags()
    showTag(document.getElementById('home'))
}
 
function showAboutPage() {
    hideMainTags()
    showTag(document.getElementById('about'))
}
 
function showRegisterForm() {
    hideMainTags()
    showTag(document.getElementById('register-form'))
}
 
function showLoginForm() {
    hideMainTags()
    showTag(document.getElementById('login-form'))
}

function showUserPage() {
    hideMainTags()

    fetch(`${path}/Project/main/session.php`)
    .then(response => response.json())
    .then(data => {
        window.location.href == path + '/Project/main/userView.html' ?
        document.getElementById('welcome').children[0].innerHTML = 'Добре дошъл, ' + data.username + '!' :
        document.getElementById('welcome').children[0].innerHTML = 'Welcome, ' + data.username + '!'
    })

    showTag(document.getElementById('welcome'))
}
 
function showMusicPage() {
    hideMainTags()
    showTag(document.getElementById('music'))
}

function showSongsPage() {
    hideMainTags()
    document.getElementById('songs-form').innerHTML = ''
    showTag(document.getElementById('songs'))
}

function openNav() {
    document.getElementById('navID').style.width = "250px";
}
 
function closeNav() {
    document.getElementById('navID').style.width = "0";
}

function changeLanguage() {
    if (window.location.href == path + '/Project/main/webChords.html') {
        window.location.href = path + '/Project/main/webChordsEN.html'
    }
    else {
        window.location.href = path + '/Project/main/webChords.html'
    }
}