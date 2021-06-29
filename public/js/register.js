// initialize fields and variables
const email_field = document.getElementById('email')
const password_field = document.getElementById('password')
const name_field = document.getElementById('name')
const register_btn = document.getElementById('register')

// when user clicked on the register button
const register_btn_click = async function (event) {
    event.preventDefault(); // prevent from reload page
    let isOk = await send_data() // send data to api and get results

    if (isOk){
      window.location = "./login.html"; // go to login page
    }
    

}

// send data to api
const send_data = async function () {
    const requestOptions = {
        mode: 'cors',
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          name: name_field.value,
          password: password_field.value,
          email: email_field.value
        })
      }
         let response = await fetch('http://localhost:3000/register.php', requestOptions)
         let data = await response.json()

         if (data.status === 200){
           return true
         }

         return false
}

// listeners
register_btn.addEventListener('click', register_btn_click)