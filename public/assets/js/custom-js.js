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
    function filterTours(){
        var min_price = $('#min_price').val();
        var max_price = $('#max_price').val();
        var domain = $('input[name="domain"]:checked').val();
        var star = $('input[name="star"]:checked').val();
        var duration = $('input[name="duration"]:checked').val();

        formDataFilter = { 
            'min_price': min_price,
            'max_price': max_price,
            'domain': domain,
            'star': star,
            'duration': duration,
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
});
