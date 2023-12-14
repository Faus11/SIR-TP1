

function toggleContent(categoryId) {
    var content = document.getElementById(`category_${categoryId}`);
    if (content.style.display === "none") {
      content.style.display = "block";
    } else {
      content.style.display = "none";
    }
  }
  