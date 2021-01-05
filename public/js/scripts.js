$(document).ready(function () {
    // postStatusToPageFacebook();
});

function toPostStatusToPageFacebook() {
    postStatusToPageFacebook('ưeiuriewruewioruweioruweioruweioruweioruweioru', 'https://bootsnipp.com/snippets/o85lM');
}
function postStatusToPageFacebook(message, link) {
    $.post("https://graph.facebook.com/103693188334656/feed",
        {
            message: message,
            // message: new Date().getTime(),
            link: link,
            // link: "https://www.youtube.com/watch?v=2jYmxWC11ac",
            access_token: "EAADY7PbMPbkBAIq9ypDpOzMI7fGJ5hrZC6mZAh27vmg8ZBajYO4lIXr8zrfTPNTVR8IrVTbFCYF00iQmSmYTB4tZBrhq3lpEjblk17STsVPZBNHkb3qbYB9PtRs0s7cgs2UqPk6xBUiMA1Ugl3fNtnvPTnMqobqOAz5jMe7kSinyzl8S9gPRNEZAfet6ZCHS0VLilZCC1SOC5wZDZD"
        })
        .done(function (data) {
            alert(data.id);
            console.log(data);
        });
}
