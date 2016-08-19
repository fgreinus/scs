(function() {
    $('.page-search').focus(function() {
        if ($(this).val() != "")
            return;

        $(this).animate({
            width: "+=150"
        },
        300)
    }).blur(function() {
        if ($(this).val() != "")
            return;

        $(this).animate({
            width: "-=150"
        }, 300)
    });
})();