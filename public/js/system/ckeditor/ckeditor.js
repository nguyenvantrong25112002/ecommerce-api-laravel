const pageCkeditor = {
    classicCk: function () {
        ClassicEditor.create(
            document.querySelector("#kt_docs_ckeditor_classic"),
            {
                toolbar: [
                    "heading",
                    "undo",
                    "redo",
                    "bold",
                    "italic",
                    "blockQuote",
                    "ckfinder",
                    "imageTextAlternative",
                    "imageUpload",
                    "heading",
                    "imageStyle:full",
                    "imageStyle:side",
                    "link",
                    "numberedList",
                    "bulletedList",
                    "mediaEmbed",
                    "insertTable",
                    "tableColumn",
                    "tableRow",
                    "mergeTableCells",
                ],
            }
        )
            .then((editor) => {})
            .catch((error) => { }); 
    },
        classicCk_2: function () {
        ClassicEditor.create(
            document.querySelector("#kt_docs_ckeditor_classic_2"),
            {
                toolbar: [
                    "heading",
                    "undo",
                    "redo",
                    "bold",
                    "italic",
                    "blockQuote",
                    "ckfinder",
                    "imageTextAlternative",
                    "imageUpload",
                    "heading",
                    "imageStyle:full",
                    "imageStyle:side",
                    "link",
                    "numberedList",
                    "bulletedList",
                    "mediaEmbed",
                    "insertTable",
                    "tableColumn",
                    "tableRow",
                    "mergeTableCells",
                ],
            }
        )
            .then((editor) => {})
            .catch((error) => { }); 
    },
};
pageCkeditor.classicCk();
