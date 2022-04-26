//  whas desing when using the built in word press api 


getResults() {
    // this.resultsDiv.html("Imagine real search results here...");
    // this.isSpinnerVisible = false;
    $.when(
      $.getJSON(
        universityData.root_url +
          "/wp-json/wp/v2/posts?search=" +
          this.searchField.val()
      ),
      $.getJSON(
        universityData.root_url +
          "/wp-json/wp/v2/pages?search=" +
          this.searchField.val()
      ),
      $.getJSON(
        universityData.root_url +
          "/wp-json/wp/v2/event?search=" +
          this.searchField.val()
      )
    ).then(
      (posts, pages, event) => {
        var combinedResults = posts[0].concat(pages[0]).concat(event[0]);
        this.resultsDiv.html(`
          <h2 class="search-overlay__section-title">General Information</h2>
          ${
            combinedResults.length
              ? '<ul class="link-list min-list">'
              : "<p>No general information matches that search.</p>"
          }
            ${combinedResults
              .map(
                (item) =>
                  `<li><a href="${item.link}">${item.title.rendered}</a> ${
                    item.type == "post" ? `By: ${item.authorName}` : ""
                  }</li>`
              )
              .join("")}
          ${combinedResults.length ? "</ul>" : ""}
        `);
        this.isSpinnerVisible = false;
      },
      () => {
        this.resultsDiv.html("<p>Unexpected error; please try again.</p>");
      }
    );
  }