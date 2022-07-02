$("#download").on("click", () => {
    $.ajax({
        url: "../download/download.php",
        type: "POST",
        data: { id: id, title: title, description: description, hashtags: hashtags },
        success: (data) => {
            if (data === "1") {
                showPostSingle();
                alert("Downloaded post data.");
            }
        },
    });
});
