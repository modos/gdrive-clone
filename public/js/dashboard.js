// initialize variables and DOM
const form = document.querySelector('form')


// when click on upload submit button
const submit_form = function(event){
    event.preventDefault();

    const files = document.querySelector('[type=file]').files
    const formData = new FormData()

    for (let i = 0; i < files.length; i++) {
        let file = files[i]
    
        formData.append('files[]', file)
      }

      console.log(files)
}

// listeners
form.addEventListener('submit', submit_form)