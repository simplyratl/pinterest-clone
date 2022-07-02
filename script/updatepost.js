$("#update").on("click", () => {
    var title = $("#title-edit").val();
    var description = $("#description-post").val();
    var hashtags = $("#hashtags-post").val();

    $.ajax({
        url: "../post/update.php",
        type: "POST",
        data: { title: title, description: description, hashtags: hashtags, postID: id },
        success: () => {
            showPostSingle();
            toggleEdit();
        },
    });
});
