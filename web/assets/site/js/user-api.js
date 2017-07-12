$(".js-btn-book").on("click", function(e) {
    e.preventDefault();

    var userId = $("body").data("id");
    var bookId = $(".detail-section").data("id");
    var _this = $(this);

    var url = _this.data("url");

    _this.toggleClass("active");

    $.post("/livro/" + url, {user: userId, book: bookId})
        .done(function(data, code) {
            if (data) {
                _this.toggleClass("active");
            }
        })
        .fail(function() {
            _this.toggleClass("active");
        });
});