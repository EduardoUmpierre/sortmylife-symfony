var options = {
    url: function(phrase) {
        return "https://www.googleapis.com/books/v1/volumes?q=" + phrase + "&key=AIzaSyCCmDcMYf8XJEs6opdiALxgXykrojeD2kM";
    },

    getValue: function(element) {
        return element.volumeInfo.title;
    },

    ajaxSettings: {
        dataType: "json",
        method: "GET",
        data: {
            dataType: "json"
        }
    },

    preparePostData: function(data) {
        data.phrase = $("#adminbundle_book_title").val().split(' ').join('+');
        return data;
    },

    requestDelay: 400,

    list: {
        onSelectItemEvent: function() {
            var value = $("#adminbundle_book_title").getSelectedItemData().volumeInfo;

            $("#adminbundle_book_description").val(value.description);
            $("#adminbundle_book_image").val(value.imageLinks.thumbnail);
        }
    }
};

$("#adminbundle_book_title").easyAutocomplete(options);