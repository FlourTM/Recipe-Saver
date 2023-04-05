const uploadForm = document.getElementById('uploadForm'),
    uploadBtn = document.getElementById('uploadBtn'),
    errorMsg = document.getElementById('errorMsg'),
    recipeImg = document.querySelector('input[type="file"]');

var inputFields = document.getElementsByClassName('inputField'),
    title = document.getElementById('title'),
    category = document.getElementById('category'),
    prepTime = document.getElementById('prepTime'),
    cookTime = document.getElementById('cookTime'),
    ingredients = document.getElementById('ingredients'),
    instructions = document.getElementById('instructions')

var postRequest = new XMLHttpRequest();
var url = './php/_upload.php';

uploadBtn.addEventListener('click', e => {
    e.preventDefault();

    for (let i = 0; i < inputFields.length; i++) {
        if (!inputFields[i].value) {
            errorMsg.innerHTML = 'Please fill in all fields.'
            return;
        }
    }

    const file = recipeImg.files[0];
    const allowedTypes = ['image/jpeg', 'image/png'];
    if (!allowedTypes.includes(file.type)) {
        errorMsg.innerHTML = "Invalid file type. Only JPEG and PNG images are allowed."
        return;
    }


    postRequest.open('POST', url, true);
    postRequest.onreadystatechange = function () {
        if (postRequest.readyState == 4 && postRequest.status == 200) {
            errorMsg.textContent = postRequest.responseText
            if (postRequest.responseText.includes("uploaded")) {
                errorMsg.textContent = postRequest.responseText
                uploadForm.reset();
            }
        }
    }

    const formData = new FormData();
    formData.append("title", title.value);
    formData.append("category", category.value);
    formData.append("prepTime", prepTime.value);
    formData.append("cookTime", cookTime.value);
    formData.append("ingredients", ingredients.value);
    formData.append("instructions", instructions.value);
    formData.append("image", file);

    postRequest.send(formData);
});
