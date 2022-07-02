$("#delete").on("click", function () {
    console.log("radi");

    $.ajax({
        url: "../post/delete.php",
        type: "POST",
        data: { postID: id },
        success: (data) => {
            if (data === "1") {
                alert("Deleted post successfuly.");
                window.location.href = "index.php";
            }
        },
    });
});
