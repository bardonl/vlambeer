
Moderator = {
    url: "../../app/controllers/moderateControl.php",

    changeRank: function (userId, rankId) {
        return $.ajax({
            url: Moderator.url,
            type: "POST",
            data: {
                "moderate": "editPermission",
                "rankid": rankId,
                "userid": userId
            }
        })
    },
    
    loadUsers: function () {
        return $.ajax({
            url: Moderator.url,
            type: "POST",
            data: {
                "moderate": "refreshUsers",
                "result": $('#search-user').val()
            }
        })
    },

    addPermMod: function (userId, forumId) {
        return $.ajax({
            url: Moderator.url,
            type: "POST",
            data: {
                "moderate": "addForumMod",
                "userId" : userId,
                "forumId": forumId
            }
        })
    },

    removePermMod: function (userId, forumId) {
        return $.ajax({
            url: Moderator.url,
            type: "POST",
            data: {
                "moderate": "removeForumMod",
                "userId" : userId,
                "forumId": forumId
            }
        })
    },

    banUser: function (userId) {
        return $.ajax({
            url: Moderator.url,
            type: "POST",
            data: {
                "moderate": "banUser",
                "userId": userId
            }
        })
    }
};



$('#search-user').on("keyup", function () {
    Moderator.loadUsers().done(function (data) {
        $('.row-th').nextUntil('.container').remove();
        $('.row-th').after(data);

        $('.edit-user-lvl option:selected').each(function () {
            if($(this).val() == 4) {
                $(this).closest('.row-item').find('.show-categories').show();
            } else {
                $(this).closest('.row-item').find('.show-categories').hide();
            }
        });
    });
});

$('.container').on("click", '.show-categories', function () {
    console.log('toggle');
    $(this).next().slideToggle('fast');
});

$('.container').on("change", '.edit-user-lvl', function () {
    Moderator.changeRank($(this).closest('.row-user').find('.data-user').find('.user-id').val()
        ,$(this).find("option:selected").val()).done(function (data) {
    });


    if($(this).find('option:selected').val() == 4) {
        $(this).closest('.row-item').find('.show-categories').show();
    } else {
        $(this).closest('.row-item').find('.show-categories').hide();
    }
});

$('.container').on("change", '.add-perm-mod:checkbox', function () {
    if(this.checked) {
        Moderator.addPermMod($(this).closest('.row-user').find('.data-user').find('.user-id').val(), $(this).val())
            .done(function (data) {
                console.log(data);
            })
    } else {
        Moderator.removePermMod($(this).closest('.row-user').find('.data-user').find('.user-id').val(), $(this).val())
            .done(function (data) {
                console.log(data);
            })
    }
});

$('.container').on("click", '.ban-user', function (e) {
    e.preventDefault();
    var btn = $(this);
    Moderator.banUser($(this).closest('.row-user').find('.data-user').find('.user-id').val())
        .done(function (data) {
            console.log(data);
            if(data == 1) {
                btn.html('un-ban');
            } else if(data == 0) {
                btn.html('ban');
            }
        })
});