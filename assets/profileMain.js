import './styles/profileMain.scss';

import profilePhotoBlank from './images/profilePhoto.svg';

function showFirstname() {
    
    let firstnameDiv = document.getElementById("edit-firstname");
    firstnameDiv.style.display = "block";
}

document.getElementById("edit-firstname-icon").addEventListener("click", showFirstname);

