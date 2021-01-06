$(document).ready(function () {
    // postStatusToPageFacebook();
});

function toPostStatusToPageFacebook(link) {
    let message = $("#additional").val();
    postStatusToPageFacebook(message + new Date().getTime(), link);
}

function toPostPhotoToPageFacebook() {
    let message = $("#additional").val();
    postPhotoToPageFacebook(message + new Date().getTime());
}
function postStatusToPageFacebook(message, link) {
    $.post("https://graph.facebook.com/103693188334656/feed",
        {
            message: message,
            link: link,
            access_token: "EAADY7PbMPbkBALyHaAbS0mapEorpCZANfVZAlZB3TNAZCVFM2kTH1yC5kZCLHQeC6IngO47TsNK9ZAqOw4rJmE06tAuU4SJjRl2uja8hjVk9yLBEzOw43FLRhjUjVq1C255fgISNZAMS86kivpRxMQNn97raClxFQkdSfM8tjKEZBWcuJwY7cZA0ZCqoQMso42AIQgs8OoCkow7QZDZD"
        })
        .done(function (data) {
            alert(data.id);
            console.log(data);
        });
}

function postPhotoToPageFacebook(message, url) {
    $.post("https://graph.facebook.com/103693188334656/photos",
        {
            message: message,
            url: 'http://testlaravel.ap-southeast-1.elasticbeanstalk.com/images/2.jpg',
            access_token: "EAADY7PbMPbkBALyHaAbS0mapEorpCZANfVZAlZB3TNAZCVFM2kTH1yC5kZCLHQeC6IngO47TsNK9ZAqOw4rJmE06tAuU4SJjRl2uja8hjVk9yLBEzOw43FLRhjUjVq1C255fgISNZAMS86kivpRxMQNn97raClxFQkdSfM8tjKEZBWcuJwY7cZA0ZCqoQMso42AIQgs8OoCkow7QZDZD"
        })
        .done(function (data) {
            alert(data.id);
            console.log(data);
        });
}
