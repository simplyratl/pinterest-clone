var selectedOption = "Created";

$("#created, #saved").on("click", function () {
    if (this.innerHTML === "Created") {
        this.style.color = "red";
        $("#saved").css({ color: "black" });
        selectedOption = this.innerHTML;
    } else {
        this.style.color = "red";
        $("#created").css({ color: "black" });
        selectedOption = this.innerHTML;
    }

    showProfileContent();
});

function showProfileContent() {
    $.ajax({
        url: "../profile/show.php",
        type: "POST",
        data: { selectedOption: selectedOption, userID: userID },
        success: (data) => {
            $("#pictures").html(data);
        },
    });
}

showProfileContent();

function showProfile() {
    $.ajax({
        url: "../profile/showprofile.php",
        type: "POST",
        data: { userID: userID },
        success: (data) => {
            console.log(data);
            $("#top-profile").html(data);
        },
    });
}

showProfile();

$("#delete-user").on("click", () => {
    $.ajax({
        url: "../profile/delete.php",
        type: "POST",
        data: { userID: userID },
        success: (data) => {
            if (data === "1") {
                alert("User deleted.");
                window.location.href = "logout.php";
            }
        },
    });
});

$("#update-user").on("click", () => {
    var email = $("#email").val();
    var username = $("#username").val();

    $.ajax({
        url: "../profile/update.php",
        type: "POST",
        data: { userID: userID, email: email, username: username },
        success: (data) => {
            if (data === "1") {
                alert("Profile updated.");
                showProfile();
                toggleEdit();
            } else {
                alert("Error updating profile.");
                console.log(data);
            }
        },
    });
});
