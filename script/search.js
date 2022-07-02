$("#search").on("input", () => {
    var search = $("#search").val();

    $("#suggestions").css({ display: "none" });

    if (search.length > 2) {
        $("#suggestions").css({ display: "block" });

        $.ajax({
            url: "../search/search.php",
            type: "POST",
            data: { search: search },
            success: (data) => {
                $("#search-results").html(data);

                if (data.length === 0) {
                    $("#search-results").html("No results found.");
                }
            },
        });
    }
});
