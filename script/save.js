function checkSaved(firstLoad) {
    $.ajax({
        url: "../save/save.php",
        type: "POST",
        data: { postID: id, userID: userID, firstLoad: firstLoad },
        success: (data) => {
            if (data === "1") {
                $("#save").html("Unsave");
                $("#save").css({ backgroundColor: "gray" });
            } else {
                $("#save").html("Save");
                $("#save").css({ backgroundColor: "red" });
            }
        },
    });
}

$("#save").on("click", () => {
    checkSaved(0);
});

checkSaved(1);
