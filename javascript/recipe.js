const saveBtn = document.getElementById('saveBtn'),
    saveIcon = document.getElementById('saveIcon'),
    saveText = document.getElementById('saveText'),
    sendBtn = document.getElementById('sendBtn'),
    confirmMsg = document.getElementById('confirmMsg')

var recipe = document.body.dataset.recipeid;
var comment = document.getElementById('comment');

// Saving and Unsaving a Recipe
saveBtn.addEventListener('click', e => {
    e.preventDefault();

    var postRequest = new XMLHttpRequest();
    var url = './php/_saveRecipe.php';
    postRequest.open('POST', url, true);
    postRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    if (!sessionStorage.getItem('userid')) {
        alert('Must be logged in to save recipes!')
    } else {
        if (saveBtn.classList.contains('save')) {
            postRequest.onreadystatechange = function () {
                if (postRequest.readyState == 4 && postRequest.status == 200) {
                    if (postRequest.responseText.includes("saved")) {
                        saveBtn.classList.replace('save', 'unsave')
                        saveText.textContent = 'Unsave It'
                        saveIcon.innerHTML = 'heart_minus'
                    }
                }
            }
            postRequest.send(`saveRecipe&recipeID=${recipe}`);
        } else if (saveBtn.classList.contains('unsave')) {
            postRequest.onreadystatechange = function () {
                if (postRequest.readyState == 4 && postRequest.status == 200) {
                    saveBtn.classList.replace('unsave', 'save')
                    saveText.textContent = 'Save It'
                    saveIcon.innerHTML = 'heart_plus'
                }
            }
            postRequest.send(`unsave&recipeID=${recipe}`);
        }
    }
})

// Commenting
sendBtn.addEventListener('click', e => {
    e.preventDefault();

    if (!comment.value) {
        confirmMsg.innerHTML = 'Please enter your comment!'
    } else {
        var postRequest = new XMLHttpRequest();
        var url = './php/_comment.php';

        postRequest.open('POST', url, true);
        postRequest.onreadystatechange = function () {
            if (postRequest.readyState == 4 && postRequest.status == 200) {
                confirmMsg.innerHTML = postRequest.responseText
                if (postRequest.responseText.includes("posted")) {
                    confirmMsg.innerHTML = postRequest.responseText
                    comment.value = ''
                }
            }
        }

        const formData = new FormData();
        formData.append("comment", comment.value);
        formData.append("recipeID", recipe);

        postRequest.send(formData);
        setTimeout(200)
        $("#commentDiv").load('php/_loadComments.php')
    }
})