function getPosts(page, done) {
  $.ajax({
    method: "POST",
    url: "/feed.php",
    data: {
      page,
      size: 10,
    },
  })
    .done(done)
    .fail((...res) => {
      console.log("Error:", res);
    });
}
var FETCH_PAGE = 1;
var FETCH_FLAG = true;
$(function () {
  getPosts(FETCH_PAGE, function (data) {
    data?.map((card) => {
      renderSingleCard(card);
    });
  });

  function handleScroll() {
    if (!FETCH_FLAG) return;
    if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight) {
      FETCH_FLAG = false;
      getPosts(++FETCH_PAGE, function (data) {
        data?.map((card) => {
          renderSingleCard(card);
        });
        if (data?.length === 10) FETCH_FLAG = true;
      });

      // Add your code here to perform actions when scrolled to the bottom
    }
  }

  // Attach the scroll event listener
  window.addEventListener("scroll", handleScroll);
});
