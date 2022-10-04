import './styles/profileMain.scss';

import profilePhotoBlank from './images/profilePhoto.svg';

function editSex() {

    let sex = document.getElementById("_sex");
    let sexConfirm = document.getElementById("confirm-sex-button");
    let sexSelect = document.getElementById("sex-select");

    sex.style.display = "none";
    sexConfirm.style.display = "block";
    sexSelect.style.display = "block";
}

function confirmSex() {

    let sex = document.getElementById("_sex");
    let sexConfirm = document.getElementById("confirm-sex-button");
    let sexSelect = document.getElementById("sex-select");

    sex.style.display = "block";
    sexConfirm.style.display = "none";
    sexSelect.style.display = "none";
    
    confirmChanges();
}

function editFirstname() {

    let firstname = document.getElementById("_firstname");
    let firstnameConfirm = document.getElementById("confirm-firstname-button");

    firstnameConfirm.style.display = "block";

    firstname.removeAttribute("readonly");

    firstname.style.outline = 0;
    firstname.style.borderWidth = "0 0 2px";
    firstname.style.borderBottom = "1px solid blue"
    firstname.style.borderColor = "blue";
}

function confirmFirstname() {

    let firstname = document.getElementById("_firstname");
    let firstnameConfirm = document.getElementById("confirm-firstname-button");
    
    firstnameConfirm.style.display = "none";

    firstname.style.outline = 0;
    firstname.style.border = 0;
    // firstname.style.borderBottom = "1px solid blue"
    // firstname.style.borderColor = "blue";

    confirmChanges();
}

function confirmChanges() {

    $.ajax({
        method: "POST",
        url: "/Profil/Test",
        data: { sex: $('#sex-select').val(),
                firstname: $('#_firstname').val(),
                lastname: $('#_lastname').val(),            
    
        }
    })
        .done(function(msg) {

            let sexLong;
            let sex = $('#sex-select').val();
            if(sex == "M") {
                sexLong = "Mężczyzna"
            } else {
                sexLong = "Kobieta"
            }

            document.getElementById("_sex").value = sexLong;
            document.getElementById("_firstname").value = $('#_firstname').val();
    });
}

document.getElementById("edit-sex-button").addEventListener("click", editSex);
document.getElementById("confirm-sex-button").addEventListener("click", confirmSex);
document.getElementById("edit-firstname-button").addEventListener("click", editFirstname);
document.getElementById("confirm-firstname-button").addEventListener("click", confirmFirstname);
// document.getElementById("edit-lastname-button").addEventListener("click", editSex);
// document.getElementById("confirm-lastname-button").addEventListener("click", confirmSex);

document.getElementById("confirm-changes").addEventListener("click", confirmChanges);

