var checkReady = function (callback) {
    if (window.jQuery) {
        callback(jQuery);
    }
    else {
        window.setTimeout(function () { checkReady(callback); }, 100);
    }
};

checkReady(function ($) {
    // Use $ here...
    $(document).ready(function () {
        if ($(".cssPagination .pages .page").length > 1) {
            $(".cssPagination .page:visible").addClass("paginationActive");
            $(".cssPagination .pageNumber[href=#" + $(".page:visible").attr("id") + "]").addClass("paginationActive");
            $(".cssPagination .page:last-child").insertBefore(".cssPagination .page:first-child");
            $(".cssPagination .pageNumber").click(function (e) {
                //e.preventDefault();
                if (!$(this).hasClass("paginationActive")) {
                    $(".cssPagination .pageNumber.paginationActive, .cssPagination .page.paginationActive").removeClass("paginationActive");
                    $(".cssPagination .page" + $(this).attr("href")).addClass("paginationActive");
                    $(this).addClass("paginationActive");
                }
            });
            var prevHTML = $(".cssPagination .prev").html();
            var nextHTML = $(".cssPagination .next").html();
            $(".cssPagination .prev, .cssPagination .next").remove();
            $(".cssPagination .pageNav").prepend('<a class="prev" href="" + $(".cssPagination .pageNumber.paginationActive").prev().attr("href") + "">" + prevHTML + "</a>');
            $(".cssPagination .prev").show().click(function (e) {
                //e.preventDefault();
                if ($(".cssPagination .page:visible").prev(".page").length > 0) {
                    $(".cssPagination .next").attr("href", $(".cssPagination .pageNumber.paginationActive").next().attr("href"));
                    $(".cssPagination .prev").attr("href", $(".cssPagination .pageNumber.paginationActive").prev().attr("href"));
                    var prev = $(".cssPagination .page:visible").prev(".page");
                    $(".cssPagination .next").removeClass("disabled");
                    $(".cssPagination .pageNumber.paginationActive, .cssPagination .page.paginationActive").removeClass("paginationActive");
                    $(prev).addClass("paginationActive");
                    $(".cssPagination .pageNumber[href=#" + $(".page:visible").attr("id") + "]").addClass("paginationActive");
                    if (!$(".cssPagination .page:visible").prev(".page").length > 0) {
                        $(this).addClass("disabled");
                    }
                }
            });
            $(".cssPagination .pageNav").append('<a class="next" href="" + $(".cssPagination .pageNumber.paginationActive").next().attr("href") + "">" + nextHTML + "</a>');
            $(".cssPagination .next").show().click(function (e) {
                //e.preventDefault();
                if ($(".cssPagination .page:visible").next(".page").length > 0) {
                    $(".cssPagination .next").attr("href", $(".cssPagination .pageNumber.paginationActive").next().attr("href"));
                    $(".cssPagination .prev").attr("href", $(".cssPagination .pageNumber.paginationActive").prev().attr("href"));
                    var next = $(".cssPagination .page:visible").next(".page");
                    $(".cssPagination .prev").removeClass("disabled");
                    $(".cssPagination .pageNumber.paginationActive, .cssPagination .page.paginationActive").removeClass("paginationActive");
                    $(next).addClass("paginationActive");
                    $(".cssPagination .pageNumber[href=#" + $(".page:visible").attr("id") + "]").addClass("paginationActive");
                    if (!$(".cssPagination .page:visible").next(".page").length > 0) {
                        $(this).addClass("disabled");
                    }
                }
            });

            $(".cssPagination").addClass("js");
        }
    });
});
