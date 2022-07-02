function openAddModal() {
    document.getElementById("add-post").style.display = "flex";
}

function closeModal() {
    document.getElementById("add-post").style.display = "none";
}

function toggleDropDown() {
    var controls = document.getElementById("controls");

    controls.classList.toggle("open");
}

function toggleEdit() {
    document.getElementById("edit-container").classList.toggle("open");
}

function showPostSingle() {
    $.ajax({
        url: "../post/show.php",
        type: "POST",
        data: { postID: id, userID: userID },
        success: (data) => {
            $("#postCointainer").html(data);
        },
    });
}

showPostSingle();
