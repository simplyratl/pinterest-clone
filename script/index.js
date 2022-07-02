function openAddModal() {
    document.getElementById("add-post").style.display = "flex";
}

function closeModal() {
    document.getElementById("add-post").style.display = "none";
}

function openDropDownUser() {
    var dropdown = document.getElementById("dropdownUser");

    dropdown.classList.toggle("open");
}

$("document").ready(() => {
    function show() {
        $.ajax({
            url: "./post/feed.php",
            type: "POST",
            success: (data) => {
                $("#posts").html(data);
            },
        });
    }

    show();

    $("#submit-add").on("click", () => {
        var input = $("#title").val();
        var image = $("#image").prop("files")[0];
        var hashtags = $("#hashtags").val();
        var id = $("#id").val();
        var description = $("#description").val();

        var hashtagsArray = hashtags.split(" ");

        for (var i = 0; i < hashtagsArray.length; i++) {
            if (!hashtagsArray[i].includes("#")) {
                alert("All hashtags have to have #.");
                return;
            }
        }

        if (!image) {
            alert("You have to select the picture.");
            return;
        }

        var formData = new FormData();
        formData.append("title", input);
        formData.append("image", image);
        formData.append("hashtags", hashtags);
        formData.append("id", id);
        formData.append("description", description);

        $.ajax({
            url: "./post/add.php",
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success: () => {
                closeModal();
                show();
            },
        });
    });
});
