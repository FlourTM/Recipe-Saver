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

    if (saveBtn.classList.contains('save')) {
        saveBtn.classList.replace('save', 'unsave')
        saveText.textContent = 'Unsave It'
        saveIcon.innerHTML = 'heart_minus'
    } else {
        saveBtn.classList.replace('unsave', 'save')
        saveText.textContent = 'Save It'
        saveIcon.innerHTML = 'heart_plus'
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
    }
})