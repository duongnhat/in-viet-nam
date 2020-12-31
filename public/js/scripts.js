$(document).ready(function () {
    // postStatusToPageFacebook();
});

function postStatusToPageFacebook() {
    $.post("https://graph.facebook.com/103693188334656/feed",
        {
            message: new Date().getTime(),
            link: "https://www.youtube.com/watch?v=2jYmxWC11ac",
            access_token: "EAADY7PbMPbkBABjvmXdGbe8i6xcr2734ksL9FPC7NNVSD8ZA3quHXZCqVy3z3b0XX5T805lZCmZCDbPVy1lyrg5KqsevBwHOzteRoBP8iZAZCiAZBjYcoXqYzZB8cPAPGDIW7RArfKjsFL7kGr8Bs0fk4BSuXQjXpixMW8FiGCLJBPA2LQkklm2O9U0aGe3i06oZD"
        })
        .done(function (data) {
            alert(data.id);
            console.log(data);
        });
}
