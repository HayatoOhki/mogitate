const deleteBtn = document.getElementById("deleteBtn");

deleteBtn.addEventListener("click", function (event) {
    if (!confirm("商品を削除します。よろしいですか？")) {
        event.preventDefault();
    }
});