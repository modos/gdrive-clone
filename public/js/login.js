// initialize fields and variables
const email_field = document.getElementById('email')
const password_field = document.getElementById('password')
const login_btn = document.getElementById('login')

// when user click on the login button
const login_btn_click = async function (event) {
    event.preventDefault() // prevent from reload page
    
    let isOk = await send_data()

    if (isOk){
        window.location = "./dashboard.html" // go to dashboard page
    }

}

// send data to api
const send_data = async function () {

    // options needed for request
    const requestOptions = {
        mode: 'cors',
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          password: password_field.value,
          email: email_field.value
        })
      }
        

         let response = await fetch('http://localhost:3000/login.php', requestOptions) // send request
         let data = await response.json() // get response

         if (data.status === 200){
             save_data(data.id, data.name, data.email, data.password)
             return true
         }
         return false
}


// save data into local storage
const save_data = function name(id, name, email, password) {
    localStorage.setItem('id', id)
    localStorage.setItem('name', name)
    localStorage.setItem('email', email)
    localStorage.setItem('password', password)
    
}

// listeners
login_btn.addEventListener('click', login_btn_click)