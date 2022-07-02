function showComments() {
    $.ajax({
        url: "../comments/show.php",
        type: "POST",
        data: { postID: id },
        success: (data) => {
            $("#commentsList").html(data);
        },
    });
}

showComments();

$("#addComment").on("click", () => {
    var comment = $("#comment").val();

    if (comment.length > 0 && comment.length < 150) {
        $.ajax({
            url: "../comments/add.php",
            type: "POST",
            data: { comment: comment, postID: id, userID: userID },
            success: (data) => {
                showComments();
                $("#comment").val("");
            },
        });
    } else {
        alert("Comment cannot be empty or larger than 150 characters.");
    }
});
