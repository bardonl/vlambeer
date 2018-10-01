$(document).ready(function () {

    $('.pin').on('click',function () {
        var unpinnedThreadId = $(this).data('unpinned-thread-id');
        var userid = $(this).data('user-id');

        $.ajax({
            type    : 'POST',
            url     : '../../app/controllers/forumControl.php',
            data    : {
                'unpinnedThreadId'   : unpinnedThreadId,
                'userid'             : userid
            },
            success:    function () {
                location.reload();
            }
        });
    });

    $(".unpin").click(function () {
        var pinnedThreadId = $(this).data('pinned-thread-id');
        var userid = $(this).data('user-id');

        $.ajax({
            type: 'POST',
            url: '../../app/controllers/forumControl.php',
            data: {
                'pinnedThreadId': pinnedThreadId,
                'userid'        : userid
            },
            success: function () {
                location.reload();
            }
        });
    });
});
