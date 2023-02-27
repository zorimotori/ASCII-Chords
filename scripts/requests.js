function register(event) {
    event.preventDefault()
    let form = document.getElementById('register-form').elements
    let formData = new FormData()

    formData.append("username", form[0].value)
    formData.append("name", form[1].value)
    formData.append("password", form[2].value)
    formData.append("email", form[3].value)

    let messageContainer = document.getElementById('messageContainer')
    messageContainer.innerHTML = ''
    messageContainer.style.backgroundColor = '#f44336' 
    //'#FF9800' 

    if (formData.get("username").length == 0 || formData.get("name").length == 0 
        || formData.get("password").length == 0 || formData.get("email").length == 0) {
        messageContainer.innerHTML = 'Please fill in all the fields!'
    }
    else if (formData.get("username").length > 20) {
        messageContainer.innerHTML = 'Your username is too long.'
    }
    else if (formData.get("name").length > 50) {
        messageContainer.innerHTML = 'Your name is too long.'
    }
    else if (formData.get("password").length > 60) {
        messageContainer.innerHTML = 'Your password is too long.'
    }
    else if (formData.get("email").length > 50) {
        messageContainer.innerHTML = 'Your email is too long.'
    }
    
    // for (const value of formData.values()) {
    //     console.log(value);
    // }

    console.log(messageContainer.innerHTML)

    if (messageContainer.innerHTML == '') {
        fetch(`${path}/Project/main/user.php`, {
            method: 'POST',
            body: JSON.stringify(Object.fromEntries(formData))
        })
        .then(response => response.json())
        .then(() => {
            let messageContainer = document.getElementById('messageContainer')
    
            messageContainer.textContent = 'Successfully registered!'
            messageContainer.style.backgroundColor = '#04AA6D'
    
            document.getElementById('register-form').style.display = 'none'
        })
    }
    else {
        return
    }
}

function login(event) {
    event.preventDefault()
    let form = document.getElementById('login-form').elements
    let formData = new FormData()

    formData.append("username", form[0].value)
    formData.append("password", form[1].value)
    
    fetch(`${path}/Project/main/session.php`, {
        method: 'POST',
        body: JSON.stringify(Object.fromEntries(formData))
    })
    .then(response => response.json())
    .then(response => {
        let language = document.getElementsByName('language')[0].getAttribute('content')
        let file = ""

        language == 'bg' ? file = 'userView.html' : file = 'userViewEN.html'
        response.logged ? window.location.href = path + '/Project/main/' + file : alert('Неуспешно влизане')
    })
}

function sendFile() {
    document.querySelector("audio").innerHTML = ""
    document.querySelector("video").innerHTML = ""

    let file = document.getElementById('uploaded-file').files[0].name; 
    let audio = document.getElementById('audio')
    let video = document.getElementById('video')
    let audioSource = document.createElement('source')
    let videoSource = document.createElement('source')

    audio.load()
    video.load()

    audioFile = file.substring(0, file.length - 5) + '.mp3'
    videoFile = file.substring(0, file.length - 5) + '.mp4'
    audioSource.src = `${path}/Project/audio/` + audioFile
    videoSource.src = `${path}/Project/video/` + videoFile

    audio.appendChild(audioSource)
    video.appendChild(videoSource)

    document.getElementById('tablature-music').style.display = 'inline-block'
    document.getElementById('video').style.display = 'inline-block'
    document.getElementById('audio').style.display = 'inline-block'
}

function getSongs() {
    fetch(`${path}/Project/main/songs.php`)
    .then(response => response.json())
    .then(data => {

        let form = document.getElementById('songs-form')
        form.innerHTML = ''

        for (const song in data) {
            let input = document.createElement('input')
            let filename = data[song]['filename']

            input.type = 'submit'
            input.name = filename
            input.value = filename.substring(0, filename.length - 5)

            form.appendChild(input)
        }

        document.getElementById('tablature-songs').style.display = 'inline-block'
    })
}

function logout() {
    fetch(`${path}/Project/main/session.php`, {
        method: 'DELETE'
    })
    .then(() => {
        window.location.href = path + '/Project/main/webChords.html'
    })
}
