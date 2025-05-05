$(document).ready(function() {

    var lastChecked = null;
    $('input[type="radio"]').on('click', function() {
        if (lastChecked && lastChecked === this) {
            $(this).prop('checked', false); 
            lastChecked = null;
        } else {
            lastChecked = this;
        }
        filterTours();
    });

    $('#min_price').on('change', filterTours);
    $('#max_price').on('change', filterTours);
    $('input[name="domain"]').on('change', filterTours);
    $('input[name="star"]').on('change', filterTours);
    $('input[name="duration"]').on('change', filterTours);
    $('input[type="checkbox"]').on('change', function() {
        filterTours();
    });

    $('#sorting_tours').on('change', function () {
        filterTours($(this).val()); 
    });

    function filterTours(sorting = 'default'){
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var domain = $('input[name="domain"]:checked').val();
        var star = $('input[name="star"]:checked').val();
        var duration = $('input[name="duration"]:checked').val();
        var sorting = $('#sorting_tours').val();
        formDataFilter = { 
            'min_price': min_price,
            'max_price': max_price,
            'domain': domain,
            'star': star,
            'duration': duration,
            'sorting': sorting,
        };

        $.ajax({
            url: filterToursUrl,
            method: 'GET',
            data: formDataFilter,
            success: function(res) {
                $('#tours-container').html(res);
                $('#tours-container .destination-item').addClass('aos-animate');
            }
        });
    }

    //Update user profile
    $('.updateUser').on('submit', function(e) {
        e.preventDefault();
        var fullName = $('#inputFullName').val();
        var address = $('#inputLocation').val();
        var email = $('#inputEmailAddress').val();
        var phone = $('#inputPhone').val();

        var dataUpdate = {
            'fullName': fullName,
            'address': address,
            'email': email,
            'phone': phone,
            '_token': $('input[name="_token"]').val(),
        }
        console.log(dataUpdate);
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: dataUpdate,
            success: function(response) {
                alert(response.message);
                console.log(response.message);
            },
            error: function(xhr, status, error) {
                alert("Có lỗi xảy ra!");
            }
        });
    });

    $('#update_password_profile').click(function() {
        $("#card_change_password").toggle();
    });

    $('.change_password_profile').on('submit', function(e) {
        e.preventDefault();
        var oldPass = $('#inputOldPass').val();
        var newPass = $('#inputNewPass').val();

        var updatePass = {
            'oldPass': oldPass,
            'newPass': newPass,
            '_token': $('input[name="_token"]').val(),
        }
        console.log(updatePass);
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: updatePass,
            success: function(response) {
                alert(response.message);
                console.log(response.message);
            },
            error: function(xhr, status, error) {
                alert("Có lỗi xảy ra!");
            }
        });
    });
});
